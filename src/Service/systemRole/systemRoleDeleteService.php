<?php

    namespace App\Service\systemRole;

    use App\Entity\systemRole;
    use App\Repository\systemRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRoleDeleteService {
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
        public function delete(int $id): systemRole {
            $systemRole = $this->repository->findById($id);
            $data = [
                'name' => $systemRole->getname(),
                'active' => $systemRole->getactive()
            ];

            $this->repository->removeEntity($systemRole);

            $this->accesoService->create('systemRole', $id, 3, $data);

            return $systemRole;
        }
    }