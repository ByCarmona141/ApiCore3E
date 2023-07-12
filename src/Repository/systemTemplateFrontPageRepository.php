<?php

    namespace App\Repository;

    use App\Entity\systemTemplateFrontPage;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemTemplateFrontPageRepository extends BaseRepository {

        protected static function entityClass(): string {
            return systemTemplateFrontPage::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemTemplateFrontPage $entity): void {
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemTemplateFrontPage {
            if(null == $systemTemplateFrontPage = $this->objectRepository->find($id)) {
                throw new ConflictHttpException("No existe el registro de systemTemplateFrontPage con id $id");
            }

            return $systemTemplateFrontPage;
        }

        /**
         * @return array<systemTemplateFrontPage>
         */
        public function findAll(): array {
            return $this->objectRepository->findAll();
        }
    }