<?php

    namespace App\Api\Action\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Service\systemTypeElement\systemTypeElementUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemTypeElementUpdateService $service;

        public function __construct(systemTypeElementUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemTypeElement{
            $name = RequestService::getField($request, 'name', false);

            return $this->service->update($id, $name);
        }
    }