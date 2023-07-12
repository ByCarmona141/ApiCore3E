<?php

    namespace App\Api\Action\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Service\systemTemplateFrontPage\systemTemplateFrontPageDeleteService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Delete {
        private systemTemplateFrontPageDeleteService $service;

        public function __construct(systemTemplateFrontPageDeleteService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemTemplateFrontPage {
            return $this->service->delete($id);
        }
    }