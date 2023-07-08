<?php

    namespace App\Service\systemSize;

    use App\Entity\systemSize;
    use App\Repository\systemSizeRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemSizeUpdateService {
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
        public function update(int $id, string $name, string $type): systemSize {
            $systemSize = $this->repository->findById($id);

            $systemSize->setName($name);
            $systemSize->setType($type);

            $this->repository->save($systemSize);

            $data = [
                'name' => $systemSize->getName(),
                'type' => $systemSize->getType()
            ];
            $this->accesoService->create('systemSize', $id, 5, $data);

            return $systemSize;
        }
    }
