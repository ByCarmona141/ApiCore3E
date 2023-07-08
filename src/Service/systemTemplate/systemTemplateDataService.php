<?php

    namespace App\Service\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Repository\systemTemplateRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateDataService {
        private systemTemplateRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemTemplateRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemTemplate {
            $systemTemplate = $this->repository->findById($id);
            $data = [
                'name' => $systemTemplate->getname(),
                'json' => $systemTemplate->getjson(),
                'header' => $systemTemplate->getheader(),
                'body' => $systemTemplate->getbody(),
                'footer' => $systemTemplate->getfooter(),
                'orientation' => $systemTemplate->getorientation(),
                'size' => $systemTemplate->getsize(),
                'headerSpacing' => $systemTemplate->getheaderSpacing(),
                'footerSpacing' => $systemTemplate->getfooterSpacing(),
                'frontPage' => $systemTemplate->getfrontPage(),
                'script' => $systemTemplate->getscript()
            ];

            $this->accesoService->create('systemTemplate', $id, 4, $data);

            return $systemTemplate;
        }
    }
