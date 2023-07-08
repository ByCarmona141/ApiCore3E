<?php

    namespace App\Service\systemRole;

    use App\Entity\systemRole;
    use App\Repository\systemRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRoleUpdateService {
        private systemRoleRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemRoleRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name, ?int $active): systemRole {
            $systemRole = $this->repository->findById($id);
            $systemRole->setname($name);
            $systemRole->setactive($active);
            $this->repository->save($systemRole);

            $data = [
                'name' => $systemRole->getname(),
                'active' => $systemRole->getactive()
            ];
            $this->accesoService->create('systemRole', $id, 5, $data);

            return $systemRole;
        }
    }