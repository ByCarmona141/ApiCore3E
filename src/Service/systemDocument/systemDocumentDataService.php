<?php

    namespace App\Service\systemDocument;

    use App\Entity\systemDocument;
    use App\Repository\systemDocumentRepository;
    use App\Service\systemLog\systemLogRegisterService as CelaAccesoRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemDocumentDataService{
        private systemDocumentRepository $repository;
        private CelaAccesoRegisterService $accesoService;

        public function __construct(systemDocumentRepository $repository,
                                    CelaAccesoRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemDocument{
            $systemDocument = $this->repository->findById($id);
            $data = [
                'idSystemTemplate' => $systemDocument->getidSystemTemplate(),
                'content' => $systemDocument->getcontent(),
                'dateCreate' => $systemDocument->getdateCreate()
            ];

            $this->accesoService->create('systemDocument', $id, 4, $data);

            return $systemDocument;
        }
    }
