<?php

    namespace App\Api\Action\systemSize;

    use App\Entity\systemSize;
    use App\Service\systemSize\systemSizeDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemSizeDataService $service;

        public function __construct(systemSizeDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemSize {
            return $this->service->data($id);
        }
    }