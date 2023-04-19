<?php

    namespace App\Service\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Repository\systemUserStatusRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemUserStatusDataService{
        private systemUserStatusRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemUserStatusRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemUserStatus{
            $systemUserStatus = $this->repository->findById($id);
            $data = [
                'name' => $systemUserStatus->getname(),
                'description' => $systemUserStatus->getdescription(),
                'active' => $systemUserStatus->getactive()
            ];

            $this->accesoService->create('systemUserStatus', $id, 4, $data);

            return $systemUserStatus;
        }
    }