<?php

    namespace App\Api\Action\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Service\systemTemplate\systemTemplateDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemTemplateDeleteService $service;

        public function __construct(systemTemplateDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemTemplate {
            return $this->service->delete($id);
        }
    }