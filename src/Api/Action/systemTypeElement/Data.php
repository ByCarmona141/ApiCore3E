<?php

    namespace App\Api\Action\systemTypeElement;

    use App\Entity\systemTypeElement;
    use App\Service\systemTypeElement\systemTypeElementDataService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;

    class Data{
        private systemTypeElementDataService $service;

        public function __construct(systemTypeElementDataService $service){
            $this->service = $service;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function __invoke(int $id): systemTypeElement{
            return $this->service->data($id);
        }
    }