<?php

    namespace App\Service\systemDocument;

    use App\Entity\systemDocument;
    use App\Repository\systemDocumentRepository;
    use App\Service\systemLog\systemLogRegisterService as CelaAccesoRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemDocumentRegisterService {
        private systemDocumentRepository $repository;
        private CelaAccesoRegisterService $accesoService;

        public function __construct(systemDocumentRepository $repository,
                                    CelaAccesoRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(int $idSystemTemplate, ?string $content, ?\DateTime $dateCreate): systemDocument {
            $systemDocument = new systemDocument($idSystemTemplate, $content, $dateCreate);

            $this->repository->save($systemDocument);

            $data = [
                'idSystemTemplate' => $systemDocument->getidSystemTemplate(),
                'content' => $systemDocument->getcontent(),
                'dateCreate' => $systemDocument->getdateCreate()
            ];
            $this->accesoService->create('systemDocument', $systemDocument->getId(), 2, $data);

            return $systemDocument;
        }
    }
