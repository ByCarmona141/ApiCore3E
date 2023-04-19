<?php

    namespace App\Api\Action\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Service\systemPrivileges\systemPrivilegesRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register{
        private systemPrivilegesRegisterService $service;

        public function __construct(systemPrivilegesRegisterService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemPrivileges{
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);

            return $this->service->create($name, $description);
        }
    }