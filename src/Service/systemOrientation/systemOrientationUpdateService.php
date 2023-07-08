<?php

    namespace App\Service\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Repository\systemOrientationRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemOrientationUpdateService {
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
        public function update(int $id, string $name, string $type): systemOrientation {
            $systemOrientation = $this->repository->findById($id);

            $systemOrientation->setName($name);
            $systemOrientation->setType($type);

            $this->repository->save($systemOrientation);

            $data = [
                'name' => $systemOrientation->getName(),
                'type' => $systemOrientation->getType()
            ];
            $this->accesoService->create('systemOrientation', $id, 5, $data);

            return $systemOrientation;
        }
    }
