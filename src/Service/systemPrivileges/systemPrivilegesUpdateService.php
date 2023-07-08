<?php

    namespace App\Service\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Repository\systemPrivilegesRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemPrivilegesUpdateService {
        private systemPrivilegesRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemPrivilegesRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name, ?string $description): systemPrivileges {
            $systemPrivileges = $this->repository->findById($id);
            $systemPrivileges->setname($name);
            $systemPrivileges->setdescription($description);
            $this->repository->save($systemPrivileges);

            $data = [
                'name' => $systemPrivileges->getname(),
                'description' => $systemPrivileges->getdescription()
            ];
            $this->accesoService->create('systemPrivileges', $id, 5, $data);

            return $systemPrivileges;
        }
    }