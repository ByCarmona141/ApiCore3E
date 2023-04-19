<?php

    namespace App\Service\systemRepository;

    use App\Entity\systemRepository;
    use App\Repository\systemRepositoryRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRepositoryUpdateService{
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
        public function update(int $id, ?string $name, ?string $description, ?float $size, ?string $entity, ?string $tuple, ?string $route): systemRepository{
            $systemRepository = $this->repository->findById($id);
            $systemRepository->setname($name);
            $systemRepository->setdescription($description);
            $systemRepository->setsize($size);
            $systemRepository->setentity($entity);
            $systemRepository->settuple($tuple);
            $systemRepository->setroute($route);
            $this->repository->save($systemRepository);

            $data = [
                'name' => $systemRepository->getname(),
                'description' => $systemRepository->getdescription(),
                'size' => $systemRepository->getsize(),
                'entity' => $systemRepository->getentity(),
                'tuple' => $systemRepository->gettuple(),
                'route' => $systemRepository->getroute()
            ];
            $this->accesoService->create('systemRepository', $id, 5, $data);

            return $systemRepository;
        }
    }