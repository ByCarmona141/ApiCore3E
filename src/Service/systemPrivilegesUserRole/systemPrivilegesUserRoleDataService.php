<?php

    namespace App\Service\systemPrivilegesUserRole;

    use App\Entity\systemPrivilegesUserRole;
    use App\Repository\systemPrivilegesUserRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemPrivilegesUserRoleDataService{
        private systemPrivilegesUserRoleRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemPrivilegesUserRoleRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemPrivilegesUserRole{
            $systemPrivilegesUserRole = $this->repository->findById($id);
            $data = [
                'idSystemPrivileges' => $systemPrivilegesUserRole->getidSystemPrivileges(),
                'objectSource' => $systemPrivilegesUserRole->getobjectSource(),
                'objectTupla' => $systemPrivilegesUserRole->getobjectTupla(),
                'active' => $systemPrivilegesUserRole->getactive(),
                'objetcAccess' => $systemPrivilegesUserRole->getobjetcAccess()
            ];

            $this->accesoService->create('systemPrivilegesUserRole', $id, 4, $data);

            return $systemPrivilegesUserRole;
        }
    }