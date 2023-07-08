<?php

    namespace App\Model;

    class systemPrivilegesUserRoleModel {
        public function readDataTable($params = false, $rol = null): array {
            if($params && is_array($params)) {
                extract($params, EXTR_OVERWRITE);
            }

            $serverQuery = [
                'table'     => [
                    'name'  => 'systemPrivilegesUserRole',
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
                        'name'   => '(SELECT name FROM systemPrivileges WHERE systemPrivileges.id = systemPrivilegesUserRole.idSystemPrivileges)',
                        'alias'  => 'idSystemPrivileges',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'objectSource',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'objectTupla',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'active',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'objetcAccess',
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
                $fields = 'idSystemPrivileges, idSystemPrivileges';
            } else {
                $fields = 'id, idSystemPrivileges';
            }

            return "SELECT $fields FROM systemPrivilegesUserRole ORDER BY idSystemPrivileges";
        }
    }
