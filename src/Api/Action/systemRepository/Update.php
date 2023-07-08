<?php

    namespace App\Api\Action\systemRepository;

    use App\Entity\systemRepository;
    use App\Service\systemRepository\systemRepositoryUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemRepositoryUpdateService $service;

        public function __construct(systemRepositoryUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemRepository {
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);
            $size = RequestService::getField($request, 'size', false);
            $entity = RequestService::getField($request, 'entity', false);
            $tuple = RequestService::getField($request, 'tuple', false);
            $route = RequestService::getField($request, 'route', false);

            return $this->service->update($id, $name, $description, $size, $entity, $tuple, $route);
        }
    }