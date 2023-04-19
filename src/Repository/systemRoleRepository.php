<?php

    namespace App\Repository;

    use App\Entity\systemRole;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemRoleRepository extends BaseRepository{

        protected static function entityClass(): string{
            return systemRole::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemRole $entity): void{
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemRole{
            if(null == $systemRole = $this->objectRepository->find($id)){
                throw new ConflictHttpException("No existe el registro de systemRole con id $id");
            }

            return $systemRole;
        }
    }