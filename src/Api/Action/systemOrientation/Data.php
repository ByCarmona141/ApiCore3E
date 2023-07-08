<?php

    namespace App\Api\Action\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Service\systemOrientation\systemOrientationDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemOrientationDataService $service;

        public function __construct(systemOrientationDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemOrientation {
            return $this->service->data($id);
        }
    }