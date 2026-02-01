<?php 
// 1. The Product( The thing we are building -our SQL Query)
class SQLQuery{
    private array $parts=[];
    public function addPart(string $part){
        $this->parts[]=$part;
    }
    public function getQuery():string{
        return implode('',$this->parts).';';
    }
}
//2. The Builder (The Chef -knows how to put the query parts together)
class QueryBuilder{
    private SQLQuery $query;
    public function __construct(){
                          $this->query =new SQLQuery();
    }
    public function select(string $columns):self{
        $this->query->addPart("SELECT{$columns}");
        return $this;//RETURN ITSELF FOR METHOD CHAINING
    }
    public function from(string $table):self{
        $this->query->addPart("FROM{$table}");
        return $this;
    }
    public function where(string $condition):self{
        $this->query->addPart("WHERE{$condition}");
        return $this;
    }
    public function getResult():SQLQuery{
        return $this->query;
    }
}
//3. USAGE(The Directory -you, the programmer, telling the chef what to do)
  $builder =new QueryBuilder();
    $complexQuery =$builder
    ->select('name,email')
    ->from('users')
    ->where('status="active"')
    ->getResult();
echo "Built Query:".$complexQuery->getQuery();