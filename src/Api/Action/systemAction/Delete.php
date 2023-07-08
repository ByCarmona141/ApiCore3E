<?php

    namespace App\Api\Action\systemAction;

    use App\Entity\systemAction;
    use App\Service\systemAction\systemActionDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemActionDeleteService $service;

        public function __construct(systemActionDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemAction {
            return $this->service->delete($id);
        }
    }