<?php

    namespace App\Service\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Repository\systemUserStatusRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemUserStatusDeleteService{
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
        public function delete(int $id): systemUserStatus{
            $systemUserStatus = $this->repository->findById($id);
            $data = [
                'name' => $systemUserStatus->getname(),
                'description' => $systemUserStatus->getdescription(),
                'active' => $systemUserStatus->getactive()
            ];

            $this->repository->removeEntity($systemUserStatus);

            $this->accesoService->create('systemUserStatus', $id, 3, $data);

            return $systemUserStatus;
        }
    }