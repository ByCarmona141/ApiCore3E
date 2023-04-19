<?php
    
    namespace App\Service\systemMenu;
    
    use App\Entity\systemMenu;
    use App\Repository\systemMenuRepository;
    use App\Repository\systemPrivilegesUserRoleRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use App\Service\systemPrivilegesUserRole\systemPrivilegesUserRoleRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    
    class systemMenuUpdateService
    {
        private systemMenuRepository                    $repository;
        private systemLogRegisterService                $accesoService;
        private systemPrivilegesUserRoleRegisterService $userRoleRegister;
        private systemPrivilegesUserRoleRepository      $userRoleRepository;
        
        public function __construct(systemMenuRepository                    $repository,
                                    systemLogRegisterService                $accesoService,
                                    systemPrivilegesUserRoleRegisterService $userRoleRegister,
                                    systemPrivilegesUserRoleRepository      $userRoleRepository)
        {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
            $this->userRoleRegister = $userRoleRegister;
            $this->userRoleRepository = $userRoleRepository;
        }
        
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function update(int $id, ?string $name, ?string $description, ?string $href, ?int $idSystemIcon, ?int $category, ?int $priority, ?int $idSystemTypeElement, mixed $roles = null): systemMenu
        {
            $systemMenu = $this->repository->findById($id);
            $systemMenu->setname($name);
            $systemMenu->setdescription($description);
            $systemMenu->sethref($href);
            $systemMenu->setidSystemIcon($idSystemIcon);
            $systemMenu->setcategory($category);
            $systemMenu->setpriority($priority);
            $systemMenu->setidSystemTypeElement($idSystemTypeElement);
            
            if ($category == null) {
                $systemMenu->setCategory($id);
            }
            
            $this->repository->save($systemMenu);
            
            if ($roles != null && !is_array($roles)) {
                $roles = [$roles];
            }
            $this->userRoleRepository->deleteByMenu($id);
            foreach ($roles as $role) {
                $this->userRoleRegister->create(1, 1, $systemMenu->getId(), 1, $role);
            }
            
            $data = [
                'name'                => $systemMenu->getname(),
                'description'         => $systemMenu->getdescription(),
                'href'                => $systemMenu->gethref(),
                'idSystemIcon'        => $systemMenu->getidSystemIcon(),
                'category'            => $systemMenu->getcategory(),
                'priority'            => $systemMenu->getpriority(),
                'idSystemTypeElement' => $systemMenu->getidSystemTypeElement()
            ];
            $this->accesoService->create('systemMenu', $id, 5, $data);
            
            return $systemMenu;
        }
    }