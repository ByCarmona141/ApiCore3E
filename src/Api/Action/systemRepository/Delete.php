<?php

    namespace App\Api\Action\systemRepository;

    use App\Entity\systemRepository;
    use App\Service\systemRepository\systemRepositoryDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemRepositoryDeleteService $service;

        public function __construct(systemRepositoryDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemRepository {
            return $this->service->delete($id);
        }
    }