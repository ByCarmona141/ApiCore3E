<?php

namespace App\Service\systemDocument;

use App\Entity\systemOrientation;
use App\Entity\systemSize;
use App\Libraries\Functions;
use App\Libraries\Wkhtmltopdf;
use App\Repository\systemDocumentRepository;
use App\Repository\systemOrientationRepository;
use App\Repository\systemSizeRepository;
use App\Repository\systemTemplateFrontPageRepository;
use App\Repository\systemTemplateRepository;
use App\Service\systemLog\systemLogRegisterService;
use Clegginabox\PDFMerger\PDFMerger;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class systemDocumentReportService {
    private systemDocumentRepository $repository;
    private systemTemplateRepository $systemTemplateRepository;
    private systemTemplateFrontPageRepository $systemTemplateFrontPageRepository;
    private systemOrientationRepository $systemOrientationRepository;
    private systemSizeRepository $systemSizeRepository;
    private systemLogRegisterService $accesoService;

    public function __construct(systemDocumentRepository $repository, systemTemplateRepository $systemTemplateRepository, systemTemplateFrontPageRepository $systemTemplateFrontPageRepository, systemOrientationRepository $systemOrientationRepository, systemSizeRepository $systemSizeRepository, systemLogRegisterService $accesoService) {
        $this->repository = $repository;

        // Repositorio de systemTemplate
        $this->systemTemplateRepository = $systemTemplateRepository;

        // Repositorio de systemTemplateFrontPage
        $this->systemTemplateFrontPageRepository = $systemTemplateFrontPageRepository;

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

        // Configuracion de la portada
        $SourceFrontPage = [];
        $SourceHeader = [];
        $SourceFooter = [];

        // Obtenemos la portada en caso de que exista una
        if(!empty($systemTemplate->getIdSystemFrontPage())) {
            $systemTemplateFrontPage = $this->systemTemplateFrontPageRepository->findById($systemTemplate->getIdSystemFrontPage());

            // Obtenemos la orientacion de la portada
            $systemOrientation = $this->systemOrientationRepository->findById($systemTemplateFrontPage->getIdSystemOrientation());

            // Obtenemos el tamaño de la portada
            $systemSize = $this->systemSizeRepository->findById($systemTemplateFrontPage->getIdSystemSize());

            // Si la portada del pdf tiene un header
            if(!empty($systemTemplateFrontPage->getHeader())) {
                $templateFrontPageHeader = file_get_contents('templates/Header.html');

                // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
                $FileFrontPageHeader = Functions::ReplaceContentPage(
                // Etiquetas
                    ['<!--##HEADER##-->'],
                    // Datos a intercambiar
                    [$systemTemplateFrontPage->getHeader()],
                    // Template donde estan las etiquetas
                    $templateFrontPageHeader);

                $SourceFrontPageHeader = Functions::GenerateArchive($FileFrontPageHeader, '.html', false, false);
            }

            // Si el pdf tiene un footer
            if(!empty($systemTemplateFrontPage->getFooter())) {
                $templateFrontPageFooter = file_get_contents('templates/Footer.html');

                // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
                $FileFrontPageFooter = Functions::ReplaceContentPage(
                // Etiquetas
                    ['<!--##FOOTER##-->'],
                    // Datos a intercambiar
                    [$systemTemplateFrontPage->getFooter()],
                    // Template donde estan las etiquetas
                    $templateFrontPageFooter);

                $SourceFrontPageFooter = Functions::GenerateArchive($FileFrontPageFooter, '.html', false, false);
            }

            // Template
            $templateBody = file_get_contents('templates/Body.html');

            // Reemplazamos las etiquetas en la plantilla (Ponemos el body)
            $FileFrontPageContent = Functions::ReplaceContentPage(
            // Etiquetas
                ['<!--##BODY##-->'],
                // Datos a intercambiar
                [$systemTemplateFrontPage->getBody()],
                // Template donde estan las etiquetas
                $templateBody);

            // Archivo con el contenido, Nombre del archivo, , Configuracion del PDF, Funcion para la configuracion del wkhtmltopdf
            $SourceFrontPage = Functions::GeneratePDF($FileFrontPageContent, false, false, [], function (Wkhtmltopdf $Wkhtmltopdf) use ($SourceFrontPageHeader, $SourceFrontPageFooter, $systemTemplateFrontPage, $systemOrientation, $systemSize) {
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

                // Si la portada tiene un header
                if(!empty($systemTemplateFrontPage->getHeader())) {
                    // Agregamos el header
                    $Wkhtmltopdf->setHeaderHtml($SourceFrontPageHeader['sourceFile']);
                }

                // Si la portada tiene un footer
                if(!empty($systemTemplateFrontPage->getFooter())) {
                    // Agregamos el footer
                    $Wkhtmltopdf->setFooterHtml($SourceFrontPageFooter['sourceFile']);
                }

                $Wkhtmltopdf->setRunScript('\'document.body.className+=" alt-printarticle";\'');

                // Establecemos el Espaciado del header
                $Wkhtmltopdf->setHeaderSpacing($systemTemplateFrontPage->getHeaderSpacing());

                // Establecemos el Espaciado del footer
                $Wkhtmltopdf->setFooterSpacing($systemTemplateFrontPage->getFooterSpacing());
            });
        }

        // Obtenemos la orientacion de la hoja
        $systemOrientation = $this->systemOrientationRepository->findById($systemTemplate->getIdSystemOrientation());

        // Obtenemos el tamaño de la hoja
        $systemSize = $this->systemSizeRepository->findById($systemTemplate->getIdSystemSize());

        // Si el pdf tiene un header
        if(!empty($systemTemplate->getHeader())) {
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

        // Si el pdf tiene un footer
        if(!empty($systemTemplate->getFooter())) {
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

            // Si el pdf tiene un header
            if(!empty($systemTemplate->getHeader())) {
                // Agregamos el header
                $Wkhtmltopdf->setHeaderHtml($SourceHeader['sourceFile']);
            }

            // Si el pdf tiene un footer
            if(!empty($systemTemplate->getFooter())) {
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
        if(!empty($systemTemplate->getIdSystemFrontPage())) {
            $pdf->addPDF($SourceFrontPage['sourceFile']);
        }
        $pdf->addPDF($SourceFile['sourceFile']);
        $pdf->merge('file', $SourceFile['sourceFile']);

        // Guardamos en el SystemLog la Accion
        $this->accesoService->create('systemDocument', $id, 21, 'Creacion de PDF');

        // Si el pdf tiene una portada
        if(!empty($systemTemplate->getIdSystemFrontPage())) {
            // Eliminamos el archivo
            unlink($SourceFrontPage['sourceFile']);

            if(!empty($systemTemplateFrontPage->getHeader())) {
                // Eliminamos el archivo
                unlink($SourceFrontPageHeader['sourceFile']);
            }
            if(!empty($systemTemplateFrontPage->getFooter())) {
                // Eliminamos el archivo
                unlink($SourceFrontPageFooter['sourceFile']);
            }
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