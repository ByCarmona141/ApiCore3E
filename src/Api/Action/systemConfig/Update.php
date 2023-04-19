<?php

    namespace App\Api\Action\systemConfig;

    use App\Entity\systemConfig;
    use App\Service\systemConfig\systemConfigUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemConfigUpdateService $service;

        public function __construct(systemConfigUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemConfig{
            $name = RequestService::getField($request, 'name', false);
            $value = RequestService::getField($request, 'value', false);
            $tipeofHTML = RequestService::getField($request, 'tipeofHTML', false);
            $category = RequestService::getField($request, 'category', false);
            $configKey = RequestService::getField($request, 'configKey');

            return $this->service->update($id, $name, $value, $tipeofHTML, $category, $configKey);
        }
    }