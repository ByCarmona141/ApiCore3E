<?php

    namespace App\Service\systemIcon;

    use App\Entity\systemIcon;
    use App\Repository\systemIconRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemIconDeleteService {
        private systemIconRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemIconRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemIcon {
            $systemIcon = $this->repository->findById($id);
            $data = [
                'name' => $systemIcon->getname()
            ];

            $this->repository->removeEntity($systemIcon);

            $this->accesoService->create('systemIcon', $id, 3, $data);

            return $systemIcon;
        }
    }