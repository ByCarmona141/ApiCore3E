<?php

    namespace App\Service\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Repository\systemTemplateRepository;
    use App\Service\systemLog\systemLogRegisterService as CelaAccesoRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateUpdateService{
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
        public function update(int $id, ?string $name, ?string $header, ?string $body, ?string $footer, ?string $orientation, ?string $size, ?int $headerSpacing, ?int $footerSpacing, ?int $frontPage, ?string $script, ?string $json): systemTemplate{
            $systemTemplate = $this->repository->findById($id);
            $systemTemplate->setname($name);
            $systemTemplate->setheader($header);
            $systemTemplate->setbody($body);
            $systemTemplate->setfooter($footer);
            $systemTemplate->setorientation($orientation);
            $systemTemplate->setsize($size);
            $systemTemplate->setheaderSpacing($headerSpacing);
            $systemTemplate->setfooterSpacing($footerSpacing);
            $systemTemplate->setfrontPage($frontPage);
            $systemTemplate->setscript($script);
            $systemTemplate->setjson($json);
            $this->repository->save($systemTemplate);

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
            $this->accesoService->create('systemTemplate', $id, 5, $data);

            return $systemTemplate;
        }
    }
