<?php

    namespace App\Repository;

    use App\Entity\systemTemplate;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemTemplateRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemTemplate::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemTemplate $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemTemplate {
            if(null == $systemTemplate = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemTemplate con id $id");
            }

            return $systemTemplate;
        }

        /**
         * @return array<systemTemplate>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }