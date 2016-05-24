<?php

class Query extends Entity{

    public function __construct($queryFirstPart = 'select * from query'){
        parent::__construct($queryFirstPart);
    }
}
?>