<?php

    namespace App\Api\Action\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Service\systemTemplate\systemTemplateUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemTemplateUpdateService $service;

        public function __construct(systemTemplateUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemTemplate{
            $name = RequestService::getField($request, 'name', false);
            $header = RequestService::getField($request, 'header', false);
            $body = RequestService::getField($request, 'body', false);
            $footer = RequestService::getField($request, 'footer', false);
            $orientation = RequestService::getField($request, 'orientation', false);
            $size = RequestService::getField($request, 'size', false);
            $headerSpacing = RequestService::getField($request, 'headerSpacing', false);
            $footerSpacing = RequestService::getField($request, 'footerSpacing', false);
            $frontPage = RequestService::getField($request, 'frontPage', false);
            $script = RequestService::getField($request, 'script', false);
            $json = RequestService::getField($request, 'json', false);

            return $this->service->update($id, $name, $header, $body, $footer, $orientation, $size, $headerSpacing, $footerSpacing, $frontPage, $script, $json);
        }
    }