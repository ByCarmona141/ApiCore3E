<?php

    namespace App\Service\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Repository\systemTypeElementRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTypeElementDataService {
        private systemTypeElementRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemTypeElementRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemTypeElement {
            $systemTypeElement = $this->repository->findById($id);
            $data = [
                'name' => $systemTypeElement->getname()
            ];

            $this->accesoService->create('systemTypeElement', $id, 4, $data);

            return $systemTypeElement;
        }
    }