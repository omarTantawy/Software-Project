<?php


class Update extends FormProcessor
{
    private $query_first;
    private $id;
    private $record;
    private $idname;

    public function __construct($id, $idnam, $record_, $modul, $quer)
    {
        $module = $modul;
        $this->query_first = $quer;
        $this->id = $id;
        $this->idname = $idnam;
        $this->record = $record_;
        parent::__construct($module);
    }

    protected function excuteQuery()
    {

        Database::query($this->query_first . ' ' . $this->columnsToUpdate() . " WHERE " . $this->idname . " = " . $this->id . " ");
    }

    protected function isAvailable2($key, $table)
    {

        $Result = Database::query(" select * from " . $table . " where " . $key . " = " . "'" . $_POST[$key] . "'");

        return (mysqli_num_rows($Result) == 0);
    }


}

?>