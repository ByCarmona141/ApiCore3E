<?php

namespace App\Service\systemCore;

use App\Libraries\ExtraColumn;
use App\Libraries\RenderColumn;
use App\Libraries\RenderRow;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Exception as ExceptionDBAL;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class Datatable{
    private EntityManagerInterface $entityManager;
    private ExtraColumn            $extraColumn;
    private RenderColumn           $renderColumn;
    private RenderRow              $renderRow;

    public function __construct(EntityManagerInterface $entityManager,
                                ExtraColumn            $extraColumn,
                                RenderColumn           $renderColumn,
                                RenderRow              $renderRow){
        $this->entityManager = $entityManager;
        $this->extraColumn = $extraColumn;
        $this->renderColumn = $renderColumn;
        $this->renderRow = $renderRow;
    }

    /**
     * @throws Exception
     * @throws ExceptionDBAL
     */
    public function datatableController(Request $request, object $class, string $function): JsonResponse{
        $body = json_decode($request->getContent(), true);
        $params = $body['params'];
        $draw = $body['dataTablesParameters']['draw'];
        $columns = $body['dataTablesParameters']['columns'];
        $length = $body['dataTablesParameters']['length'];
        $order = $body['dataTablesParameters']['order'];
        $search = $body['dataTablesParameters']['search'];
        $start = $body['dataTablesParameters']['start'];

        $config = $class->$function(count($params) > 0 ? $params : false);

        $tableDT = $config['table']['alias'] != '' ? $config['table']['alias'] : $config['table']['name'];
        $indexDT = $config['index']['alias'] != '' ? $config['index']['alias'] : $config['index']['name'];
        $whereDT = $config['condition'];
        $columnsDT = [];

        $columnsDT[] = $config['index']['name'] . ($config['index']['alias'] != '' ? ' as ' . $config['index']['alias'] : '');
        foreach($config['columns'] as $column){
            switch($column['type']){
                case 1:
                    $columnsDT[] = $column['name'] . ($column['alias'] == '' ? '' : ' as ' . $column['alias']);
                    break;
                case 2:
                    $columnsDT[] = '""';
                    break;
                default:
                    break;
            }
        }
        $columnsDT = implode(", ", $columnsDT);
        $limitDT = '';
        if($length != -1){
            $limitDT = "limit $start, $length";
        }

        if($draw == 1){
            $orderDT = "order by {$config['order']}";
        } else{
            $fieldOrder = $config['columns'][$order[0]['column']]['type'] != 1 ? $config['index']['name'] : $config['columns'][$order[0]['column']]['name'];

            $orderDT = "order by {$fieldOrder} {$order[0]['dir']}";
        }

        $group = $config['group'] != '' ? "group by {$config['group']}" : '';

        $searchDT = [];
        if($search['value'] != ''){
            foreach($config['columns'] as $column){
                if($column['type'] == 1){
                    $searchDT[] = "{$column['name']} LIKE '%{$search['value']}%'";
                }
            }
        }
        $searchDT = implode(' OR ', $searchDT);

        if($whereDT != ''){
            $whereDT .= ' and ';
        }
        if($searchDT != ''){
            $whereDT .=  $searchDT;
            $flagSerch=true;
        }else{

            $flagSerch=false;
            $whereDT .= '1=1';
        }
        $filterTotalrows= "select count(id) as count
                      from {$config['table']['name']} " . ($config['table']['alias'] != '' ? 'as ' . $config['table']['alias'] : '') . "
                      where " . ($whereDT == '' ? ' 1=1' : $whereDT) . " $group $orderDT ;";
        $resultfilter = $this->entityManager->getConnection()->executeQuery($filterTotalrows)->fetchAllAssociative();

        $filterTotal=$resultfilter[0]['count'];

        $query = "select sql_calc_found_rows $indexDT, $columnsDT
                      from {$config['table']['name']} " . ($config['table']['alias'] != '' ? 'as ' . $config['table']['alias'] : '') . "
                      where " . ($whereDT == '' ? ' 1=1' : $whereDT) . " $group $orderDT $limitDT;";
        $result = $this->entityManager->getConnection()->executeQuery($query)->fetchAllAssociative();
        $data = [];

        foreach($result as $record){
            $row = [];

            foreach($config['columns'] as $column){
                switch($column['type']){
                    case 1:
                        $key = $column['alias'] != '' ? $column['alias'] : $column['name'];
                        if($column['render'] != ''){
                            $row[] = $this->renderColumn::render($column['render'], $record[$key], $record);
                        } else{
                            $row[] = $record[$key];
                        }
                        break;
                    default:
                        $row[] = $this->extraColumn->extra($record[$indexDT], $column['extra'], $tableDT);
                        break;
                }
            }
            $row['DT_RowId'] = "$tableDT{$record[$indexDT]}";
            $row['DT_RowClass'] = "datatableRow";
            if($config['renderRow'] != ''){
                $row['DT_RowClass'] .= ' ' . $this->renderRow::render($config['renderRow'], $record[$indexDT], $record);
            }
            $data[] = $row;


        }


        /*$queryFilter = 'select found_rows() as total';
        $resultFilter = $this->entityManager->getConnection()->executeQuery($queryFilter);
        if($resultFilter->rowCount() > 0){
            $recordFilter = $resultFilter->fetchAllAssociative();
            $filterTotal = (int)$recordFilter[0]['total'];
        }*/

        $total = 0;
        $queryTotal = "select count(*) as total from {$config['table']['name']} as a";
        $resultTotal = $this->entityManager->getConnection()->executeQuery($queryTotal);
        if($resultTotal->rowCount() > 0){
            $recordTotal = $resultTotal->fetchAllAssociative();
            $total = (int)$recordTotal[0]['total'];
        }

        if($config['debug'] != 1){
            $query = "";
        }

        return new JsonResponse(
            [
                'draw'            => $draw,
                'recordsFiltered' => $flagSerch?$filterTotal:$total,
                'recordsTotal'    => $total,
                'data'            => $data,
                'query'           => $query,
            ]);
    }
}