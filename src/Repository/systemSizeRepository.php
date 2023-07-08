<?php

    namespace App\Repository;

    use App\Entity\systemSize;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemSizeRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemSize::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemSize $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemSize {
            if(null == $systemSize = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemSize con id $id");
            }

            return $systemSize;
        }

        /**
         * @return array<systemSize>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }