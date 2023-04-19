<?php
    
    namespace App\Repository;
    
    use App\Entity\systemPrivilegesUserRole;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
    
    class systemPrivilegesUserRoleRepository extends BaseRepository
    {
        
        protected static function entityClass(): string
        {
            return systemPrivilegesUserRole::class;
        }
        
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemPrivilegesUserRole $entity): void
        {
            $this->saveEntity($entity);
        }
        
        public function findById(int $id): systemPrivilegesUserRole
        {
            if (null == $systemPrivilegesUserRole = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemPrivilegesUserRole con id $id");
            }
            
            return $systemPrivilegesUserRole;
        }
        
        /**
         * @param int $role
         * @param int $menu
         * @param int $privilege
         * @return array<systemPrivilegesUserRole>|null
         */
        public function getRolePrivilege(int $role, int $menu, int $privilege)
        {
            return $this->objectRepository
                ->findBy(
                    [
                        'idSystemPrivileges' => $privilege,
                        'objectSource'       => 1,
                        'objectTupla'        => $menu,
                        'objetcAccess'       => $role,
                    ]);
        }
        
        
        /**
         * @param int $role
         * @param int $menu
         * @return array<systemPrivilegesUserRole>|null
         */
        public function getRolePrivileges(int $role, int $menu)
        {
            return $this->objectRepository
                ->findBy(
                    [
                        'objectSource' => 1,
                        'objectTupla'  => $menu,
                        'objetcAccess' => $role,
                    ]);
        }
    
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function deleteByMenu(int $id): void
        {
            $privileges = $this->objectRepository
                ->findBy(['objectTupla' => $id, 'objectSource' => 1]);
    
            foreach($privileges as $privilege){
                $this->removeEntity($privilege);
            }
        }
    
        public function getPrivilegeByPrivilegeRoleMenu(int $idPrivilege, ?int $idRole, int $idMenu): array
        {
            return $this->objectRepository->findBy([
                'idSystemPrivileges' => $idPrivilege,
                'objetcAccess' => $idRole,
                'objectTupla' => $idMenu
            ]);
        }
    
        public function deleteByMenuRole(int $id, string $idForm)
        {
            $privileges = $this->objectRepository
                ->findBy(
                    [
                        'objectTupla'  => $idForm,
                        'objectSource' => 1,
                        'objetcAccess' => $id,
                    ]
                );
            foreach($privileges as $privilege){
                $this->removeEntity($privilege);
            }
        }
    }