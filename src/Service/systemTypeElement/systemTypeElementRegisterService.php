<?php

    namespace App\Service\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Repository\systemTypeElementRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTypeElementRegisterService {
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
        public function create(?string $name): systemTypeElement {
            $systemTypeElement = new systemTypeElement($name);

            $this->repository->save($systemTypeElement);

            $data = [
                'name' => $systemTypeElement->getname()
            ];
            $this->accesoService->create('systemTypeElement', $systemTypeElement->getId(), 2, $data);

            return $systemTypeElement;
        }
    }