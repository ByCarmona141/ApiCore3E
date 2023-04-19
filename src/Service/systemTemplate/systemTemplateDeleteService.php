<?php

    namespace App\Service\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Repository\systemTemplateRepository;
    use App\Service\systemLog\systemLogRegisterService as CelaAccesoRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateDeleteService{
        private systemTemplateRepository $repository;
        private CelaAccesoRegisterService $accesoService;

        public function __construct(systemTemplateRepository $repository,
                                    CelaAccesoRegisterService $accesoService){
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function delete(int $id): systemTemplate{
            $systemTemplate = $this->repository->findById($id);
            $data = [
                'name' => $systemTemplate->getname(),
                'header' => $systemTemplate->getheader(),
                'body' => $systemTemplate->getbody(),
                'footer' => $systemTemplate->getfooter(),
                'orientation' => $systemTemplate->getorientation(),
                'size' => $systemTemplate->getsize(),
                'headerSpacing' => $systemTemplate->getheaderSpacing(),
                'footerSpacing' => $systemTemplate->getfooterSpacing(),
                'frontPage' => $systemTemplate->getfrontPage(),
                'script' => $systemTemplate->getscript(),
                'json' => $systemTemplate->getjson()
            ];

            $this->repository->removeEntity($systemTemplate);

            $this->accesoService->create('systemTemplate', $id, 3, $data);

            return $systemTemplate;
        }
    }
