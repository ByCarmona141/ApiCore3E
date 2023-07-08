<?php

    namespace App\Api\Action\systemDocument;

    use App\Entity\systemDocument;
    use App\Service\systemDocument\systemDocumentDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemDocumentDeleteService $service;

        public function __construct(systemDocumentDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemDocument {
            return $this->service->delete($id);
        }
    }