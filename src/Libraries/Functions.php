<?php
    
    namespace App\Libraries;

    class Functions
    {
        static function ReplaceContentPage($Etiqueta, $Salida = false, $Pagina = false){
            if(is_array($Etiqueta)){
                extract($Etiqueta, EXTR_OVERWRITE);
            }
        
            return str_replace($Etiqueta, $Salida, $Pagina);
        }
    
        static function GeneratePDF($FileContend, $FileName = false, $Savein = false, $PDFConfig = array(), $callback = false): array{
            if(is_array($FileContend)){
                extract($FileContend, EXTR_OVERWRITE);
            }
        
            $SourceFile = '';
            try{
                $Name = ($FileName !== false && $FileName != '' ? $FileName : rand(10000000, 99999999) . '.pdf');
                $Source = ($Savein !== false && $Savein != '' ? $Savein : 'repository/temporary/');
            
                if(!isset($PDFConfig['Constructor']) || count($PDFConfig['Constructor']) <= 0){
                    $PDFConfig['Constructor'] = array(
                        'path' => $Source,
                        // 'FooterStyleRight' => 'Pag. [page] de [toPage]'
                    );
                }else{
                    $PDFConfig['Constructor']['path'] = (isset($PDFConfig['Constructor']['path']) && $PDFConfig['Constructor']['path'] != '' ? $PDFConfig['Constructor']['path'] : $Source);
                }
            
                if(!isset($PDFConfig['Mode'])){
                    $PDFConfig['Mode'] = 3;
                }
            
                $Wkhtmltopdf = new Wkhtmltopdf($PDFConfig['Constructor']);
            
                $Wkhtmltopdf->setHtml($FileContend);
            
                if($callback != false){
                    $callback($Wkhtmltopdf);
                }
            
                switch($PDFConfig['Mode']){
                    case 0:
                        $Wkhtmltopdf->output(Wkhtmltopdf::MODE_DOWNLOAD, $Name);
                        break;
                    case 1:
                        $Wkhtmltopdf->output(Wkhtmltopdf::MODE_STRING, $Name);
                        break;
                    case 2:
                        $Wkhtmltopdf->output(Wkhtmltopdf::MODE_EMBEDDED, $Name);
                        exit();
                        break;
                    case 3:
                        $Wkhtmltopdf->output(Wkhtmltopdf::MODE_SAVE, $Name);
                        break;
                }
            
                $SourceFile = $Source . $Name;
            
                return [
                    'status'     => 'success',
                    'sourceFile' => $SourceFile,
                    'title'      => $Name
                ];
            }catch(Exception $e){
                return [
                    'status' => 'error',
                    'error'  => $e->getMessage()
                ];
            }
        }
    }