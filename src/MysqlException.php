<?php

namespace Dps;

use Exception;

class MysqlException extends Exception { 

    public function __construct($texto, $nro = 0, Exception $previous = null) {
        $this->MysqlError = $texto;
        $this->MysqlNro   = $nro;
        error_log("MysqlException: $nro - $texto"); 
    }
}
