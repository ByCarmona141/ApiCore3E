<?php

    namespace App\Api\Action\systemSize;

    use App\Entity\systemSize;
    use App\Service\systemSize\systemSizeDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemSizeDeleteService $service;

        public function __construct(systemSizeDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemSize {
            return $this->service->delete($id);
        }
    }