<?php

    namespace App\Api\Action\systemSize;

    use App\Entity\systemSize;
    use App\Service\systemSize\systemSizeRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemSizeRegisterService $service;

        public function __construct(systemSizeRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemSize {
            $name = RequestService::getField($request, 'name', false);
            $type = RequestService::getField($request, 'type', false);

            return $this->service->create($name, $type);
        }
    }