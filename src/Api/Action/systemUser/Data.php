<?php

    namespace App\Api\Action\systemUser;

    use App\Entity\systemUser;
    use App\Service\systemUser\systemUserDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data{
        private systemUserDataService $service;

        public function __construct(systemUserDataService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemUser{
            return $this->service->data($id);
        }
    }