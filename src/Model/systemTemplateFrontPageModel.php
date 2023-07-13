<?php

    namespace App\Model;

    class systemTemplateFrontPageModel {
        public function readDataTable($params = false, $rol = null): array {
            if($params && is_array($params)) {
                extract($params, EXTR_OVERWRITE);
            }

            $serverQuery = [
                'table'     => [
                    'name'  => 'systemTemplateFrontPage',
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
                        'name'   => 'header',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'body',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'footer',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => '(select name from systemOrientation where systemOrientation.id = systemTemplateFrontPage.idSystemOrientation)',
                        'alias'  => 'orientation',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => '(select name from systemSize where systemSize.id = systemTemplateFrontPage.idSystemSize)',
                        'alias'  => 'size',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'headerSpacing',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 1,
                        'name'   => 'footerSpacing',
                        'alias'  => '',
                        'extra'  => '',
                        'render' => ''
                    ],
                    [
                        'type'   => 0,
                        'name'   => '',
                        'alias'  => '',
                        'extra'  => 'report',
                        'render' => ''
                    ],
                    
                ],
                'condition' => '',
                'group'     => '',
                'order'     => ' id ASC ',
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

            return "select $fields from systemTemplateFrontPage order by name";
        }
    }
