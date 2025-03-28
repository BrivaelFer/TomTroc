<?php

class AbstractRepository
{
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }
    private function connect(): PDO
    {
        try{
            $db = new PDO('mysql:host=localhost;dbname=tomtroc_p6;charset=utf8','root','',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(\Exception $e){
            die('Erreur: '.$e->getMessage());
        }
        return $db;
    }
    protected function generatFilterQuery(array $filters, string $type = 'and'): string
    {
        $res = "";
        $first = true;
        $type = strtoupper($type);
        foreach($filters as $col=>$_)
        {
            if(preg_match('/[^a-zA-Z0-9_]/', $col) == 1 || strlen($col) > 25)
            {
                return "";
            }
            $res .= (($first?" WHERE ":" $type "). "$col = :$col" );
            $first = false;
        }
        return $res;
    }
    protected function generatOrderQuery(array $orders): string
    {
        $res = "";
        $first = true;
        foreach($orders as $col=>$order)
        {
            if(preg_match('/[^a-zA-Z0-9_]/', $col) == 1 || strlen($col) > 25)
            {
                return "";
            }
            $res .= ($first?" ORDER BY ":" AND "). "$col ". (($order == -1)? 'DESC': 'ASC');
            $first = false;
        }
        return $res;
    }
    protected function generatLimitQuery(int $limit): string
    {
        return $limit >= 0 ? " LIMIT $limit" : "";
    }
}