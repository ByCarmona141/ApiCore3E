<?php

    namespace App\Api\Action\systemUser;

    use App\Entity\systemUser;
    use App\Service\systemUser\systemUserUpdateService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Update{
        private systemUserUpdateService $service;

        public function __construct(systemUserUpdateService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id, Request $request): systemUser{
            $user = RequestService::getField($request, 'user', false);
            $password = RequestService::getField($request, 'password', false);
            $email = RequestService::getField($request, 'email', false);
            $selfie = RequestService::getField($request, 'selfie', false);
            $tag = RequestService::getField($request, 'tag', false);
            $fullName = RequestService::getField($request, 'fullName', false);
            $address = RequestService::getField($request, 'address', false);
            $phone = RequestService::getField($request, 'phone', false);
            $area = RequestService::getField($request, 'area', false);
            $idOffice = RequestService::getField($request, 'idOffice', false);
            $idSystemUserStatus = RequestService::getField($request, 'idSystemUserStatus', false);
            $idSystemRole = RequestService::getField($request, 'idSystemRole', false);
            $idEmployee = RequestService::getField($request, 'idEmployee', false);
            $tries = RequestService::getField($request, 'tries', false);
            $position = RequestService::getField($request, 'position', false);
            $skype = RequestService::getField($request, 'skype', false);

            return $this->service->update($id, $user, $password, $email, $selfie, $tag, $fullName, $address, $phone, $area, $idOffice, $idSystemUserStatus, $idSystemRole, $idEmployee, $tries, $position, $skype);
        }
    }