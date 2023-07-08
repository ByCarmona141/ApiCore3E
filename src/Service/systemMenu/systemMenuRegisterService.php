<?php
    
    namespace App\Service\systemMenu;
    
    use App\Entity\systemMenu;
    use App\Repository\systemMenuRepository;
    use App\Service\systemLog\systemLogRegisterService;
    use App\Service\systemPrivilegesUserRole\systemPrivilegesUserRoleRegisterService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    
    class systemMenuRegisterService {
        private systemMenuRepository                    $repository;
        private systemLogRegisterService                $accesoService;
        private systemPrivilegesUserRoleRegisterService $userRoleRegister;
        
        public function __construct(systemMenuRepository                    $repository,
                                    systemLogRegisterService                $accesoService,
                                    systemPrivilegesUserRoleRegisterService $userRoleRegister) {
            $this->repository = $repository;
            $this->accesoService = $accesoService;
            $this->userRoleRegister = $userRoleRegister;
        }
        
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(?string $name, ?string $description, ?string $href, ?int $idSystemIcon, ?int $category, ?int $priority, ?int $idSystemTypeElement, mixed $roles = null): systemMenu {
            $systemMenu = new systemMenu($name, $description, $href, $idSystemIcon, $category, $priority, $idSystemTypeElement);
            
            $this->repository->save($systemMenu);
            
            if (empty($category)) {
                $systemMenu->setCategory($systemMenu->getId());
                $this->repository->save($systemMenu);
            }
            if ($roles != null && !is_array($roles)) {
                $roles = [$roles];
            }
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
                'idSystemTypeElement' => $systemMenu->getidSystemTypeElement(),
                'roles'               => $roles
            ];
            $this->accesoService->create('systemMenu', $systemMenu->getId(), 2, $data);
            
            return $systemMenu;
        }
    }