<?php

    namespace App\Api\Action\systemIcon;

    use App\Entity\systemIcon;
    use App\Service\systemIcon\systemIconRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemIconRegisterService $service;

        public function __construct(systemIconRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemIcon {
            $name = RequestService::getField($request, 'name', false);

            return $this->service->create($name);
        }
    }