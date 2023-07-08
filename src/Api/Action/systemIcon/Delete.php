<?php

    namespace App\Api\Action\systemIcon;

    use App\Entity\systemIcon;
    use App\Service\systemIcon\systemIconDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemIconDeleteService $service;

        public function __construct(systemIconDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemIcon {
            return $this->service->delete($id);
        }
    }