<?php

    namespace App\Api\Action\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Service\systemUserStatus\systemUserStatusRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemUserStatusRegisterService $service;

        public function __construct(systemUserStatusRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemUserStatus {
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);
            $active = RequestService::getField($request, 'active', false);

            return $this->service->create($name, $description, $active);
        }
    }