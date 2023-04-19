<?php
    
    declare(strict_types=1);
    
    
    namespace App\Api\Action\systemTypeElement;
    
    use App\Service\systemCore\Datatable;
    use App\Model\systemTypeElementModel;
    use Doctrine\DBAL\Driver\Exception as ExceptionDBAL;
    use Doctrine\DBAL\Exception;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;

    class Table{
        private Datatable $datatable;
        private systemTypeElementModel $model;
    
        public function __construct(Datatable $datatable, systemTypeElementModel $model){
            $this->datatable = $datatable;
            $this->model = $model;
        }
    
        /**
         * @throws Exception
         * @throws ExceptionDBAL
         */
        public function __invoke(Request $request, string $serveFunction): JsonResponse{
            return $this->datatable->datatableController($request, $this->model, $serveFunction);
        }
    }