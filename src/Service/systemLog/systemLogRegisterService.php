<?php
    
    namespace App\Service\systemLog;
    
    use App\Entity\systemLog;
    use App\Repository\systemLogRepository;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
    
    class systemLogRegisterService
    {
        private systemLogRepository   $repository;
        private TokenStorageInterface $tokenStorage;
    
        public function __construct(systemLogRepository $repository,
                                    TokenStorageInterface $tokenStorage){
            $this->repository = $repository;
            $this->tokenStorage = $tokenStorage;
        }
        
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */
        public function create(?string $entity, ?string $tuple, ?int $idSystemAction, mixed $data, ?\DateTime $date = null, ?int $idSystemUser = null, ?string $ipAddress = null, ?string $agent = null, ?string $form = null): systemLog
        {
            if($date == null){
                $date = new \DateTime();
            }
            if($idSystemUser == null){
                $idSystemUser = $this->tokenStorage->getToken()?->getUser()?->getId();
            }
    
            if(is_array($data)){
                $data = json_encode($data, JSON_PRETTY_PRINT);
            }elseif(is_numeric($data)){
                $data = (string)$data;
            }
            
            $systemLog = new systemLog($entity, $tuple, $date, $data, $idSystemUser, $idSystemAction, $ipAddress, $agent, $form);
            
            $this->repository->save($systemLog);
            return $systemLog;
        }
    }