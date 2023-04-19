<?php

    namespace App\Repository;

    use App\Entity\systemPrivileges;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemPrivilegesRepository extends BaseRepository{

        protected static function entityClass(): string{
            return systemPrivileges::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemPrivileges $entity): void{
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemPrivileges{
            if(null == $systemPrivileges = $this->objectRepository->find($id)){
                throw new ConflictHttpException("No existe el registro de systemPrivileges con id $id");
            }

            return $systemPrivileges;
        }
    
        /**
         * @return array<systemPrivileges>
         */
        public function findAll()
        {
            return $this->objectRepository->findAll();
        }
    }