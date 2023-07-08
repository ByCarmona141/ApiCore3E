<?php

    namespace App\Repository;

    use App\Entity\systemIcon;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemIconRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemIcon::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemIcon $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemIcon {
            if(null == $systemIcon = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemIcon con id $id");
            }

            return $systemIcon;
        }

        /**
         * @return array<systemIcon>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }