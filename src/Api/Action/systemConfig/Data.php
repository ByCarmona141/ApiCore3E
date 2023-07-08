<?php

    namespace App\Api\Action\systemConfig;

    use App\Entity\systemConfig;
    use App\Service\systemConfig\systemConfigDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemConfigDataService $service;

        public function __construct(systemConfigDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemConfig {
            return $this->service->data($id);
        }
    }