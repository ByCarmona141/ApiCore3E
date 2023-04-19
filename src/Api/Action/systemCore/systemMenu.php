<?php
    
    namespace App\Api\Action\systemCore;
    
    use App\Service\systemMenu\systemMenuMenuService;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    
    class systemMenu{
        
        private systemMenuMenuService $service;
        
        public function __construct(systemMenuMenuService $service){
            $this->service = $service;
        }
        
        /**
         * @Route("/api/systemMenu/menu/{role}", methods={"GET"})
         * @param Request $request
         * @return JsonResponse
         */
        public function getMen_u(Request $request): JsonResponse{
            return new JsonResponse($this->service->getMenu($request));
        }
    }