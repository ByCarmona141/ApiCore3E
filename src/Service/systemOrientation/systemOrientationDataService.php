<?php

    namespace App\Service\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Repository\systemOrientationRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemOrientationDataService {
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
        public function data(int $id): systemOrientation {
            $systemOrientation = $this->repository->findById($id);
            $data = [
                'name' => $systemOrientation->getname()
            ];

            $this->accesoService->create('systemOrientation', $id, 4, $data);

            return $systemOrientation;
        }
    }
