<?php

    namespace App\Api\Action\systemRepository;

    use App\Entity\systemRepository;
    use App\Service\systemRepository\systemRepositoryDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemRepositoryDataService $service;

        public function __construct(systemRepositoryDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemRepository {
            return $this->service->data($id);
        }
    }