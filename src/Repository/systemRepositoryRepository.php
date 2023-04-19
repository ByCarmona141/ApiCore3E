<?php

    namespace App\Repository;

    use App\Entity\systemRepository;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemRepositoryRepository extends BaseRepository{

        protected static function entityClass(): string{
            return systemRepository::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemRepository $entity): void{
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemRepository{
            if(null == $systemRepository = $this->objectRepository->find($id)){
                throw new ConflictHttpException("No existe el registro de systemRepository con id $id");
            }

            return $systemRepository;
        }
    }