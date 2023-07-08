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
        public function create(string $name, ?string $json, ?string $header, string $body, ?string $footer, int $orientation, int $size, ?int $headerSpacing, ?int $footerSpacing, ?string $frontPage, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom, ?string $script): systemTemplate {
            $systemTemplate = new systemTemplate($name, $json, $header, $body, $footer, $orientation, $size, $headerSpacing, $footerSpacing, $frontPage, $marginLeft, $marginRight, $marginTop, $marginBottom, $script);

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
            $this->accesoService->create('systemTemplate', $systemTemplate->getId(), 2, $data);

            return $systemTemplate;
        }
    }
