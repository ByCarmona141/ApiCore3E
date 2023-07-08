<?php

namespace App\Api\Action\systemRepository;

use App\Entity\systemRepository;
use App\Service\systemRepository\systemRepositoryDataArchiveService;
use App\Service\Request\RequestService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;

class DataArchive {
    private systemRepositoryDataArchiveService $service;

    public function __construct(systemRepositoryDataArchiveService $service) {
        $this->service = $service;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function __invoke(Request $request): array {
        $entity = RequestService::getField($request, 'entity', false);
        $tuple = RequestService::getField($request, 'tuple', false);

        return $this->service->dataArchive($entity, $tuple);
    }
}