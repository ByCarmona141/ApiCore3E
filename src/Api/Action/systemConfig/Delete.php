<?php

    namespace App\Api\Action\systemConfig;

    use App\Entity\systemConfig;
    use App\Service\systemConfig\systemConfigDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemConfigDeleteService $service;

        public function __construct(systemConfigDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemConfig {
            return $this->service->delete($id);
        }
    }