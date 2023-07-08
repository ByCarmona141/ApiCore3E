<?php

    namespace App\Service\systemUserStatus;

    use App\Entity\systemUserStatus;
    use App\Repository\systemUserStatusRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemUserStatusRegisterService {
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
        public function create(?string $name, ?string $description, ?int $active): systemUserStatus {
            $systemUserStatus = new systemUserStatus($name, $description, $active);

            $this->repository->save($systemUserStatus);

            $data = [
                'name' => $systemUserStatus->getname(),
                'description' => $systemUserStatus->getdescription(),
                'active' => $systemUserStatus->getactive()
            ];
            $this->accesoService->create('systemUserStatus', $systemUserStatus->getId(), 2, $data);

            return $systemUserStatus;
        }
    }