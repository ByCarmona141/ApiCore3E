<?php

    namespace App\Service\systemRepository;

    use App\Entity\systemRepository;
    use App\Repository\systemRepositoryRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRepositoryRegisterService {
        private systemRepositoryRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemRepositoryRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(?string $name, ?string $description, ?float $size, ?string $entity, ?string $tuple, ?string $route): systemRepository {
            $systemRepository = new systemRepository($name, $description, $size, $entity, $tuple, $route);

            $this->repository->save($systemRepository);

            $data = [
                'name' => $systemRepository->getname(),
                'description' => $systemRepository->getdescription(),
                'size' => $systemRepository->getsize(),
                'entity' => $systemRepository->getentity(),
                'tuple' => $systemRepository->gettuple(),
                'route' => $systemRepository->getroute()
            ];
            $this->accesoService->create('systemRepository', $systemRepository->getId(), 2, $data);

            return $systemRepository;
        }
    }