<?php

namespace Dps;

use Exception;

class MysqlExcep extends Exception { 

    public function __construct($texto, $nro = 0, Exception $previous = null) {
        $this->MysqlError = $texto;
        $this->MysqlNro   = $nro;
        error_log("MysqlExcep: $nro - $texto"); 
    }
}
