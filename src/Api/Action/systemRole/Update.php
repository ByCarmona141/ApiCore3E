<?php

    namespace App\Api\Action\systemRole;

    use App\Entity\systemRole;
    use App\Service\systemRole\systemRoleUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemRoleUpdateService $service;

        public function __construct(systemRoleUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemRole{
            $name = RequestService::getField($request, 'name', false);
            $active = RequestService::getField($request, 'active', false);

            return $this->service->update($id, $name, $active);
        }
    }