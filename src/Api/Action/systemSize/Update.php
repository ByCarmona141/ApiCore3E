<?php

    namespace App\Api\Action\systemSize;

    use App\Entity\systemSize;
    use App\Service\systemSize\systemSizeUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemSizeUpdateService $service;

        public function __construct(systemSizeUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemSize {
            $name = RequestService::getField($request, 'name', false);
            $type = RequestService::getField($request, 'type', false);

            return $this->service->update($id, $name, $type);
        }
    }