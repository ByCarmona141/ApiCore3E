<?php

    namespace App\Service\systemSize;

    use App\Entity\systemSize;
    use App\Repository\systemSizeRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemSizeRegisterService {
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
        public function create(string $name, string $type): systemSize {
            $systemSize = new systemSize($name, $type);

            $this->repository->save($systemSize);

            $data = [
                'name' => $systemSize->getName(),
                'type' => $systemSize->getType()
            ];
            $this->accesoService->create('systemSize', $systemSize->getId(), 2, $data);

            return $systemSize;
        }
    }
