<?php

    namespace App\Service\systemLog;

    use App\Entity\systemLog;
    use App\Repository\systemLogRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemLogDataService {
        private systemLogRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemLogRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemLog {
            $systemLog = $this->repository->findById($id);
            $data = [
                'entity' => $systemLog->getentity(),
                'tuple' => $systemLog->gettuple(),
                'date' => $systemLog->getdate(),
                'data' => $systemLog->getdata(),
                'idSystemUser' => $systemLog->getidSystemUser(),
                'idSystemAction' => $systemLog->getidSystemAction(),
                'ipAddress' => $systemLog->getipAddress(),
                'agent' => $systemLog->getagent(),
                'form' => $systemLog->getform()
            ];

            $this->accesoService->create('systemLog', $id, 4, $data);

            return $systemLog;
        }
    }