<?php

    namespace App\Repository;

    use App\Entity\systemConfig;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemConfigRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemConfig::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemConfig $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemConfig{
            if(null == $systemConfig = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemConfig con id $id");
            }

            return $systemConfig;
        }

        /**
         * @return array<systemConfig>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }