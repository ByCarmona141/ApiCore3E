<?php

    namespace App\Api\Action\systemOrientation;

    use App\Entity\systemOrientation;
    use App\Service\systemOrientation\systemOrientationUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemOrientationUpdateService $service;

        public function __construct(systemOrientationUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemOrientation {
            $name = RequestService::getField($request, 'name', false);
            $type = RequestService::getField($request, 'type', false);

            return $this->service->update($id, $name, $type);
        }
    }