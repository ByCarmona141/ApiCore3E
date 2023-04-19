<?php
    
    namespace App\Repository;
    
    use App\Entity\systemUser;
    use App\Exception\systemUser\systemUserNotFoundException;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    
    class systemUserRepository extends BaseRepository
    {
        
        protected static function entityClass(): string
        {
            return systemUser::class;
        }
        
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemUser $entity)
        {
            return $this->saveEntity($entity);
        }
        
        public function findOneByUsernameOrFail(string $usuario): systemUser
        {
            if (null === $usuario = $this->objectRepository->findOneBy(['user' => $usuario])) {
                throw systemUserNotFoundException::fromUsername($usuario);
            }
            
            return $usuario;
        }
        
        public function findById($id): systemUser
        {
            return $this->objectRepository->find($id);
        }
    }