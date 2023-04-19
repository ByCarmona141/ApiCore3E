<?php

    namespace App\Service\systemRepository;

    use App\Entity\systemRepository;
    use App\Repository\systemRepositoryRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRepositoryDataService{
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
        public function data(int $id): systemRepository{
            $systemRepository = $this->repository->findById($id);
            $data = [
                'name' => $systemRepository->getname(),
                'description' => $systemRepository->getdescription(),
                'size' => $systemRepository->getsize(),
                'entity' => $systemRepository->getentity(),
                'tuple' => $systemRepository->gettuple(),
                'route' => $systemRepository->getroute()
            ];

            $this->accesoService->create('systemRepository', $id, 4, $data);

            return $systemRepository;
        }
    }