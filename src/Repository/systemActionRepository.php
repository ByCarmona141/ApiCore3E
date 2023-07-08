<?php

    namespace App\Repository;

    use App\Entity\systemAction;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemActionRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemAction::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemAction $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemAction {
            if(null == $systemAction = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemAction con id $id");
            }

            return $systemAction;
        }

        /**
         * @return array<systemAction>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }