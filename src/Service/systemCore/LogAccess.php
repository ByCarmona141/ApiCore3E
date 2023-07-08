<?php
    
    declare(strict_types=1);
    
    
    namespace App\Service\systemCore;
    
    use App\Entity\CelaUsuario;

    /**
     * @deprecated
     */
    class LogAccess {
        private CelaUsuario $usuario;
    
        public function __construct(CelaUsuario $usuario) {
            $this->usuario = $usuario;
        }
    
        public static function RecordLog(string $table, int $idRecord, int $action, mixed $Data) {
        
        }
    }