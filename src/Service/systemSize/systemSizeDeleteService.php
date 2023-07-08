<?php

    namespace App\Service\systemSize;

    use App\Entity\systemSize;
    use App\Repository\systemSizeRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemSizeDeleteService {
        private systemSizeRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemSizeRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemSize {
            $systemSize = $this->repository->findById($id);
            $data = [
                'name' => $systemSize->getname()
            ];

            $this->repository->removeEntity($systemSize);

            $this->accesoService->create('systemSize', $id, 3, $data);

            return $systemSize;
        }
    }
