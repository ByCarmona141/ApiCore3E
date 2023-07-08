<?php
    
    declare(strict_types=1);
    
    
    namespace App\Api\Action\systemUser;
    
    use App\Entity\systemUser;
    use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
    use Symfony\Component\HttpFoundation\JsonResponse;
    
    class RefreshToken {
        private JWTTokenManagerInterface $JWTTokenManager;
        
        public function __construct(JWTTokenManagerInterface $JWTTokenManager) {
            $this->JWTTokenManager = $JWTTokenManager;
        }
        
        public function __invoke(systemUser $usuario): JsonResponse {
            return new JsonResponse(['token' => $this->JWTTokenManager->create($usuario)]);
        }
    }