<?php

    namespace App\Service\systemSize;

    use App\Entity\systemSize;
    use App\Repository\systemSizeRepository;
    use App\Service\systemLog\systemLogRegisterService as CelaAccesoRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemSizeDataService {
        private systemSizeRepository $repository;
        private CelaAccesoRegisterService $accesoService;

        public function __construct(systemSizeRepository $repository,
                                    CelaAccesoRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemSize {
            $systemSize = $this->repository->findById($id);
            $data = [
                'name' => $systemSize->getname()
            ];

            $this->accesoService->create('systemSize', $id, 4, $data);

            return $systemSize;
        }
    }
