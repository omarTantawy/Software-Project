<?php


abstract class Database
{

    static private $connection;
    static private $insertID;
    static private $affected_rows;

    static public function real_escape_string($str)
    {

        $global = Globals::getInstance();


        if (!Database::getConnection()) {
            Database::connect(
                $global->databaseServer,
                $global->databaseUserName,
                $global->databasePassword,
                $global->databaseName
            );
        }
        return mysqli_real_escape_string(Database::$connection, $str);
    }

    static public function getConnection()
    {
        return Database::$connection;
    }

    static public function connect($server, $username, $password, $database)
    {
        //echo $server;
        //Database::$connection = mysqli_connect("localhost", "root", "root" , "clinic");
        Database::$connection = mysqli_connect($server, $username, $password, $database);
        if (mysqli_connect_errno()) {
            sleep(10);
            Database::$connection = mysqli_connect($server, $username, $password, $database);
        }
        if (mysqli_connect_errno()) {
            $msg = '
            Database connection failed twice
            ';
            mail('omartantawy94@gmail.com', 'database error', $msg);
        }
        mysqli_select_db(Database::$connection, $database);
    }

    static public function query($query)
    {
        if (!Database::getConnection()) {

            $global = Globals::getInstance();

            Database::connect(
                $global->databaseServer,
                $global->databaseUserName,
                $global->databasePassword,
                $global->databaseName
            );
        }
        $b4 = microtime(true);
        $result = mysqli_query(Database::$connection, $query);
        Database::$insertID = mysqli_insert_id(Database::$connection);
        Database::$affected_rows = mysqli_affected_rows(Database::$connection);
        $error = mysqli_error(Database::$connection);
        $after = microtime(true);
        $execution = $after - $b4;
//while ( true){
//    echo $query;
//}


        if (!$result) {
            echo "DataBase Record Conflict/Security Error a mail sent to admin with error report";
            //mail("omartantawy94@gmail.com" , "Database error", $query );
            echo $query . '<br />' . $error;
            die();
        }

        return $result;
    }

    static public function insertID()
    {
        return Database::$insertID;
    }

    static public function affected_rows()
    {
        return Database::$affected_rows;
    }

    static public function close()
    {

        return mysqli_close(Database::$connection);
    }
}

?>