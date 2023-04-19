<?php

namespace App\Api\Action\systemDocument;

use App\Entity\systemDocument;
use App\Service\systemDocument\systemDocumentReportService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class Report {
    private systemDocumentReportService $service;

    public function __construct(systemDocumentReportService $service) {
        $this->service = $service;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function __invoke(int $id): array {
        return $this->service->report($id);
    }
}