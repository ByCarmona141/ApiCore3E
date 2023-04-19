<?php

    namespace App\Model;

    class systemDocumentModel{

        public function readDataTable($params = false): array{
            if($params && is_array($params)){
                extract($params, EXTR_OVERWRITE);
            }

            $serverQuery = [
                'table'     => [
                    'name'  => 'systemDocument',
                    'alias' => ''
                ],
                'index'     => [
                    'name'  => 'id',
                    'alias' => ''
                ],
                'columns'   => [
                    [
                        'type'   => 0,
                        'name'   => '',
                        'alias'  => '',
                        'extra'  => 'actions',
                        'render' => ''
                    ], [
                        'type'   => 1,
                        'name'   => '(SELECT name FROM systemTemplate WHERE systemTemplate.id = systemDocument.idSystemTemplate)',
                        'alias'  => 'idSystemTemplate',
                        'extra'  => '',
                        'render' => ''
                    ], [
                        'type'   => 1,
                        'name'   => 'content',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ], [
                        'type'   => 1,
                        'name'   => 'dateCreate',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ], [
                        'type'   => 0,
                        'name'   => '',
                        'alias'  => '',
                        'extra'  => 'reporte',
                        'render' => ''
                    ]
                ],
                'condition' => '',
                'group'     => '',
                'order'     => ' id ASC ',
                'renderRow' => '',
                'debug'     => 0
            ];

            return $serverQuery;
        }

        public function combo($inText = false): string{
            if($inText){
                $fields = 'idSystemTemplate, idSystemTemplate';
            }else{
                $fields = 'id, idSystemTemplate';
            }

            return "select $fields from systemDocument order by idSystemTemplate";
        }
    }
