<?php

    namespace App\Api\Action\systemPrivilegesUserRole;

    use App\Entity\systemPrivilegesUserRole;
    use App\Service\systemPrivilegesUserRole\systemPrivilegesUserRoleDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemPrivilegesUserRoleDeleteService $service;

        public function __construct(systemPrivilegesUserRoleDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemPrivilegesUserRole {
            return $this->service->delete($id);
        }
    }