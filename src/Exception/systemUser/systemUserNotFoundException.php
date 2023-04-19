<?php
    
    
    namespace App\Exception\systemUser;
    
    
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    class systemUserNotFoundException extends NotFoundHttpException{
        private const MESSAGE = 'Usuario %s no encontrado';
    
        public static function fromUsername(string $username): self{
            throw new self(sprintf(self::MESSAGE, $username));
        }
    }