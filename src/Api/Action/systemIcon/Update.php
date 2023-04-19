<?php

    namespace App\Api\Action\systemIcon;

    use App\Entity\systemIcon;
    use App\Service\systemIcon\systemIconUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemIconUpdateService $service;

        public function __construct(systemIconUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemIcon{
            $name = RequestService::getField($request, 'name', false);

            return $this->service->update($id, $name);
        }
    }