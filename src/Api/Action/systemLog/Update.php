<?php

    namespace App\Api\Action\systemLog;

    use App\Entity\systemLog;
    use App\Service\systemLog\systemLogUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update {
        private systemLogUpdateService $service;

        public function __construct(systemLogUpdateService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemLog {
            $entity = RequestService::getField($request, 'entity', false);
            $tuple = RequestService::getField($request, 'tuple', false);
            $date = RequestService::getField($request, 'date', false);
            $data = RequestService::getField($request, 'data', false);
            $idSystemUser = RequestService::getField($request, 'idSystemUser', false);
            $idSystemAction = RequestService::getField($request, 'idSystemAction', false);
            $ipAddress = RequestService::getField($request, 'ipAddress', false);
            $agent = RequestService::getField($request, 'agent', false);
            $form = RequestService::getField($request, 'form', false);

            return $this->service->update($id, $entity, $tuple, $date, $data, $idSystemUser, $idSystemAction, $ipAddress, $agent, $form);
        }
    }