<?php

namespace App\Service\systemDocument;

use App\Libraries\Functions;
use App\Libraries\Wkhtmltopdf;
use App\Repository\systemDocumentRepository;
use App\Repository\systemTemplateRepository;
use App\Service\systemLog\systemLogRegisterService;
use Clegginabox\PDFMerger\PDFMerger;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class systemDocumentReportService {
    private systemDocumentRepository $repository;
    private systemTemplateRepository $systemTemplateRepository;
    private systemLogRegisterService $accesoService;

    public function __construct(systemDocumentRepository $repository, systemTemplateRepository $systemTemplateRepository, systemLogRegisterService $accesoService) {
        $this->repository = $repository;

        $this->systemTemplateRepository = $systemTemplateRepository;

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

        // Template
        $template = file_get_contents('templates/body.html');

        $FileContent = Functions::ReplaceContentPage(
            [
                // Etiquetas
                '<!--#BODY#-->'
            ],
            [
                // Datos a intercambiar
                $systemDocument->getContent()
            ],
            // Template donde estan las etiquetas
            $template);

        // Archivo con el contenido, Nombre del archivo, , , Funcion para la configuracion del wkhtmltopdf
        $SourceFile = Functions::GeneratePDF($FileContent, false, false, [], function (Wkhtmltopdf $Wkhtmltopdf) {
            $Wkhtmltopdf->setMargins([
                'left'   => 0,
                'right'  => 0,
                'top'    => 0,
                'bottom' => 0,
            ]);
        });

        $pdf = new PDFMerger();
        $pdf->addPDF($SourceFile['sourceFile']);
        $pdf->merge('file', $SourceFile['sourceFile']);

        // Guardamos en el SystemLog la Accion
        $this->accesoService->create('systemDocument', $id, 21, 'Creacion de PDF');

        return $SourceFile;
    }
}