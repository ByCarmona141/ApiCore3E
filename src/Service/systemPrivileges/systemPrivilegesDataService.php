<?php

    namespace App\Service\systemPrivileges;

    use App\Entity\systemPrivileges;
    use App\Repository\systemPrivilegesRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemPrivilegesDataService {
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
        public function data(int $id): systemPrivileges {
            $systemPrivileges = $this->repository->findById($id);
            $data = [
                'name' => $systemPrivileges->getname(),
                'description' => $systemPrivileges->getdescription()
            ];

            $this->accesoService->create('systemPrivileges', $id, 4, $data);

            return $systemPrivileges;
        }
    }