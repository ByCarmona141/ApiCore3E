<?php

    namespace App\Service\systemMenu;

    use App\Entity\systemMenu;
    use App\Repository\systemMenuRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemMenuDeleteService {
        private systemMenuRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemMenuRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemMenu {
            $systemMenu = $this->repository->findById($id);
            $data = [
                'name' => $systemMenu->getname(),
                'description' => $systemMenu->getdescription(),
                'href' => $systemMenu->gethref(),
                'idSystemIcon' => $systemMenu->getidSystemIcon(),
                'category' => $systemMenu->getcategory(),
                'priority' => $systemMenu->getpriority(),
                'idSystemTypeElement' => $systemMenu->getidSystemTypeElement()
            ];

            $this->repository->removeEntity($systemMenu);

            $this->accesoService->create('systemMenu', $id, 3, $data);

            return $systemMenu;
        }
    }