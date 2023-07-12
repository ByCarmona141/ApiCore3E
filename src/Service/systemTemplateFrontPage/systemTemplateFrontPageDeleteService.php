<?php

    namespace App\Service\systemTemplateFrontPage;

    use App\Entity\systemTemplateFrontPage;
    use App\Repository\systemTemplateFrontPageRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateFrontPageDeleteService {
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
        public function delete(int $id): systemTemplateFrontPage {
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

            $this->repository->removeEntity($systemTemplateFrontPage);

            $this->accesoService->create('systemTemplate', $id, 3, $data);

            return $systemTemplateFrontPage;
        }
    }
