<?php
    
    namespace App\Api\Action\systemRole;
    
    use App\Service\systemRole\systemRolePrivilegesService;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class Privileges {
        private systemRolePrivilegesService $service;
    
        public function __construct(systemRolePrivilegesService $service) {
            $this->service = $service;
        }
    
        /**
         * @Route("/api/systemRole/{id}/privileges", methods={"GET"})
         */
        public function getPrivileges(int $id): JsonResponse {
            return JsonResponse::fromJsonString(json_encode($this->service->getPrivileges($id), JSON_NUMERIC_CHECK));
        }
    
        /**
         * @Route("/api/systemRole/{id}/privileges", methods={"POST"})
         */
        public function setPrivileges(int $id, Request $request): JsonResponse {
            return JsonResponse::fromJsonString(json_encode($this->service->setPrivileges($id, $request)));
        }
    }