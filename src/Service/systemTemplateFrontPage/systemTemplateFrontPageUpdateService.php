<?php

    namespace App\Service\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Repository\systemTemplateFrontPageRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateFrontPageUpdateService {
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
        public function update(int $id, string $name, ?string $header, string $body, ?string $footer, int $idSystemOrientation, int $idSystemSize, ?int $headerSpacing, ?int $footerSpacing, ?int $marginLeft, ?int $marginRight, ?int $marginTop, ?int $marginBottom): systemTemplateFrontPage {
            $systemTemplateFrontPage = $this->repository->findById($id);
            
            $systemTemplateFrontPage->setName($name);
            $systemTemplateFrontPage->setHeader($header);
            $systemTemplateFrontPage->setBody($body);
            $systemTemplateFrontPage->setFooter($footer);
            $systemTemplateFrontPage->setIdSystemOrientation($idSystemOrientation);
            $systemTemplateFrontPage->setIdSystemSize($idSystemSize);
            $systemTemplateFrontPage->setHeaderSpacing($headerSpacing);
            $systemTemplateFrontPage->setFooterSpacing($footerSpacing);
            $systemTemplateFrontPage->setMarginLeft($marginLeft);
            $systemTemplateFrontPage->setMarginRight($marginRight);
            $systemTemplateFrontPage->setMarginTop($marginTop);
            $systemTemplateFrontPage->setMarginBottom($marginBottom);

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
            $this->accesoService->create('systemTemplateFrontPage', $id, 5, $data);

            return $systemTemplateFrontPage;
        }
    }
