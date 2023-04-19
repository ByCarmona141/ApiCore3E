<?php

    namespace App\Api\Action\systemConfig;

    use App\Entity\systemConfig;
    use App\Service\systemConfig\systemConfigRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register{
        private systemConfigRegisterService $service;

        public function __construct(systemConfigRegisterService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemConfig{
            $name = RequestService::getField($request, 'name', false);
            $value = RequestService::getField($request, 'value', false);
            $tipeofHTML = RequestService::getField($request, 'tipeofHTML', false);
            $category = RequestService::getField($request, 'category', false);
            $configKey = RequestService::getField($request, 'configKey');

            return $this->service->create($name, $value, $tipeofHTML, $category, $configKey);
        }
    }