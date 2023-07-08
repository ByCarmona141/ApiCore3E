<?php

    namespace App\Api\Action\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Service\systemPrivileges\systemPrivilegesDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemPrivilegesDataService $service;

        public function __construct(systemPrivilegesDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemPrivileges {
            return $this->service->data($id);
        }
    }