<?php

    namespace App\Service\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Repository\systemTemplateFrontPageRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateFrontPageDataService {
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
        public function data(int $id): systemTemplateFrontPage {
            $systemTemplateFrontPage = $this->repository->findById($id);

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

            $this->accesoService->create('systemTemplateFrontPage', $id, 4, $data);

            return $systemTemplateFrontPage;
        }
    }
