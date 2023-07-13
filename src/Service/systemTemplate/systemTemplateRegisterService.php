<?php

    namespace App\Service\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Repository\systemTemplateRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateRegisterService {
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
        public function create(string $name, ?string $json, ?string $header, string $body, ?string $footer, int $idSystemOrientation, int $idSystemSize, ?int $headerSpacing, ?int $footerSpacing, ?int $idSystemFrontPage, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom, ?string $script, ?int $paginate): systemTemplate {
            $systemTemplate = new systemTemplate($name, $json, $header, $body, $footer, $idSystemOrientation, $idSystemSize, $headerSpacing, $footerSpacing, $idSystemFrontPage, $marginLeft, $marginRight, $marginTop, $marginBottom, $script, $paginate);

            $this->repository->save($systemTemplate);

            $data = [
                'name' => $systemTemplate->getName(),
                'json' => $systemTemplate->getJson(),
                'header' => $systemTemplate->getHeader(),
                'body' => $systemTemplate->getBody(),
                'footer' => $systemTemplate->getFooter(),
                'idSystemOrientation' => $systemTemplate->getIdSystemOrientation(),
                'idSystemSize' => $systemTemplate->getIdSystemSize(),
                'headerSpacing' => $systemTemplate->getheaderSpacing(),
                'footerSpacing' => $systemTemplate->getfooterSpacing(),
                'idSystemFrontPage' => $systemTemplate->getIdSystemFrontPage(),
                'script' => $systemTemplate->getScript(),
                'marginLeft' => $systemTemplate->getMarginLeft(),
                'marginRight' => $systemTemplate->getMarginRight(),
                'marginTop' => $systemTemplate->getMarginTop(),
                'marginBottom' => $systemTemplate->getMarginBottom(),
                'paginate' => $systemTemplate->getPaginate()
            ];
            $this->accesoService->create('systemTemplate', $systemTemplate->getId(), 2, $data);

            return $systemTemplate;
        }
    }
