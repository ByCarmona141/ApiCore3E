<?php

namespace App\Api\Action\systemTemplateFrontPage;

use App\Entity\systemTemplateFrontPage;
use App\Service\systemTemplateFrontPage\systemTemplateFrontPageReportService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class Report {
    private systemTemplateFrontPageReportService $service;

    public function __construct(systemTemplateFrontPageReportService $service) {
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