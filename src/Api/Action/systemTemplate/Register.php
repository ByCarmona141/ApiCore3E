<?php

    namespace App\Api\Action\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Service\systemTemplate\systemTemplateRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemTemplateRegisterService $service;

        public function __construct(systemTemplateRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemTemplate {
            $name = RequestService::getField($request, 'name', true);
            $json = RequestService::getField($request, 'json', false);
            $header = RequestService::getField($request, 'header', false);
            $body = RequestService::getField($request, 'body', true);
            $footer = RequestService::getField($request, 'footer', false);
            $idSystemOrientation = RequestService::getField($request, 'idSystemOrientation', true);
            $idSystemSize = RequestService::getField($request, 'idSystemSize', true);
            $headerSpacing = RequestService::getField($request, 'headerSpacing', false);
            $footerSpacing = RequestService::getField($request, 'footerSpacing', false);
            $idSystemFrontPage = RequestService::getField($request, 'idSystemFrontPage', false);
            $marginLeft = RequestService::getField($request, 'marginLeft', false);
            $marginRight = RequestService::getField($request, 'marginRight', false);
            $marginTop = RequestService::getField($request, 'marginTop', false);
            $marginBottom = RequestService::getField($request, 'marginBottom', false);
            $script = RequestService::getField($request, 'script', false);
            $paginate = RequestService::getField($request, 'paginate', false);

            return $this->service->create($name, $json, $header, $body, $footer, $idSystemOrientation, $idSystemSize, $headerSpacing, $footerSpacing, $idSystemFrontPage, $marginLeft, $marginRight, $marginTop, $marginBottom, $script, $paginate);
        }
    }