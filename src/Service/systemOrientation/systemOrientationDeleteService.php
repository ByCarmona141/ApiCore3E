<?php

    namespace App\Service\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Repository\systemOrientationRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemOrientationDeleteService {
        private systemOrientationRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemOrientationRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemOrientation {
            $systemOrientation = $this->repository->findById($id);
            $data = [
                'name' => $systemOrientation->getname()
            ];

            $this->repository->removeEntity($systemOrientation);

            $this->accesoService->create('systemOrientation', $id, 3, $data);

            return $systemOrientation;
        }
    }
