<?php

    namespace App\Api\Action\systemPrivilegesUserRole;

    use App\Entity\systemPrivilegesUserRole;
    use App\Service\systemPrivilegesUserRole\systemPrivilegesUserRoleDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data{
        private systemPrivilegesUserRoleDataService $service;

        public function __construct(systemPrivilegesUserRoleDataService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemPrivilegesUserRole{
            return $this->service->data($id);
        }
    }