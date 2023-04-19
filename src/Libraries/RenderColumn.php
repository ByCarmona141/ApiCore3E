<?php
    
    namespace App\Libraries;
    
    class RenderColumn{
        public static function render($render, $column = false, $values = false): string{
            $renderer = '';
            switch($render){
                case 'icon':
                    if($column != ''){
                        $renderer = "<div align='center'>
    <i class='$column'></i>
</div>";
                    }
                    break;
                case 'status':
                    if($column != ''){
                        $renderer = "<div align='center'>" . ($column == 1 ? 'Activo' : 'Inactivo') . "</div>";
                    }
                    break;
                case 'money':
                    $renderer = "$" . number_format($column, 2);
                    break;
                case 'image':
                    if($column != ''){
                        $renderer = "<div><img style='max-width: 95px' src='http://apinabegenerate.com/$column'></div>";
                    }
                    break;
                case 'datetime':
                    $renderer = "";
                    break;
            }
            
            return $renderer;
        }
    }