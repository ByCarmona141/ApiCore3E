<?php

    namespace App\Api\Action\systemUser;

    use App\Entity\systemUser;
    use App\Service\systemUser\systemUserDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete{
        private systemUserDeleteService $service;

        public function __construct(systemUserDeleteService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemUser{
            return $this->service->delete($id);
        }
    }