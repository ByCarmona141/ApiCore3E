<?php

    namespace App\Api\Action\systemPrivilegesUserRole;

    use App\Entity\systemPrivilegesUserRole;
    use App\Service\systemPrivilegesUserRole\systemPrivilegesUserRoleUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemPrivilegesUserRoleUpdateService $service;

        public function __construct(systemPrivilegesUserRoleUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemPrivilegesUserRole {
            $idSystemPrivileges = RequestService::getField($request, 'idSystemPrivileges', false);
            $objectSource = RequestService::getField($request, 'objectSource', false);
            $objectTupla = RequestService::getField($request, 'objectTupla', false);
            $active = RequestService::getField($request, 'active', false);
            $objetcAccess = RequestService::getField($request, 'objetcAccess', false);

            return $this->service->update($id, $idSystemPrivileges, $objectSource, $objectTupla, $active, $objetcAccess);
        }
    }