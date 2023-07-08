<?php

    namespace App\Api\Action\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Service\systemUserStatus\systemUserStatusDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemUserStatusDeleteService $service;

        public function __construct(systemUserStatusDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemUserStatus {
            return $this->service->delete($id);
        }
    }