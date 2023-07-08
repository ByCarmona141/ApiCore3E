<?php

    namespace App\Api\Action\systemLog;

    use App\Entity\systemLog;
    use App\Service\systemLog\systemLogDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemLogDataService $service;

        public function __construct(systemLogDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemLog {
            return $this->service->data($id);
        }
    }