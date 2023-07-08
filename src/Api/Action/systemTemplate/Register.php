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
            $orientation = RequestService::getField($request, 'orientation', true);
            $size = RequestService::getField($request, 'size', true);
            $headerSpacing = RequestService::getField($request, 'headerSpacing', false);
            $footerSpacing = RequestService::getField($request, 'footerSpacing', false);
            $frontPage = RequestService::getField($request, 'frontPage', false);
            $marginLeft = RequestService::getField($request, 'marginLeft', false);
            $marginRight = RequestService::getField($request, 'marginRight', false);
            $marginTop = RequestService::getField($request, 'marginTop', false);
            $marginBottom = RequestService::getField($request, 'marginBottom', false);
            $script = RequestService::getField($request, 'script', false);

            return $this->service->create($name, $json, $header, $body, $footer, $orientation, $size, $headerSpacing, $footerSpacing, $frontPage, $marginLeft, $marginRight, $marginTop, $marginBottom, $script);
        }
    }