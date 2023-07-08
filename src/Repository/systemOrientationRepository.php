<?php

    namespace App\Repository;

    use App\Entity\systemOrientation;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemOrientationRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemOrientation::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemOrientation $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemOrientation {
            if(null == $systemOrientation = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemOrientation con id $id");
            }

            return $systemOrientation;
        }

        /**
         * @return array<systemOrientation>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }