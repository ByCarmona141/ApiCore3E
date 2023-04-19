<?php

    namespace App\Repository;

    use App\Entity\systemDocument;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemDocumentRepository extends BaseRepository{

        protected static function entityClass(): string{
            return systemDocument::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemDocument $entity): void{
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemDocument{
            if(null == $systemDocument = $this->objectRepository->find($id)){
                throw new ConflictHttpException("No existe el registro de systemDocument con id $id");
            }

            return $systemDocument;
        }
    }