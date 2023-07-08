<?php

    namespace App\Api\Action\systemIcon;

    use App\Entity\systemIcon;
    use App\Service\systemIcon\systemIconDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemIconDataService $service;

        public function __construct(systemIconDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemIcon {
            return $this->service->data($id);
        }
    }