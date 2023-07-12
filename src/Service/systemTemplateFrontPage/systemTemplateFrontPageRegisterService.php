<?php

    namespace App\Service\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Repository\systemTemplateFrontPageRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateFrontPageRegisterService {
        private systemTemplateFrontPageRepository $repository;
        private systemLogRegisterService $accesoService;

        public function __construct(systemTemplateFrontPageRepository $repository,
                                    systemLogRegisterService $accesoService) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(string $name, ?string $header, string $body, ?string $footer, int $idSystemOrientation, int $idSystemSize, ?int $headerSpacing, ?int $footerSpacing, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom): systemTemplateFrontPage {
            $systemTemplateFrontPage = new systemTemplateFrontPage($name, $header, $body, $footer, $idSystemOrientation, $idSystemSize, $headerSpacing, $footerSpacing, $marginLeft, $marginRight, $marginTop, $marginBottom);

            $this->repository->save($systemTemplateFrontPage);

            $data = [
                'name' => $systemTemplateFrontPage->getName(),
                'header' => $systemTemplateFrontPage->getHeader(),
                'body' => $systemTemplateFrontPage->getBody(),
                'footer' => $systemTemplateFrontPage->getFooter(),
                'idSystemOrientation' => $systemTemplateFrontPage->getIdSystemOrientation(),
                'idSystemSize' => $systemTemplateFrontPage->getIdSystemSize(),
                'headerSpacing' => $systemTemplateFrontPage->getHeaderSpacing(),
                'footerSpacing' => $systemTemplateFrontPage->getFooterSpacing(),
                'marginLeft' => $systemTemplateFrontPage->getMarginLeft(),
                'marginRight' => $systemTemplateFrontPage->getMarginRight(),
                'marginTop' => $systemTemplateFrontPage->getMarginTop(),
                'marginBottom' => $systemTemplateFrontPage->getMarginBottom()
            ];
            $this->accesoService->create('systemTemplateFrontPage', $systemTemplateFrontPage->getId(), 2, $data);

            return $systemTemplateFrontPage;
        }
    }
