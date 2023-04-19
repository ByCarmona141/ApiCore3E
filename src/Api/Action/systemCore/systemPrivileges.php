<?php
    
    namespace App\Api\Action\systemCore;
    
    use App\Repository\systemMenuRepository;
    use App\Repository\systemPrivilegesRepository;
    use App\Repository\systemPrivilegesUserRoleRepository;
    use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
    use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
    
    class systemPrivileges
    {
        
        private systemMenuRepository               $menuRepository;
        private systemPrivilegesUserRoleRepository $repository;
        private JWTTokenManagerInterface           $JWTTokenManager;
        private TokenStorageInterface              $tokenStorage;
        private systemPrivilegesRepository         $privilegesRepository;
        
        public function __construct(systemMenuRepository               $menuRepository,
                                    systemPrivilegesUserRoleRepository $repository,
                                    systemPrivilegesRepository         $privilegesRepository,
                                    JWTTokenManagerInterface           $JWTTokenManager,
                                    TokenStorageInterface              $tokenStorage)
        {
            $this->menuRepository = $menuRepository;
            $this->repository = $repository;
            $this->JWTTokenManager = $JWTTokenManager;
            $this->tokenStorage = $tokenStorage;
            $this->privilegesRepository = $privilegesRepository;
        }
        
        /**
         * @Route("/api/getPrivileges/{route}/{privilege}", methods={"GET"})
         * @throws JWTDecodeFailureException
         */
        public function getPrivileges(string $route, int $privilege): JsonResponse
        {
            $token = $this->JWTTokenManager->decode($this->tokenStorage->getToken());
            $menu = $this->menuRepository->findByHref($route);
            $privilege = $this->repository->getRolePrivilege($token['idSystemRole'], $menu->getId(), $privilege);
            
            if ($privilege == null) {
                throw new UnauthorizedHttpException('', 'No tienes privilegios para ver esta pantalla');
            }
            
            return new JsonResponse(['authenticated' => true]);
        }
        
        /**
         * @Route("/api/getPrivilegesRole/{route}", methods={"GET"})
         * @throws JWTDecodeFailureException
         */
        public function getPrivilegesRole(string $route, bool $extra = false): JsonResponse | array
        {
            $token = $this->JWTTokenManager->decode($this->tokenStorage->getToken());
            
            $menu = $this->menuRepository->findByHref($route);
            if ($menu == null) {
                throw new UnauthorizedHttpException('', 'No existe esta pantalla');
            }
            $idMenu = $menu->getId();
            $idRole = $token['idSystemRole'];
            $privileges = $this->privilegesRepository->findAll();
            $Privileges = [];
            foreach ($privileges as $privilege) {
                $idPrivilege = $privilege->getId();
                
                if($idRole == 0){
                    $Privileges[$idPrivilege] = true;
                    $this->isCrud($idPrivilege, true, $Privileges);
                }else{
                    if($this->repository->getPrivilegeByPrivilegeRoleMenu($idPrivilege, $idRole, $idMenu)){
                        $Privileges[$idPrivilege] = true;
                        $this->isCrud($idPrivilege, true, $Privileges);
                    }else{
                        $Privileges[$idPrivilege] = false;
                        $this->isCrud($idPrivilege, false, $Privileges);
                    }
                }
            }
            
            return ($extra ? $Privileges : new JsonResponse($Privileges));
        }
        
        private function isCrud(int $idPrivilege, bool $privilege, array &$privileges)
        {
            switch ($idPrivilege) {
                case 2:
                    $privileges['create'] = $privilege;
                    break;
                case 3:
                    $privileges['delete'] = $privilege;
                    break;
                case 5:
                    $privileges['update'] = $privilege;
                    break;
            }
        }
    }