<?php

    namespace App\Api\Action\systemRepository;

    use App\Entity\systemRepository;
    use App\Service\systemRepository\systemRepositoryRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register{
        private systemRepositoryRegisterService $service;

        public function __construct(systemRepositoryRegisterService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemRepository{
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);
            $size = RequestService::getField($request, 'size', false);
            $entity = RequestService::getField($request, 'entity', false);
            $tuple = RequestService::getField($request, 'tuple', false);
            $route = RequestService::getField($request, 'route', false);

            return $this->service->create($name, $description, $size, $entity, $tuple, $route);
        }
    }