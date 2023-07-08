<?php

    namespace App\Repository;

    use App\Entity\systemLog;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemLogRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemLog::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemLog $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemLog {
            if(null == $systemLog = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemLog con id $id");
            }

            return $systemLog;
        }

        /**
         * @return array<systemLog>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }