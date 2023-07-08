<?php

    namespace App\Repository;

    use App\Entity\systemRepository;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemRepositoryRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemRepository::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemRepository $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemRepository {
            if(null == $systemRepository = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemRepository con id $id");
            }

            return $systemRepository;
        }

        /**
         * @return array<systemRepository>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }

        public function findByArchive(string $entity, string $tuple): array {
            if(null == $systemRepository = $this->objectRepository->findBy(['entity' => $entity, 'tuple' => $tuple])) {
                throw new ConflictHttpException("No existe el registro de systemRepository con id $tuple");
            }

            return $systemRepository;
        }
    }