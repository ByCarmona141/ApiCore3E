<?php

    namespace App\Api\Action\systemRole;

    use App\Entity\systemRole;
    use App\Service\systemRole\systemRoleDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemRoleDataService $service;

        public function __construct(systemRoleDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemRole {
            return $this->service->data($id);
        }
    }