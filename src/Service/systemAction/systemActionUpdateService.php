<?php

    namespace App\Service\systemAction;

    use App\Entity\systemAction;
    use App\Repository\systemActionRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemActionUpdateService {
        private systemActionRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemActionRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name, ?string $description): systemAction {
            $systemAction = $this->repository->findById($id);
            $systemAction->setname($name);
            $systemAction->setdescription($description);
            $this->repository->save($systemAction);

            $data = [
                'name' => $systemAction->getname(),
                'description' => $systemAction->getdescription()
            ];
            $this->accesoService->create('systemAction', $id, 5, $data);

            return $systemAction;
        }
    }