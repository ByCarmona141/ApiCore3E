<?php

    namespace App\Api\Action\systemPrivilegesUserRole;

    use App\Entity\systemPrivilegesUserRole;
    use App\Service\systemPrivilegesUserRole\systemPrivilegesUserRoleRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register{
        private systemPrivilegesUserRoleRegisterService $service;

        public function __construct(systemPrivilegesUserRoleRegisterService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemPrivilegesUserRole{
            $idSystemPrivileges = RequestService::getField($request, 'idSystemPrivileges', false);
            $objectSource = RequestService::getField($request, 'objectSource', false);
            $objectTupla = RequestService::getField($request, 'objectTupla', false);
            $active = RequestService::getField($request, 'active', false);
            $objetcAccess = RequestService::getField($request, 'objetcAccess', false);

            return $this->service->create($idSystemPrivileges, $objectSource, $objectTupla, $active, $objetcAccess);
        }
    }