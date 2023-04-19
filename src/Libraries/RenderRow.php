<?php
    
    namespace App\Libraries;
    
    class RenderRow{
        
        public static function render($render, $index = false, $values = false): string{
            return match ($render) {
                'status' => $values['status'] == 1 ? 'bg-success' : 'bg-warning',
                default => '',
            };
        }
    }