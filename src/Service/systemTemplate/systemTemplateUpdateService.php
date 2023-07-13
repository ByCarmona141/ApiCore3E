<?php

    namespace App\Service\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Repository\systemTemplateRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateUpdateService {
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
        public function update(int $id, string $name, ?string $json, ?string $header, string $body, ?string $footer, int $idSystemOrientation, int $idSystemSize, ?int $headerSpacing, ?int $footerSpacing, ?int $idSystemFrontPage, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom, ?string $script, ?int $paginate): systemTemplate {
            $systemTemplate = $this->repository->findById($id);
            
            $systemTemplate->setName($name);
            $systemTemplate->setJson($json);
            $systemTemplate->setHeader($header);
            $systemTemplate->setBody($body);
            $systemTemplate->setFooter($footer);
            $systemTemplate->setIdSystemOrientation($idSystemOrientation);
            $systemTemplate->setIdSystemSize($idSystemSize);
            $systemTemplate->setHeaderSpacing($headerSpacing);
            $systemTemplate->setFooterSpacing($footerSpacing);
            $systemTemplate->setIdSystemFrontPage($idSystemFrontPage);
            $systemTemplate->setScript($script);
            $systemTemplate->setMarginLeft($marginLeft);
            $systemTemplate->setMarginRight($marginRight);
            $systemTemplate->setMarginTop($marginTop);
            $systemTemplate->setMarginBottom($marginBottom);
            $systemTemplate->setPaginate($paginate);

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
            $this->accesoService->create('systemTemplate', $id, 5, $data);

            return $systemTemplate;
        }
    }
