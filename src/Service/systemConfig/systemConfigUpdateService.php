<?php

    namespace App\Service\systemConfig;

    use App\Entity\systemConfig;
    use App\Repository\systemConfigRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemConfigUpdateService{
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
        public function update(int $id, ?string $name, ?string $value, ?string $tipeofHTML, ?int $category, string $configKey): systemConfig{
            $systemConfig = $this->repository->findById($id);
            $systemConfig->setname($name);
            $systemConfig->setvalue($value);
            $systemConfig->settipeofHTML($tipeofHTML);
            $systemConfig->setcategory($category);
            $systemConfig->setconfigKey($configKey);
            $this->repository->save($systemConfig);

            $data = [
                'name' => $systemConfig->getname(),
                'value' => $systemConfig->getvalue(),
                'tipeofHTML' => $systemConfig->gettipeofHTML(),
                'category' => $systemConfig->getcategory(),
                'configKey' => $systemConfig->getconfigKey()
            ];
            $this->accesoService->create('systemConfig', $id, 5, $data);

            return $systemConfig;
        }
    }