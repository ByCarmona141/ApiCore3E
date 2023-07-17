<?php

    namespace App\Api\Action\systemDocument;

    use App\Entity\systemDocument;
    use App\Service\systemDocument\systemDocumentRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemDocumentRegisterService $service;

        public function __construct(systemDocumentRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemDocument {
            $idSystemTemplate = RequestService::getField($request, 'idSystemTemplate', false);
            $content = RequestService::getField($request, 'content', false);
            $dateCreate = new \DateTime(RequestService::getField($request, 'dateCreate', false));

            return $this->service->create($idSystemTemplate, $content, $dateCreate);
        }
    }