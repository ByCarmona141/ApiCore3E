<?php

    namespace App\Service\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Repository\systemUserStatusRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemUserStatusUpdateService {
        private systemUserStatusRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemUserStatusRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name, ?string $description, ?int $active): systemUserStatus {
            $systemUserStatus = $this->repository->findById($id);
            $systemUserStatus->setname($name);
            $systemUserStatus->setdescription($description);
            $systemUserStatus->setactive($active);
            $this->repository->save($systemUserStatus);

            $data = [
                'name' => $systemUserStatus->getname(),
                'description' => $systemUserStatus->getdescription(),
                'active' => $systemUserStatus->getactive()
            ];
            $this->accesoService->create('systemUserStatus', $id, 5, $data);

            return $systemUserStatus;
        }
    }