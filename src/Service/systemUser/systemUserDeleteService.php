<?php

    namespace App\Service\systemUser;

    use App\Entity\systemUser;
    use App\Repository\systemUserRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemUserDeleteService{
        private systemUserRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemUserRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemUser{
            $systemUser = $this->repository->findById($id);
            $data = [
                'user' => $systemUser->getuser(),
                'password' => $systemUser->getpassword(),
                'email' => $systemUser->getemail(),
                'selfie' => $systemUser->getselfie(),
                'tag' => $systemUser->gettag(),
                'fullName' => $systemUser->getfullName(),
                'address' => $systemUser->getaddress(),
                'phone' => $systemUser->getphone(),
                'area' => $systemUser->getarea(),
                'idOffice' => $systemUser->getidOffice(),
                'idSystemUserStatus' => $systemUser->getidSystemUserStatus(),
                'idSystemRole' => $systemUser->getidSystemRole(),
                'idEmployee' => $systemUser->getidEmployee(),
                'tries' => $systemUser->gettries(),
                'position' => $systemUser->getposition(),
                'skype' => $systemUser->getskype()
            ];

            $this->repository->removeEntity($systemUser);

            $this->accesoService->create('systemUser', $id, 3, $data);

            return $systemUser;
        }
    }