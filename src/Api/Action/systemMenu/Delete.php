<?php

    namespace App\Api\Action\systemMenu;

    use App\Entity\systemMenu;
    use App\Service\systemMenu\systemMenuDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemMenuDeleteService $service;

        public function __construct(systemMenuDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemMenu {
            return $this->service->delete($id);
        }
    }