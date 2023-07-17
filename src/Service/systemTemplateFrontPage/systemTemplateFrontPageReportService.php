<?php

namespace App\Service\systemTemplateFrontPage;

use App\Entity\systemOrientation;
use App\Entity\systemSize;
use App\Libraries\Functions;
use App\Libraries\Wkhtmltopdf;
use App\Repository\systemOrientationRepository;
use App\Repository\systemSizeRepository;
use App\Repository\systemTemplateFrontPageRepository;
use App\Service\systemLog\systemLogRegisterService;
use Clegginabox\PDFMerger\PDFMerger;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class systemTemplateFrontPageReportService {
    private systemTemplateFrontPageRepository $repository;
    private systemOrientationRepository $systemOrientationRepository;
    private systemSizeRepository $systemSizeRepository;
    private systemLogRegisterService $accesoService;

    public function __construct(systemTemplateFrontPageRepository $repository, systemOrientationRepository $systemOrientationRepository, systemSizeRepository $systemSizeRepository, systemLogRegisterService $accesoService) {
        $this->repository = $repository;

        // Configuracion de la hoja
        $this->systemOrientationRepository = $systemOrientationRepository;
        $this->systemSizeRepository = $systemSizeRepository;

        // Guardamos el acceso en el systemLog
        $this->accesoService = $accesoService;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function report(int $id): array {
        // Obtenemos los datos del template
        $systemTemplateFrontPage = $this->repository->findById($id);

        // Obtenemos la orientacion de la hoja
        $systemOrientation = $this->systemOrientationRepository->findById($systemTemplateFrontPage->getIdSystemOrientation());

        // Obtenemos el tamaño de la hoja
        $systemSize = $this->systemSizeRepository->findById($systemTemplateFrontPage->getIdSystemSize());

        // Configuracion de documento
        $SourceHeader = [];
        $SourceFooter = [];

        // Si el pdf tiene un header
        if(!empty($systemTemplateFrontPage->getHeader())) {
            // Obtenemos el template
            $templateHeader = file_get_contents('templates/Header.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el header)
            $FileHeader = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##HEADER##-->'],
                // Datos a intercambiar
                [$systemTemplateFrontPage->getHeader()],
                // Template donde estan las etiquetas
                $templateHeader);

            // Generamos el html
            $SourceHeader = Functions::GenerateArchive($FileHeader, '.html', false, false);
        }

        // Si el pdf tiene un footer
        if(!empty($systemTemplateFrontPage->getFooter())) {
            // Obtenemos el template
            $templateFooter = file_get_contents('templates/Footer.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileFooter = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##FOOTER##-->'],
                // Datos a intercambiar
                [$systemTemplateFrontPage->getFooter()],
                // Template donde estan las etiquetas
                $templateFooter);

            // Generamos el html
            $SourceFooter = Functions::GenerateArchive($FileFooter, '.html', false, false);
        }

        // Template
        $templateBody = file_get_contents('templates/Body.html');

        // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
        $FileContent = Functions::ReplaceContentPage(
            // Etiquetas
            ['<!--##BODY##-->'],
            // Datos a intercambiar
            [$systemTemplateFrontPage->getBody()],
            // Template donde estan las etiquetas
            $templateBody);


        // Archivo con el contenido, Nombre del archivo, , Configuracion del PDF, Funcion para la configuracion del wkhtmltopdf
        $SourceFile = Functions::GeneratePDF($FileContent, false, false, [], function (Wkhtmltopdf $Wkhtmltopdf) use ($SourceHeader, $SourceFooter, $systemTemplateFrontPage, $systemOrientation, $systemSize) {
            // Establecemos la orientacion de la hoja
            $Wkhtmltopdf->setOrientation($systemOrientation->getType());

            // Establecemos el tamaño de la hoja
            $Wkhtmltopdf->setPageSize($systemSize->getType());

            // Establecemos margenes de la hoja
            $Wkhtmltopdf->setMargins([
                'left'   => $systemTemplateFrontPage->getMarginLeft(),
                'right'  => $systemTemplateFrontPage->getMarginRight(),
                'top'    => $systemTemplateFrontPage->getMarginTop(),
                'bottom' => $systemTemplateFrontPage->getMarginBottom(),
            ]);

            // Si el pdf tiene un header
            if(!empty($systemTemplateFrontPage->getHeader())) {
                // Agregamos el header
                $Wkhtmltopdf->setHeaderHtml($SourceHeader['sourceFile']);
            }

            // Si el pdf tiene un footer
            if(!empty($systemTemplateFrontPage->getFooter())) {
                // Agregamos el footer
                $Wkhtmltopdf->setFooterHtml($SourceFooter['sourceFile']);
            }

            $Wkhtmltopdf->setRunScript('\'document.body.className+=" alt-printarticle";\'');

            // Establecemos el Espaciado del header
            $Wkhtmltopdf->setHeaderSpacing($systemTemplateFrontPage->getHeaderSpacing());

            // Establecemos el Espaciado del footer
            $Wkhtmltopdf->setFooterSpacing($systemTemplateFrontPage->getFooterSpacing());
        });

        $pdf = new PDFMerger();
        $pdf->addPDF($SourceFile['sourceFile']);
        $pdf->merge('file', $SourceFile['sourceFile']);

        // Guardamos en el SystemLog la Accion
        $this->accesoService->create('systemTemplateFrontPage', $id, 21, 'Creacion de PDF');

        if(!empty($systemTemplateFrontPage->getHeader())) {
            // Eliminamos el archivo
            unlink($SourceHeader['sourceFile']);
        }
        if(!empty($systemTemplateFrontPage->getFooter())) {
            // Eliminamos el archivo
            unlink($SourceFooter['sourceFile']);
        }

        return $SourceFile;
    }
}