<?php
    
    namespace App\Service\systemMenu;
    
    use App\Entity\systemMenu;
    use App\Repository\systemMenuRepository;
    use App\Repository\systemPrivilegesUserRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    
    class systemMenuDataService {
        private systemMenuRepository               $repository;
        private systemLogRegisterService           $accesoService;
        private systemPrivilegesUserRoleRepository $userRoleRepository;
        
        public function __construct(systemMenuRepository               $repository,
                                    systemLogRegisterService           $accesoService,
                                    systemPrivilegesUserRoleRepository $userRoleRepository) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
            $this->userRoleRepository = $userRoleRepository;
        }
        
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function data(int $id): systemMenu {
            $systemMenu = $this->repository->findById($id);
            $data = [
                'name'                => $systemMenu->getname(),
                'description'         => $systemMenu->getdescription(),
                'href'                => $systemMenu->gethref(),
                'idSystemIcon'        => $systemMenu->getidSystemIcon(),
                'category'            => $systemMenu->getcategory(),
                'priority'            => $systemMenu->getpriority(),
                'idSystemTypeElement' => $systemMenu->getidSystemTypeElement()
            ];
            
            $this->accesoService->create('systemMenu', $id, 4, $data);
            
            return $systemMenu;
        }
    }