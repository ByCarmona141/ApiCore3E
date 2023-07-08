<?php

    namespace App\Model;

    class systemMenuModel {
        public function readDataTable($params = false, $rol = null): array {
            if($params && is_array($params)) {
                extract($params, EXTR_OVERWRITE);
            }

            $serverQuery = [
                'table'     => [
                    'name'  => 'systemMenu',
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
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'name',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'description',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'href',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'CONCAT ("<i class = \'", (SELECT name FROM systemIcon WHERE systemIcon.id = systemMenu.idSystemIcon), "\'></i>", "   ", (SELECT name FROM systemIcon WHERE systemIcon.id = systemMenu.idSystemIcon))',
                        'alias'  => 'idSystemIcon',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'category',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'priority',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => '(select name from systemTypeElement where systemTypeElement.id = systemMenu.idSystemTypeElement)',
                        'alias'  => 'idSystemTypeElement',
                        'extra'  => '',
                        'render' => ''
                    ],
                    
                ],
                'condition' => '',
                'group'     => '',
                'order'     => ' id DESC ',
                'renderRow' => '',
                'debug'     => 0
            ];

            return $serverQuery;
        }

        public function combo($inText = false): string {
            if($inText) {
                $fields = 'name, name';
            } else {
                $fields = 'id, name';
            }

            return "SELECT $fields FROM systemMenu ORDER BY name";
        }
    }
