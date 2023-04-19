<?php

    namespace App\Api\Action\systemMenu;

    use App\Entity\systemMenu;
    use App\Service\systemMenu\systemMenuDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data{
        private systemMenuDataService $service;

        public function __construct(systemMenuDataService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemMenu{
            return $this->service->data($id);
        }
    }