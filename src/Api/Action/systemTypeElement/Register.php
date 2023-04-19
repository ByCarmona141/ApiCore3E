<?php

    namespace App\Api\Action\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Service\systemTypeElement\systemTypeElementRegisterService;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class Register{
        private systemTypeElementRegisterService $service;

        public function __construct(systemTypeElementRegisterService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(Request $request): systemTypeElement{
            $name = RequestService::getField($request, 'name', false);

            return $this->service->create($name);
        }
    }