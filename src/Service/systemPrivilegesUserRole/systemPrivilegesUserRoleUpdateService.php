<?php

    namespace App\Service\systemPrivilegesUserRole;

    use App\Entity\systemPrivilegesUserRole;
    use App\Repository\systemPrivilegesUserRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemPrivilegesUserRoleUpdateService{
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
        public function update(int $id, ?int $idSystemPrivileges, ?string $objectSource, ?int $objectTupla, ?int $active, ?int $objetcAccess): systemPrivilegesUserRole{
            $systemPrivilegesUserRole = $this->repository->findById($id);
            $systemPrivilegesUserRole->setidSystemPrivileges($idSystemPrivileges);
            $systemPrivilegesUserRole->setobjectSource($objectSource);
            $systemPrivilegesUserRole->setobjectTupla($objectTupla);
            $systemPrivilegesUserRole->setactive($active);
            $systemPrivilegesUserRole->setobjetcAccess($objetcAccess);
            $this->repository->save($systemPrivilegesUserRole);

            $data = [
                'idSystemPrivileges' => $systemPrivilegesUserRole->getidSystemPrivileges(),
                'objectSource' => $systemPrivilegesUserRole->getobjectSource(),
                'objectTupla' => $systemPrivilegesUserRole->getobjectTupla(),
                'active' => $systemPrivilegesUserRole->getactive(),
                'objetcAccess' => $systemPrivilegesUserRole->getobjetcAccess()
            ];
            $this->accesoService->create('systemPrivilegesUserRole', $id, 5, $data);

            return $systemPrivilegesUserRole;
        }
    }