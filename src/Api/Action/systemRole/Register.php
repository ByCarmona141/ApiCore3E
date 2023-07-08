<?php

    namespace App\Api\Action\systemRole;

    use App\Entity\systemRole;
    use App\Service\systemRole\systemRoleRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemRoleRegisterService $service;

        public function __construct(systemRoleRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemRole {
            $name = RequestService::getField($request, 'name', false);
            $active = RequestService::getField($request, 'active', false);

            return $this->service->create($name, $active);
        }
    }