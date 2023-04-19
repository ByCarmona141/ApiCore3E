<?php

    namespace App\Service\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Repository\systemPrivilegesRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemPrivilegesRegisterService{
        private systemPrivilegesRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemPrivilegesRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(?string $name, ?string $description): systemPrivileges{
            $systemPrivileges = new systemPrivileges($name, $description);

            $this->repository->save($systemPrivileges);

            $data = [
                'name' => $systemPrivileges->getname(),
                'description' => $systemPrivileges->getdescription()
            ];
            $this->accesoService->create('systemPrivileges', $systemPrivileges->getId(), 2, $data);

            return $systemPrivileges;
        }
    }