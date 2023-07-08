<?php

    namespace App\Api\Action\systemAction;

    use App\Entity\systemAction;
    use App\Service\systemAction\systemActionUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemActionUpdateService $service;

        public function __construct(systemActionUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemAction {
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);

            return $this->service->update($id, $name, $description);
        }
    }