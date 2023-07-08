<?php

    namespace App\Service\systemRole;

    use App\Entity\systemRole;
    use App\Repository\systemRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemRoleRegisterService {
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
        public function create(?string $name, ?int $active): systemRole {
            $systemRole = new systemRole($name, $active);

            $this->repository->save($systemRole);

            $data = [
                'name' => $systemRole->getname(),
                'active' => $systemRole->getactive()
            ];
            $this->accesoService->create('systemRole', $systemRole->getId(), 2, $data);

            return $systemRole;
        }
    }