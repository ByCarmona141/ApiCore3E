<?php
    
    namespace App\Service\systemMenu;
    
    use App\Repository\systemMenuRepository;
    use Doctrine\ORM\Query\Expr\Join;
    use Symfony\Component\HttpFoundation\Request;
    
    class systemMenuMenuService{
        private systemMenuRepository $repository;
        
        public function __construct(systemMenuRepository $repository){
            $this->repository = $repository;
        }
        
        public function getMenu(Request $request): array{
            $role = $request->get('role');
            
            $em = $this->repository->getEntityManager();
            
            $exp = $em->getExpressionBuilder();
            $qb = $em->createQueryBuilder()
                     ->select('cu.id', 'cu.name', 'cu.description', 'cu.href', 'cu.idSystemTypeElement', 'cu.priority', 'c.name as Icono')
                     ->from('App:systemMenu', 'cu')
                     ->join('App:systemIcon', 'c', Join::WITH, 'cu.idSystemIcon = c.id')
                     ->andWhere('cu.category = cu.id')
                     ->andWhere($exp->in(
                         'cu.id',
                         $em->createQueryBuilder()
                            ->select('c1.objectTupla')
                            ->from('App:systemPrivilegesUserRole', 'c1')
                            ->andWhere('c1.objetcAccess = :role')
                            ->andWhere('c1.objectSource = 1')
                            ->andWhere('c1.idSystemPrivileges = 1')
                            ->getDQL()
                     ))
                     ->orderBy('cu.priority', 'ASC')
                     ->setParameter('role', $role);
            $parents = $qb->getQuery()->getResult();
            $menu = [];
            foreach($parents as $parent){
                $menu[] = $this->matchResult($role, $parent);
            }
            
            return $menu;
        }
        
        private function searchChild($role, $category): array{
            $em = $this->repository->getEntityManager();
            
            $exp = $em->getExpressionBuilder();
            $qb = $em->createQueryBuilder()
                     ->select('cu.id', 'cu.name', 'cu.description', 'cu.href', 'cu.idSystemTypeElement', 'cu.priority', 'c.name as Icono')
                     ->from('App:systemMenu', 'cu')
                     ->join('App:systemIcon', 'c', Join::WITH, 'cu.idSystemIcon = c.id')
                     ->andWhere('cu.category = :category')
                     ->andWhere('cu.id != :category')
                     ->andWhere($exp->in(
                         'cu.id',
                         $em->createQueryBuilder()
                            ->select('c1.objectTupla')
                            ->from('App:systemPrivilegesUserRole', 'c1')
                            ->andWhere('c1.objetcAccess = :role')
                            ->andWhere('c1.objectSource = 1')
                            ->andWhere('c1.idSystemPrivileges = 1')
                            ->getDQL()
                     ))
                     ->orderBy('cu.priority', 'ASC')
                     ->setParameter('role', $role)
                     ->setParameter('category', $category);
            // return [$qb->getDQL()];
            
            $childs = $qb->getQuery()->getResult();
            $menu = [];
            foreach($childs as $child){
                $menu[] = $this->matchResult($role, $child);
            }
            
            return $menu;
        }
        
        private function matchResult(int $role, array $menu): array{
            return match ($menu['idSystemTypeElement']) {
                1 => [
                    'id'       => "id{$menu['id']}",
                    'title'    => $menu['name'],
                    'type'     => 'collapse',
                    'icon'     => $menu['Icono'],
                    'children' => $this->searchChild($role, $menu['id']),
                ],
                2 => [
                    'id'      => "id{$menu['id']}",
                    'title'   => $menu['name'],
                    'type'    => 'item',
                    'url'     => str_replace('.php', '', $menu['href']),
                    'classes' => 'nav-item',
                    'icon'    => $menu['Icono'],
                ],
                4 => [
                    'id'       => "id{$menu['id']}",
                    'title'    => $menu['name'],
                    'type'     => 'item',
                    'url'      => str_replace('.php', '', $menu['href']),
                    'icon'     => $menu['Icono'],
                    'external' => true,
                ],
                default => [],
            };
        }
    }