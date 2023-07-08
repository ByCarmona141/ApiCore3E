<?php

    namespace App\Service\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Repository\systemOrientationRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemOrientationRegisterService {
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
        public function create(string $name, string $type): systemOrientation {
            $systemOrientation = new systemOrientation($name, $type);

            $this->repository->save($systemOrientation);

            $data = [
                'name' => $systemOrientation->getName(),
                'type' => $systemOrientation->getType()
            ];
            $this->accesoService->create('systemOrientation', $systemOrientation->getId(), 2, $data);

            return $systemOrientation;
        }
    }
