<?php

namespace Dps;

use Exception;

class MysqlException extends Exception { 
    var $MysqlError;
    var $MysqlNro;

    public function __construct($texto, $nro = 0, Exception $previous = null) {
        parent::__construct($texto, $nro);
        $this->MysqlError = $texto;
        $this->MysqlNro   = $nro;
        error_log("MysqlException: $nro - $texto"); 
        
    }
}
