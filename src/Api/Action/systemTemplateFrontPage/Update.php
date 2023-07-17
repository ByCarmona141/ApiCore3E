<?php

    namespace App\Api\Action\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Service\systemTemplateFrontPage\systemTemplateFrontPageUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemTemplateFrontPageUpdateService $service;

        public function __construct(systemTemplateFrontPageUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemTemplateFrontPage {
            $name = RequestService::getField($request, 'name', true);
            $header = RequestService::getField($request, 'header', false);
            $body = RequestService::getField($request, 'body', true);
            $footer = RequestService::getField($request, 'footer', false);
            $idSystemOrientation = RequestService::getField($request, 'idSystemOrientation', true);
            $idSystemSize = RequestService::getField($request, 'idSystemSize', true);
            $headerSpacing = RequestService::getField($request, 'headerSpacing', false);
            $footerSpacing = RequestService::getField($request, 'footerSpacing', false);
            $marginLeft = RequestService::getField($request, 'marginLeft', false);
            $marginRight = RequestService::getField($request, 'marginRight', false);
            $marginTop = RequestService::getField($request, 'marginTop', false);
            $marginBottom = RequestService::getField($request, 'marginBottom', false);

            return $this->service->update($id, $name, $header, $body, $footer, $idSystemOrientation, $idSystemSize, $headerSpacing, $footerSpacing, $marginLeft, $marginRight, $marginTop, $marginBottom);
        }
    }