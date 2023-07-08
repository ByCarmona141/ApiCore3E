<?php

    namespace App\Api\Action\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Service\systemOrientation\systemOrientationDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemOrientationDeleteService $service;

        public function __construct(systemOrientationDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemOrientation {
            return $this->service->delete($id);
        }
    }