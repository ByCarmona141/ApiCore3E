<?php

    namespace App\Api\Action\systemRole;

    use App\Entity\systemRole;
    use App\Service\systemRole\systemRoleDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemRoleDeleteService $service;

        public function __construct(systemRoleDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemRole {
            return $this->service->delete($id);
        }
    }