<?php

    namespace App\Api\Action\systemDocument;

    use App\Entity\systemDocument;
    use App\Service\systemDocument\systemDocumentUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemDocumentUpdateService $service;

        public function __construct(systemDocumentUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemDocument{
            $idSystemTemplate = RequestService::getField($request, 'idSystemTemplate', false);
            $content = RequestService::getField($request, 'content', false);
            $dateCreate = RequestService::getField($request, 'dateCreate', false);

            return $this->service->update($id, $idSystemTemplate, $content, $dateCreate);
        }
    }