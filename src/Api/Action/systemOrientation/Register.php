<?php

    namespace App\Api\Action\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Service\systemOrientation\systemOrientationRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemOrientationRegisterService $service;

        public function __construct(systemOrientationRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemOrientation {
            $name = RequestService::getField($request, 'name', true);
            $type = RequestService::getField($request, 'type', true);

            return $this->service->create($name, $type);
        }
    }