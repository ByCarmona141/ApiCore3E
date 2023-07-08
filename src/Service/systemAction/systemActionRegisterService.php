<?php

    namespace App\Service\systemAction;

    use App\Entity\systemAction;
    use App\Repository\systemActionRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemActionRegisterService {
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
        public function create(?string $name, ?string $description): systemAction {
            $systemAction = new systemAction($name, $description);

            $this->repository->save($systemAction);

            $data = [
                'name' => $systemAction->getname(),
                'description' => $systemAction->getdescription()
            ];
            $this->accesoService->create('systemAction', $systemAction->getId(), 2, $data);

            return $systemAction;
        }
    }