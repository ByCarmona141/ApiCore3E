<?php

    namespace App\Service\systemTemplate;

    use App\Entity\systemTemplate;
    use App\Repository\systemTemplateRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class systemTemplateDataJsonService {
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
        public function dataJson(int $id): array {
            $systemTemplate = $this->repository->findById($id);

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

            $this->accesoService->create('systemTemplate', $id, 4, $data);

            if(!empty($systemTemplate->getJson())) {
                return json_decode($systemTemplate->getJson(), true);
            } else {
                return [];
            }
        }
    }
