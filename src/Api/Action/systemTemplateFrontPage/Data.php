<?php

    namespace App\Api\Action\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Service\systemTemplateFrontPage\systemTemplateFrontPageDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data {
        private systemTemplateFrontPageDataService $service;

        public function __construct(systemTemplateFrontPageDataService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemTemplateFrontPage {
            return $this->service->data($id);
        }
    }