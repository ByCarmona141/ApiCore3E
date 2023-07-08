<?php

    namespace App\Api\Action\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Service\systemUserStatus\systemUserStatusDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemUserStatusDataService $service;

        public function __construct(systemUserStatusDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemUserStatus {
            return $this->service->data($id);
        }
    }