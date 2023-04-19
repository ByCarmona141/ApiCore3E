<?php

    namespace App\Api\Action\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Service\systemPrivileges\systemPrivilegesUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemPrivilegesUpdateService $service;

        public function __construct(systemPrivilegesUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemPrivileges{
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);

            return $this->service->update($id, $name, $description);
        }
    }