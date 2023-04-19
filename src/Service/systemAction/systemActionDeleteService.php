<?php

    namespace App\Service\systemAction;

    use App\Entity\systemAction;
    use App\Repository\systemActionRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemActionDeleteService{
        private systemActionRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemActionRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemAction{
            $systemAction = $this->repository->findById($id);
            $data = [
                'name' => $systemAction->getname(),
                'description' => $systemAction->getdescription()
            ];

            $this->repository->removeEntity($systemAction);

            $this->accesoService->create('systemAction', $id, 3, $data);

            return $systemAction;
        }
    }