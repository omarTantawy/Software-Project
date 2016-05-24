<?php


class Insert extends FormProcessor{
    private $query_first ;

    public function __construct($modul , $quer){
        $module = $modul;
        $this->query_first = $quer;
        parent::__construct($module);
    }
    
    protected function excuteQuery(){
        
        Database::query($this->query_first.$this->columnsToInsert().'');
    }

    protected function isAvailable2($key , $table){

        $Result = Database::query(" select * from ".$table." where ".$key." = '".$_POST[$key]."'");
        return (mysqli_num_rows($Result) == 0);
    }

     
}
?>