<?php

    namespace App\Api\Action\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Service\systemTypeElement\systemTypeElementDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemTypeElementDeleteService $service;

        public function __construct(systemTypeElementDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemTypeElement {
            return $this->service->delete($id);
        }
    }