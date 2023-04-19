<?php

    namespace App\Service\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Repository\systemTypeElementRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTypeElementUpdateService{
        private systemTypeElementRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemTypeElementRepository $repository,
                                    systemLogRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name): systemTypeElement{
            $systemTypeElement = $this->repository->findById($id);
            $systemTypeElement->setname($name);
            $this->repository->save($systemTypeElement);

            $data = [
                'name' => $systemTypeElement->getname()
            ];
            $this->accesoService->create('systemTypeElement', $id, 5, $data);

            return $systemTypeElement;
        }
    }