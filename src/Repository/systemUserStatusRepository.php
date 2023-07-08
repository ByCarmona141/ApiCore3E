<?php

    namespace App\Repository;

    use App\Entity\systemUserStatus;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemUserStatusRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemUserStatus::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemUserStatus $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemUserStatus {
            if(null == $systemUserStatus = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemUserStatus con id $id");
            }

            return $systemUserStatus;
        }

        /**
         * @return array<systemUserStatus>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }