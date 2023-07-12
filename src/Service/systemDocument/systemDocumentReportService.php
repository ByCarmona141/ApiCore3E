<?php

namespace App\Service\systemDocument;

use App\Entity\systemOrientation;
use App\Entity\systemSize;
use App\Libraries\Functions;
use App\Libraries\Wkhtmltopdf;
use App\Repository\systemDocumentRepository;
use App\Repository\systemOrientationRepository;
use App\Repository\systemSizeRepository;
use App\Repository\systemTemplateRepository;
use App\Service\systemLog\systemLogRegisterService;
use Clegginabox\PDFMerger\PDFMerger;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class systemDocumentReportService {
    private systemDocumentRepository $repository;
    private systemTemplateRepository $systemTemplateRepository;
    private systemOrientationRepository $systemOrientationRepository;
    private systemSizeRepository $systemSizeRepository;
    private systemLogRegisterService $accesoService;

    public function __construct(systemDocumentRepository $repository, systemTemplateRepository $systemTemplateRepository, systemOrientationRepository $systemOrientationRepository, systemSizeRepository $systemSizeRepository, systemLogRegisterService $accesoService) {
        $this->repository = $repository;

        // Repositorio de systemTemplate
        $this->systemTemplateRepository = $systemTemplateRepository;

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
        // Obtenemos los datos del documento
        $systemDocument = $this->repository->findById($id);

        // Obtenemos los datos de la plantilla
        $systemTemplate = $this->systemTemplateRepository->findById($systemDocument->getIdSystemTemplate());

        // Obtenemos la orientacion de la hoja
        $systemOrientation = $this->systemOrientationRepository->findById($systemTemplate->getOrientation());

        // Obtenemos el tamaño de la hoja
        $systemSize = $this->systemSizeRepository->findById($systemTemplate->getSize());

        // Configuracion de documento
        $SourceFrontPage = [];
        $SourceHeader = [];
        $SourceFooter = [];

        // Si el pdf tiene una portada
        if(!empty($systemTemplate->getFrontPage())) {
            // Obtenemos el template
            $templateFrontPage = file_get_contents('templates/Body.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileFrontPage = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##BODY##-->'],
                // Datos a intercambiar
                [$systemTemplate->getFrontPage()],
                // Template donde estan las etiquetas
                $templateFrontPage);

            // Archivo con el contenido, Nombre del archivo, , Configuracion del PDF, Funcion para la configuracion del wkhtmltopdf
            $SourceFrontPage = Functions::GeneratePDF($FileFrontPage, false, false, [], function (Wkhtmltopdf $Wkhtmltopdf) use ($systemTemplate, $systemOrientation, $systemSize) {
                // Establecemos la orientacion de la hoja
                $Wkhtmltopdf->setOrientation($systemOrientation->getType());

                // Establecemos el tamaño de la hoja
                $Wkhtmltopdf->setPageSize($systemSize->getType());

                // Establecemos margenes de la hoja
                $Wkhtmltopdf->setMargins([
                    'left'   => $systemTemplate->getMarginLeft(),
                    'right'  => $systemTemplate->getMarginRight(),
                    'top'    => $systemTemplate->getMarginTop(),
                    'bottom' => $systemTemplate->getMarginBottom(),
                ]);

                // Establecemos el Espaciado del header
                $Wkhtmltopdf->setHeaderSpacing($systemTemplate->getHeaderSpacing());

                // Establecemos el Espaciado del footer
                $Wkhtmltopdf->setFooterSpacing($systemTemplate->getFooterSpacing());
            });
        }

        //Si el pdf tiene una portada y un header
        if(!empty($systemTemplate->getFrontPage()) && !empty($systemTemplate->getHeader())) {
            $templateHeader = file_get_contents('templates/HeaderFrontPage.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileHeader = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##HEADER##-->'],
                // Datos a intercambiar
                [$systemTemplate->getHeader()],
                // Template donde estan las etiquetas
                $templateHeader);

            $SourceHeader = Functions::GenerateArchive($FileHeader, '.html', false, false);
        } else if(!empty($systemTemplate->getHeader())) { // Si el pdf tiene un header
            $templateHeader = file_get_contents('templates/Header.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileHeader = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##HEADER##-->'],
                // Datos a intercambiar
                [$systemTemplate->getHeader()],
                // Template donde estan las etiquetas
                $templateHeader);

            $SourceHeader = Functions::GenerateArchive($FileHeader, '.html', false, false);
        }

        //Si el pdf tiene una portada y un footer
        if(!empty($systemTemplate->getFrontPage()) && !empty($systemTemplate->getFooter())) {
            $templateFooter = file_get_contents('templates/FooterFrontPage.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileFooter = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##FOOTER##-->'],
                // Datos a intercambiar
                [$systemTemplate->getFooter()],
                // Template donde estan las etiquetas
                $templateFooter);

            $SourceFooter = Functions::GenerateArchive($FileFooter, '.html', false, false);
        } else if(!empty($systemTemplate->getFooter())) { // Si el pdf tiene un footer
            $templateFooter = file_get_contents('templates/Footer.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileFooter = Functions::ReplaceContentPage(
                // Etiquetas
                ['<!--##FOOTER##-->'],
                // Datos a intercambiar
                [$systemTemplate->getFooter()],
                // Template donde estan las etiquetas
                $templateFooter);

            $SourceFooter = Functions::GenerateArchive($FileFooter, '.html', false, false);
        }

        // Template
        $templateBody = file_get_contents('templates/Body.html');

        // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
        $FileBody = Functions::ReplaceContentPage(
            // Etiquetas
            ['<!--##BODY##-->'],
            // Datos a intercambiar
            [$systemTemplate->getBody()],
            // Template donde estan las etiquetas
            $templateBody);

        // Convertimos el json del documento en array
        $arrayJson = json_decode($systemDocument->getContent(), true);

        $tagsJson = [];
        $dataJson = [];
        // Guardamos las etiquetas y los datos del json
        foreach ($arrayJson as $key => $value) {
            // Si no existe el campo tag
            if(empty($value['tag'])) {
                break;
            }
            $tagsJson[] = $value['tag'];
            $dataJson[] = $value['value'];
        }

        // Reemplazamos las etiquetas del body con los datos del documento
        $FileContent = Functions::ReplaceContentPage(
            $tagsJson,
            $dataJson,
            // Template donde estan las etiquetas
            $FileBody);


        // Archivo con el contenido, Nombre del archivo, , Configuracion del PDF, Funcion para la configuracion del wkhtmltopdf
        $SourceFile = Functions::GeneratePDF($FileContent, false, false, [], function (Wkhtmltopdf $Wkhtmltopdf) use ($SourceHeader, $SourceFooter, $systemTemplate, $systemOrientation, $systemSize) {
            // Establecemos la orientacion de la hoja
            $Wkhtmltopdf->setOrientation($systemOrientation->getType());

            // Establecemos el tamaño de la hoja
            $Wkhtmltopdf->setPageSize($systemSize->getType());

            // Establecemos margenes de la hoja
            $Wkhtmltopdf->setMargins([
                'left'   => $systemTemplate->getMarginLeft(),
                'right'  => $systemTemplate->getMarginRight(),
                'top'    => $systemTemplate->getMarginTop(),
                'bottom' => $systemTemplate->getMarginBottom(),
            ]);

            // Si el pdf tiene una portada y un header
            if(!empty($systemTemplate->getFrontPage()) && !empty($systemTemplate->getHeader())) {
                // Agregamos el header
                $Wkhtmltopdf->setHeaderHtml($SourceHeader['sourceFile']);
            } else if(!empty($systemTemplate->getHeader())) { // Si el pdf tiene un header
                // Agregamos el header
                $Wkhtmltopdf->setHeaderHtml($SourceHeader['sourceFile']);
            }

            // Si el pdf tiene una portada y un footer
            if(!empty($systemTemplate->getFrontPage()) && !empty($systemTemplate->getFooter())) {
                // Agregamos el footer
                $Wkhtmltopdf->setFooterHtml($SourceFooter['sourceFile']);
            } else if(!empty($systemTemplate->getFooter())) { // Si el pdf tiene un footer
                // Agregamos el footer
                $Wkhtmltopdf->setFooterHtml($SourceFooter['sourceFile']);
            }

            $Wkhtmltopdf->setRunScript('\'document.body.className+=" alt-printarticle";\'');

            // Establecemos el Espaciado del header
            $Wkhtmltopdf->setHeaderSpacing($systemTemplate->getHeaderSpacing());

            // Establecemos el Espaciado del footer
            $Wkhtmltopdf->setFooterSpacing($systemTemplate->getFooterSpacing());
        });

        $pdf = new PDFMerger();

        // Si existe una portada la agregamos al pdf
        if(!empty($systemTemplate->getFrontPage())) {
            $pdf->addPDF($SourceFrontPage['sourceFile']);
        }
        $pdf->addPDF($SourceFile['sourceFile']);
        $pdf->merge('file', $SourceFile['sourceFile']);

        // Guardamos en el SystemLog la Accion
        $this->accesoService->create('systemDocument', $id, 21, 'Creacion de PDF');

        if(!empty($systemTemplate->getFrontPage())) {
            // Eliminamos el archivo
            unlink($SourceFrontPage['sourceFile']);
        }
        if(!empty($systemTemplate->getHeader())) {
            // Eliminamos el archivo
            unlink($SourceHeader['sourceFile']);
        }
        if(!empty($systemTemplate->getFooter())) {
            // Eliminamos el archivo
            unlink($SourceFooter['sourceFile']);
        }

        return $SourceFile;
    }
}