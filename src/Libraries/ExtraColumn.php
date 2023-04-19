<?php
    
    namespace App\Libraries;
    
    use App\Api\Action\systemCore\systemPrivileges;
    use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
    
    class ExtraColumn{
        private systemPrivileges $privileges;
        
        public function __construct(systemPrivileges $privileges){
            $this->privileges = $privileges;
        }
        
        /**
         * @throws JWTDecodeFailureException
         */
        public function extra($index, $extra, $table): string{
            $column = '';
            switch($extra){
                case 'actions':
                    $privileges = $this->privileges->getPrivilegesRole($table, true);
                    
                    $edit = "";
                    if(isset($privileges['5']) && $privileges['5']){
                        $edit = "<a class='btn btn-warning btn-sm text-light edit'
                               index='$index'
                               style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'>
                                <i class='fa fa-edit'></i> Editar
                            </a>";
                    }
                    
                    $delete = "";
                    if(isset($privileges['3']) && $privileges['3']){
                        $delete = "<a class='btn btn-danger btn-sm text-light delete'
                                index='$index'
                                style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'>
                                <i class='fa fa-trash'></i> Eliminar
                            </a>";
                    }
                    
                    $repository = "";
                    if(isset($privileges['6']) && $privileges['6']){
                        $repository = "<a class='btn btn-info text-light btn-sm repository'
                                index='$index'
                                style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'>
                                <i class='fa fa-file'></i> Archivo
                            </a>";
                    }
                    $column = "
                    <div>
                        <input type='checkbox' class='select check$table' value='$index'>
                        <div class='hidden'
                             style='position: absolute;
                                    margin-top: -15px;
                                    margin-left: 30px;'
                             align='left'
                             id='actions_$table$index'>
                            $edit
                            $delete
                            $repository
</div>
                    </div>";
                    break;
                case 'buttonsControl':
                    $column = "<div>
                                    <a class='btn btn-warning btn-sm edit'
                                        style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'
                                        index='$index'>
                                        <i class='fa fa-pencil'></i>
                                    </a>
                                    <a class='btn btn-danger btn-sm delete'
                                        style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'
                                        index='$index'>
                                        <i class='fa fa-trash'></i>
                                    </a>
                                </div>";
                    break;
                case 'Saldo':
                    $column = "<div class='col-md-12' align='center'>
                                    <a class='btn btn-info btn-sm saldo'
                                        index='$index'>
                                        <i class='fa fa-eye'></i>
                                    </a>
                                </div>";
                    break;
                case 'ProductosServicio':
                    $column = "<div class='col-md-12' align='center'>
                                    <a class='btn btn-info btn-sm products'
                                        index='$index'>
                                        <i class='fa fa-eye'></i>
                                    </a>
                                </div>";
                    break;
                case 'privileges':
                    $column = "<div align='center'><a class='btn btn-sm btn-info privileges' index='$index'><i class='fa fa-share'></i></a> </div>";
                    break;
                case 'reporte':
                    $column = "<div align='center'>
                                    <a class='btn btn-info btn-sm reporte'
                                        style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'
                                        index='$index'>
                                        <i class='fa fa-file-pdf'></i>
                                    </a>
                                </div>";
                    break;
                case 'historial':
                    $column = "<div align='center'>
                                    <a class='btn btn-info btn-sm historial'
                                        style='padding: 0.15rem 0.35rem;
    font-size: 0.6rem;'
                                        index='$index'>
                                        <i class='fa fa-history'></i>
                                    </a>
                                </div>";
                    break;
                default:
                    break;
            }
            
            return $column;
        }
    }