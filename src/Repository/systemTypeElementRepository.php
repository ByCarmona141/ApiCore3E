<?php

    namespace App\Repository;

    use App\Entity\systemTypeElement;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemTypeElementRepository extends BaseRepository{

        protected static function entityClass(): string{
            return systemTypeElement::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemTypeElement $entity): void{
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemTypeElement{
            if(null == $systemTypeElement = $this->objectRepository->find($id)){
                throw new ConflictHttpException("No existe el registro de systemTypeElement con id $id");
            }

            return $systemTypeElement;
        }
    }