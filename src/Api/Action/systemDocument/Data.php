<?php

    namespace App\Api\Action\systemDocument;

    use App\Entity\systemDocument;
    use App\Service\systemDocument\systemDocumentDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemDocumentDataService $service;

        public function __construct(systemDocumentDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemDocument {
            return $this->service->data($id);
        }
    }