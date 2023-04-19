<?php

    namespace App\Repository;

    use App\Entity\systemMenu;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

    class systemMenuRepository extends BaseRepository{

        protected static function entityClass(): string{
            return systemMenu::class;
        }

        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function save(systemMenu $entity): void{
            $this->saveEntity($entity);
        }

        public function findById(int $id): systemMenu{
            if(null == $systemMenu = $this->objectRepository->find($id)){
                throw new ConflictHttpException("No existe el registro de systemMenu con id $id");
            }

            return $systemMenu;
        }
    
        public function findByHref(string $route): systemMenu | null
        {
            return $this->objectRepository->findOneBy(['href' => $route]);
        }
    
        /**
         * @return array<systemMenu>
         */
        public function findAll(): array
        {
            return $this->objectRepository->findAll();
        }
    }