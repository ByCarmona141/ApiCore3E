<?php

    namespace App\Api\Action\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Service\systemUserStatus\systemUserStatusUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemUserStatusUpdateService $service;

        public function __construct(systemUserStatusUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemUserStatus {
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);
            $active = RequestService::getField($request, 'active', false);

            return $this->service->update($id, $name, $description, $active);
        }
    }