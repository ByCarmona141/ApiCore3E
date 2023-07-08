<?php

    namespace App\Service\systemConfig;

    use App\Entity\systemConfig;
    use App\Repository\systemConfigRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemConfigRegisterService {
        private systemConfigRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemConfigRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(?string $name, ?string $value, ?string $tipeofHTML, ?int $category, string $configKey): systemConfig {
            $systemConfig = new systemConfig($name, $value, $tipeofHTML, $category, $configKey);

            $this->repository->save($systemConfig);

            $data = [
                'name' => $systemConfig->getname(),
                'value' => $systemConfig->getvalue(),
                'tipeofHTML' => $systemConfig->gettipeofHTML(),
                'category' => $systemConfig->getcategory(),
                'configKey' => $systemConfig->getconfigKey()
            ];
            $this->accesoService->create('systemConfig', $systemConfig->getId(), 2, $data);

            return $systemConfig;
        }
    }