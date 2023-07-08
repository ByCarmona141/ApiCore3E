<?php
    
    namespace App\Api\Action\systemCore;
    
    use Doctrine\DBAL\Exception;
    use Doctrine\DBAL\Driver\Exception as ExceptionDriver;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    
    class Combo {
        private EntityManagerInterface $entityManager;
        
        public function __construct(EntityManagerInterface $entityManager) {
            $this->entityManager = $entityManager;
        }
        
        /**
         * @Route("/api/{serveSource}/combo/{inText?false}", methods={"GET"})
         * @param Request $request
         * @return JsonResponse
         * @throws Exception
         * @throws ExceptionDriver
         */
        public function comboController(Request $request): JsonResponse {
            $source = $request->get('serveSource');
            $inText = $request->get('inText');
            
            if($inText == 'false') {
                $inText = false;
            }
            
            $model = '\\App\\Model\\' . $source . "Model";
            $Class = new $model;
            
            $config = $Class->combo($inText);
            
            $data = $this->entityManager->getConnection()->executeQuery($config)->fetchAllNumeric();
            $data = json_encode($this->entityManager->getConnection()->executeQuery($config)->fetchAllNumeric(), JSON_NUMERIC_CHECK);
            return JsonResponse::fromJsonString($data);
        }
    }