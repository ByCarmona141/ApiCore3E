<?php

    namespace App\Api\Action\systemLog;

    use App\Entity\systemLog;
    use App\Service\systemLog\systemLogDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete{
        private systemLogDeleteService $service;

        public function __construct(systemLogDeleteService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemLog{
            return $this->service->delete($id);
        }
    }