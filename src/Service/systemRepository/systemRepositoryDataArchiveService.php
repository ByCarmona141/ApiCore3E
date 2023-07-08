<?php

namespace App\Service\systemRepository;

use App\Entity\systemRepository;
use App\Repository\systemRepositoryRepository;
use App\Service\systemLog\systemLogRegisterService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class systemRepositoryDataArchiveService {
    private systemRepositoryRepository $repository;
    private systemLogRegisterService $accesoService;

    public function __construct(systemRepositoryRepository $repository,
                                systemLogRegisterService $accesoService){
        $this->repository = $repository;
        $this->accesoService = $accesoService;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function dataArchive(string $entity, string $tuple): array {
        $systemRepository = $this->repository->findByArchive($entity, $tuple);

        $data = [];

        foreach ($systemRepository as $item) {
            $data[] = [
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'size' => $item->getSize(),
                'entity' => $item->getEntity(),
                'tuple' => $item->getTuple(),
                'route' => $item->getRoute()
            ];
        }



//        $this->accesoService->create('systemRepository', $systemRepository->getId(), 4, $data);

        return $data;
    }
}