<?php

    namespace App\Model;

    class systemPrivilegesModel {
        public function readDataTable($params = false, $rol = null): array {
            if($params && is_array($params)) {
                extract($params, EXTR_OVERWRITE);
            }

            $serverQuery = [
                'table'     => [
                    'name'  => 'systemPrivileges',
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

            return "SELECT $fields FROM systemPrivileges ORDER BY name";
        }
    }
