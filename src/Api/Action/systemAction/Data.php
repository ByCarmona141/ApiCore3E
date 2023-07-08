<?php

    namespace App\Api\Action\systemAction;

    use App\Entity\systemAction;
    use App\Service\systemAction\systemActionDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemActionDataService $service;

        public function __construct(systemActionDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemAction {
            return $this->service->data($id);
        }
    }