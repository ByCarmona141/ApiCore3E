<?php
    
    namespace App\Api\Listener;
    
    use App\Entity\systemUser;
    use App\Repository\systemRoleRepository;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Doctrine\ORM\TransactionRequiredException;
    use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
    
    class JWTCreatedListener{
        private systemRoleRepository $repository;
    
        public function __construct(systemRoleRepository $repository){
            $this->repository = $repository;
        }
    
        public function onJWTCreated(JWTCreatedEvent $event): void{
            /** @var systemUser $user */
            $user = $event->getUser();
    
            $payload = $event->getData();
            $payload['id'] = $user->getId();
            $payload['email'] = $user->getEmail();
            $payload['idOffice'] = $user->getIdOffice();
            $payload['idSystemRole'] = $user->getIdSystemRole();
            
            $systemRole = $this
                ->repository
                ->findById($user->getIdSystemRole());
            
            $payload['role'] = $systemRole->getName();
            
            unset($payload['roles']);
            
            $event->setData($payload);
        }
    }