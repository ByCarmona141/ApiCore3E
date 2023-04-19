<?php
    
    
    namespace App\Security\Core\SystemUser;
    
    
    use App\Entity\systemUser;
    use App\Exception\systemUser\systemUserNotFoundException;
    use App\Repository\systemUserRepository;
    use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
    use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\UserProviderInterface;

    /**
     * @method UserInterface loadUserByIdentifier(string $identifier)
     */
    class SystemUserProvider implements UserProviderInterface{
        private systemUserRepository $systemUserRepository;
    
        public function __construct(systemUserRepository $systemUserRepository){
            $this->systemUserRepository = $systemUserRepository;
        }
    
        public function loadUserByUsername(string $username): UserInterface{
            try{
                return $this->systemUserRepository->findOneByUsernameOrFail($username);
            } catch(systemUserNotFoundException $exception){
                throw new UsernameNotFoundException("Usuario $username no encontrado");
            }
        }
    
        public function refreshUser(UserInterface $user): UserInterface{
            if(!$user instanceof systemUser){
                throw new UnsupportedUserException(\sprintf("Instancia de %s no es soportada", get_class($user)));
            }
            
            return $this->loadUserByUsername($user->getUsername());
        }
    
        public function supportsClass(string $class): bool{
            return systemUser::class === $class;
        }
    
        public function __call($name, $arguments){
            // TODO: Implement @method UserInterface loadUserByIdentifier(string $identifier)
        }
    }