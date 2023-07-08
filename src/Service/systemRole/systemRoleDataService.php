<?php

    namespace App\Service\systemRole;

    use App\Entity\systemRole;
    use App\Repository\systemRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRoleDataService {
        private systemRoleRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemRoleRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemRole {
            $systemRole = $this->repository->findById($id);
            $data = [
                'name' => $systemRole->getname(),
                'active' => $systemRole->getactive()
            ];

            $this->accesoService->create('systemRole', $id, 4, $data);

            return $systemRole;
        }
    }