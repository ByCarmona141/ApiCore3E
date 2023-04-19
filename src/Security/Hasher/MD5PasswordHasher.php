<?php
    
    
    namespace App\Security\Hasher;
    
    
    use Symfony\Component\PasswordHasher\Exception\InvalidPasswordException;
    use Symfony\Component\PasswordHasher\PasswordHasherInterface;

    class MD5PasswordHasher implements PasswordHasherInterface{
    
        public function hash(string $plainPassword): string{
            //return md5($plainPassword);
            return $plainPassword;
        }
    
        public function verify(string $hashedPassword, string $plainPassword): bool{
            return $hashedPassword == $plainPassword;
        }
    
        public function needsRehash(string $hashedPassword): bool{
            return false;
        }
    }