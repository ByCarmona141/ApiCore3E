<?php

    namespace App\Service\systemAction;

    use App\Entity\systemAction;
    use App\Repository\systemActionRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemActionDataService{
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
        public function data(int $id): systemAction{
            $systemAction = $this->repository->findById($id);
            $data = [
                'name' => $systemAction->getname(),
                'description' => $systemAction->getdescription()
            ];

            $this->accesoService->create('systemAction', $id, 4, $data);

            return $systemAction;
        }
    }