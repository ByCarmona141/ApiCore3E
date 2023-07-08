<?php

    namespace App\Service\systemDocument;

    use App\Entity\systemDocument;
    use App\Repository\systemDocumentRepository;
    use App\Service\systemLog\systemLogRegisterService as CelaAccesoRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemDocumentUpdateService {
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
        public function update(int $id, int $idSystemTemplate, ?string $content, ?\DateTime $dateCreate): systemDocument {
            $systemDocument = $this->repository->findById($id);
            $systemDocument->setidSystemTemplate($idSystemTemplate);
            $systemDocument->setcontent($content);
            $systemDocument->setdateCreate($dateCreate);
            $this->repository->save($systemDocument);

            $data = [
                'idSystemTemplate' => $systemDocument->getidSystemTemplate(),
                'content' => $systemDocument->getcontent(),
                'dateCreate' => $systemDocument->getdateCreate()
            ];
            $this->accesoService->create('systemDocument', $id, 5, $data);

            return $systemDocument;
        }
    }
