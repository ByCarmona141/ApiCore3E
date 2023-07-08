<?php

    namespace App\Api\Action\systemMenu;

    use App\Entity\systemMenu;
    use App\Service\systemMenu\systemMenuRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register {
        private systemMenuRegisterService $service;

        public function __construct(systemMenuRegisterService $service) {
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemMenu {
            $name = RequestService::getField($request, 'name', false);
            $description = RequestService::getField($request, 'description', false);
            $href = RequestService::getField($request, 'href', false);
            $idSystemIcon = RequestService::getField($request, 'idSystemIcon', false);
            $category = RequestService::getField($request, 'category', false);
            $priority = RequestService::getField($request, 'priority', false);
            $idSystemTypeElement = RequestService::getField($request, 'idSystemTypeElement', false);
            $roles = RequestService::getField($request, 'roles', false);

            return $this->service->create($name, $description, $href, $idSystemIcon, $category, $priority, $idSystemTypeElement, $roles);
        }
    }