<?php

    namespace App\Service\systemConfig;

    use App\Entity\systemConfig;
    use App\Repository\systemConfigRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemConfigDataService{
        private systemConfigRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemConfigRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemConfig{
            $systemConfig = $this->repository->findById($id);
            $data = [
                'name' => $systemConfig->getname(),
                'value' => $systemConfig->getvalue(),
                'tipeofHTML' => $systemConfig->gettipeofHTML(),
                'category' => $systemConfig->getcategory(),
                'configKey' => $systemConfig->getconfigKey()
            ];

            $this->accesoService->create('systemConfig', $id, 4, $data);

            return $systemConfig;
        }
    }