<?php

    namespace App\Service\systemUser;

    use App\Entity\systemUser;
    use App\Repository\systemUserRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemUserUpdateService {
        private systemUserRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemUserRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $user, ?string $password, ?string $email, ?string $selfie, ?string $tag, ?string $fullName, ?string $address, ?string $phone, ?int $area, ?int $idOffice, ?int $idSystemUserStatus, ?int $idSystemRole, ?int $idEmployee, ?int $tries, ?string $position, ?string $skype): systemUser {
            $systemUser = $this->repository->findById($id);
            
            $systemUser->setuser($user);
            $systemUser->setpassword($password);
            $systemUser->setemail($email);
            $systemUser->setselfie($selfie);
            $systemUser->settag($tag);
            $systemUser->setfullName($fullName);
            $systemUser->setaddress($address);
            $systemUser->setphone($phone);
            $systemUser->setarea($area);
            $systemUser->setidOffice($idOffice);
            $systemUser->setidSystemUserStatus($idSystemUserStatus);
            $systemUser->setidSystemRole($idSystemRole);
            $systemUser->setidEmployee($idEmployee);
            $systemUser->settries($tries);
            $systemUser->setposition($position);
            $systemUser->setskype($skype);
            $this->repository->save($systemUser);

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
            $this->accesoService->create('systemUser', $id, 5, $data);

            return $systemUser;
        }
    }