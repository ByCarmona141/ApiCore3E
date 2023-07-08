<?php

    namespace App\Api\Action\systemAction;

    use App\Entity\systemAction;
    use App\Service\systemAction\systemActionRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemActionRegisterService $service;

        public function __construct(systemActionRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemAction {
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);

            return $this->service->create($name, $description);
        }
    }