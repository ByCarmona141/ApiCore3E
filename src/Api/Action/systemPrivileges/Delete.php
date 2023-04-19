<?php

    namespace App\Api\Action\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Service\systemPrivileges\systemPrivilegesDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete{
        private systemPrivilegesDeleteService $service;

        public function __construct(systemPrivilegesDeleteService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemPrivileges{
            return $this->service->delete($id);
        }
    }