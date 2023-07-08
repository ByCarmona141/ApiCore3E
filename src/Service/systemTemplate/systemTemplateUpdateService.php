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
        public function update(int $id, string $name, ?string $json, ?string $header, string $body, ?string $footer, int $orientation, int $size, ?int $headerSpacing, ?int $footerSpacing, ?string $frontPage, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom, ?string $script): systemTemplate {
            $systemTemplate = $this->repository->findById($id);
            
            $systemTemplate->setName($name);
            $systemTemplate->setJson($json);
            $systemTemplate->setHeader($header);
            $systemTemplate->setBody($body);
            $systemTemplate->setFooter($footer);
            $systemTemplate->setOrientation($orientation);
            $systemTemplate->setSize($size);
            $systemTemplate->setHeaderSpacing($headerSpacing);
            $systemTemplate->setFooterSpacing($footerSpacing);
            $systemTemplate->setFrontPage($frontPage);
            $systemTemplate->setScript($script);
            $systemTemplate->setMarginLeft($marginLeft);
            $systemTemplate->setMarginRight($marginRight);
            $systemTemplate->setMarginTop($marginTop);
            $systemTemplate->setMarginBottom($marginBottom);

            $this->repository->save($systemTemplate);

            $data = [
                'name' => $systemTemplate->getName(),
                'json' => $systemTemplate->getJson(),
                'header' => $systemTemplate->getHeader(),
                'body' => $systemTemplate->getBody(),
                'footer' => $systemTemplate->getFooter(),
                'orientation' => $systemTemplate->getOrientation(),
                'size' => $systemTemplate->getSize(),
                'headerSpacing' => $systemTemplate->getHeaderSpacing(),
                'footerSpacing' => $systemTemplate->getFooterSpacing(),
                'frontPage' => $systemTemplate->getFrontPage(),
                'marginLeft' => $systemTemplate->getMarginLeft(),
                'marginRight' => $systemTemplate->getMarginRight(),
                'marginTop' => $systemTemplate->getMarginTop(),
                'marginBottom' => $systemTemplate->getMarginBottom(),
                'script' => $systemTemplate->getScript()
            ];
            $this->accesoService->create('systemTemplate', $id, 5, $data);

            return $systemTemplate;
        }
    }
