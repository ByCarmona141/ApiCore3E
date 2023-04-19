<?php

    namespace App\Service\systemIcon;

    use App\Entity\systemIcon;
    use App\Repository\systemIconRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemIconUpdateService{
        private systemIconRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemIconRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name): systemIcon{
            $systemIcon = $this->repository->findById($id);
            $systemIcon->setname($name);
            $this->repository->save($systemIcon);

            $data = [
                'name' => $systemIcon->getname()
            ];
            $this->accesoService->create('systemIcon', $id, 5, $data);

            return $systemIcon;
        }
    }