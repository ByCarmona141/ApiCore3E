<?php

    namespace App\Service\systemIcon;

    use App\Entity\systemIcon;
    use App\Repository\systemIconRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemIconRegisterService{
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
        public function create(?string $name): systemIcon{
            $systemIcon = new systemIcon($name);

            $this->repository->save($systemIcon);

            $data = [
                'name' => $systemIcon->getname()
            ];
            $this->accesoService->create('systemIcon', $systemIcon->getId(), 2, $data);

            return $systemIcon;
        }
    }