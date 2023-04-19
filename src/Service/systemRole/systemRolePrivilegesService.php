<?php
    
    namespace App\Service\systemRole;
    
    use App\Entity\systemPrivilegesUserRole;
    use App\Repository\systemMenuRepository;
    use App\Repository\systemPrivilegesRepository;
    use App\Repository\systemPrivilegesUserRoleRepository;
    use App\Repository\systemRoleRepository;
    use App\Service\Request\RequestService;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpFoundation\Request;

    class systemRolePrivilegesService{
        private systemRoleRepository               $repository;
        private systemPrivilegesRepository         $privilegesRepository;
        private systemPrivilegesUserRoleRepository $userRoleRepository;
        private systemMenuRepository               $menuRepository;
        
        public function __construct(systemRoleRepository               $repository,
                                    systemMenuRepository               $menuRepository,
                                    systemPrivilegesRepository         $privilegesRepository,
                                    systemPrivilegesUserRoleRepository $userRoleRepository){
            $this->repository = $repository;
            $this->privilegesRepository = $privilegesRepository;
            $this->userRoleRepository = $userRoleRepository;
            $this->menuRepository = $menuRepository;
        }
        
        public function getPrivileges(int $id): array{
            $systemRole = $this->repository->findById($id);
            $privilegesObject = $this->privilegesRepository->findAll();
            $privileges = [];
            foreach($privilegesObject as $privilege){
                $privileges[] = [
                    'id'          => $privilege->getId(),
                    'name'        => $privilege->getName(),
                    'description' => $privilege->getDescription(),
                ];
            }
            
            $privilegesRole = [];
            
            $systemMenu = $this->menuRepository->findAll();
            foreach($systemMenu as $menu){
                $privilegesRoleMenu = [];
                foreach($privileges as $privilege){
                    $menuPrivilege = $this
                        ->userRoleRepository
                        ->getRolePrivilege($id, $menu->getId(), $privilege['id']);
                    
                    $privilegesRoleMenu[] = isset($menuPrivilege[0]) ? $menuPrivilege[0]->getId() : null;
                }
                
                $privilegesRole[] = [
                    'id'          => $menu->getId(),
                    'name'        => $menu->getName(),
                    'description' => $menu->getDescription(),
                    'href'        => $menu->getHref(),
                    'privileges'  => $privilegesRoleMenu,
                ];
            }
            
            return [
                'name'           => $systemRole->getName(),
                'privileges'     => $privileges,
                'privilegesRole' => $privilegesRole,
            ];
        }
    
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function setPrivileges(int $id, Request $request): array{
            $data = RequestService::getField($request, 'formValue');
            foreach($data as $item){
                $form = $item['form'];
                $form = explode('-', $form);
                $idForm = $form[0];
                
                $this->userRoleRepository->deleteByMenuRole($id, $idForm);
                
                $count = 0;
                $systemPrivilege = $this->privilegesRepository->findAll();
                foreach($systemPrivilege as $privilege){
                    if($item['privileges'][$count] && $item['privileges'][$count] != null){
                        $privilegeUserRole = new systemPrivilegesUserRole($privilege->getId(), 1, $idForm, 1, $id);
                        
                        $this->userRoleRepository->save($privilegeUserRole);
                    }
                    $count++;
                }
            }
            
            return ['status' => 'ok'];
        }
    }