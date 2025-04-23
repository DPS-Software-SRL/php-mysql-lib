<?php

namespace Dps;

use Exception;

class MysqlException extends Exception { 
    var $MysqlError;
    var $MysqlNro;

    public function __construct($texto, $nro = 0, Exception|null $previous = null) {
        parent::__construct( (string)$texto, (int)$nro);
        $this->MysqlError = $texto;
        $this->MysqlNro   = $nro;
        error_log("MysqlException: $nro - $texto"); 
        
    }
}
