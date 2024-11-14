<?php

namespace Dps;

use Dps\MysqlException, PDO, PDOException;


class Mysql {
    private $enTransaction          = false;
    private $isPrep                 = false;
    public  $logDeConsultas         = false;
    private $paramsTypes = [
        'b' => PDO::PARAM_BOOL,
        'n' => PDO::PARAM_NULL,
        'i' => PDO::PARAM_INT,
        's' => PDO::PARAM_STR,
    ];
    private $pdo;
    private $problemasEnTransaccion = false;
    private $stmt;
    private $ultimaQuery;  // String de la ultima query ejecutada;
    private $usuario = '';

    /**
     * Constructor for the MySQL.
     *
     * @param string $sqlserver The server name for the database connection.
     * @param string $sqluser The username for the database connection.
     * @param string $sqlpassword The password for the database connection.
     * @param string $database The name of the database.
     * @param int $port The port number for the database connection (default is 3306).
     * @throws PDOException If there is an error connecting to the database.
     * @return void
     */
    function __construct($sqlserver, $sqluser, $sqlpassword, $database, $port = 3306) {
        try {
            $this->pdo = new PDO("mysql:host={$sqlserver};port={$port};dbname={$database}", $sqluser, $sqlpassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

            $this->setUsuario( $_SESSION['UsuarioConectado'] ?? 'DPS' );

        } catch (PDOException $e) {
            $txt = "PDO connection failure: " . $e->getMessage();
            error_log( $txt );
            http_response_code(500);
            throw $e;                        
        }
    }

    function __destruct() {
        $this->pdo = null;
    }


    /**
     * Ejecuta la SQL tipo INSERT/UPDATE/DELETE/REPLACE 
     * agregandole los 4 campos "DPS" ( ins_usuario, ins_horario, act_usuario, act_horario )
     * @throws MysqlException If there is an error 
     * @param mixed $query
     * @param mixed $params
     * @return bool|int
     */
    function ejecutarIns($query, $params = false  ) {
        $query = $this->stringIns( $query );

        return $this->ejecutar($query, $params);
    }

    /**
     * Ejecuta la SQL tipo INSERT/UPDATE/DELETE/REPLACE 
     * agregandole los 2 campos "DPS" ( act_usuario, act_horario )     * 
     * @param mixed $query
     * @param mixed $params
     * @throws MysqlException If there is an error 
     * @return bool|int
     */

    function ejecutarAct($query, $params = false  ) {
        $query = $this->stringAct( $query );
        return $this->ejecutar($query, $params);
    }


    /**
     * Registra un mensaje de error en el archivo de log
     *
     * @param string $txt El mensaje a registrar en el archivo de log.
     */
    function logE( $txt ) {
        $txt = "[SQLERR] $txt";
        error_log( $txt );
    }
    

    /**
     * Registra un mensaje en el archivo de log.
     *
     * @param string $txt El mensaje a registrar en el archivo de log.
     */
    function logC( $txt ) {
        if($this->logDeConsultas) {
          error_log( "[SQL] {$_SERVER['PHP_SELF']}\n$txt" );
        }
    }

    
    /**
     * Confirma una transacción en la base de datos.
     * Si durante la transacción hay problemas, se hace un rollback.
     *
     * @return bool Devuelve TRUE si la transacción se confirmó correctamente, FALSE en caso contrario. O FALSE si tuvo que hacer ROLLBACK
     */
    function commit() {
        $this->logC( 'COMMIT' );
        
        if( $this->enTransaction && $this->problemasEnTransaccion ) {
          $this->logC( 'ROLLBACK' );
          $this->rollback();
          return false;

        } else {
          $this->enTransaction = false;
          $this->problemasEnTransaccion = false;
          return $this->pdo->commit();
        }
    }


    /**
     * Inicia una transacción en la base de datos.
     *
     * @return bool Devuelve TRUE si la transacción se inició correctamente, FALSE en caso contrario.
     */
    function startTransaction() {
        $this->logC( 'START TRANSACTION' );
        
        $this->enTransaction = true;
        $this->problemasEnTransaccion = false;
        return $this->pdo->beginTransaction();
    }


    /**
     * Realiza un rollback de la transacción actual.
     *
     * @return bool Devuelve TRUE si el rollback se realizó correctamente, FALSE en caso contrario.
     */
    function rollback() {
        $this->logC( 'ROLLBACK' );
        
        $this->enTransaction = false;
        $this->problemasEnTransaccion = false;
        return $this->pdo->rollback();
    }

    /**
     * Ejecuta una consulta SQL y devuelve el número de filas afectadas o el número de filas devueltas.
     *
     * @param string $query La consulta SQL a ejecutar.
     * @param mixed $params (opcional) Los parámetros a enlazar a la consulta. [['s', $valor1], ['i', $valor2], ...]
     * @throws MysqlException If there is an error 
     * @return int|false El número de filas afectadas o el número de filas devueltas, o false si la consulta falló.
     */
    function ejecutar( $query, $params = false )
    {
        if( $this->enTransaction && $this->problemasEnTransaccion )
            return false;

        $this->isPrep = ( $params !== false );

        // Remove any pre-existing queries
        unset($this->stmt);

        $this->ultimaQuery = $query;

        $this->logC( $query );

        $status = false;

        try {
            if( $this->isPrep ) {
                $this->logC( "Parametros: " . print_r( $params, 1 ) );
          
                $this->stmt = $this->pdo->prepare($query);
                // bind params
                foreach ($params as $key => $param) {
                    $this->stmt->bindValue($key + 1, $param[1], $this->paramsTypes[$param[0]]);
                }
                $status = $this->stmt->execute();

            } else {
                $status = $this->stmt = $this->pdo->query( $query );
            }
        } catch (PDOException $e) {
            $this->logE( $e->getMessage() . " con $query");
            $this->logE("Parametros: ". print_r($params, 1));
        }


        if( $status ) {
            // Devuelve num_rows o affected_rows
            return $this->stmt->rowCount();

        } else {

            $this->problemasEnTransaccion = true;
            $this->tratarError( $params );
            return false;
        }
    }

    
    private function stringIns( $sql )
    {
        $sql = trim($sql);

        // Quito el parentesis final si lo tenia
        if( substr($sql, -1, 1) == ')' )
            $sql = trim( substr($sql, 0, strlen($sql)-1 ) );

        // Agrega una coma al final del SQL si no habia sido pasada
        if( substr($sql, -1, 1) != ',' )
            $sql .= ",";

        return $sql .= " '{$this->usuario}', NOW(), '{$this->usuario}', NOW() ) ";
    }


    private function stringAct( $sql )
    {
        $where = '';
        if( ( $p = strpos(strtolower($sql),"where") ) > 0 )
        {
            $where = substr($sql, $p );
            $sql = substr( $sql, 0, $p -1 );
        }


        // Agrega una coma al final del SQL si no habia sido pasada
        $sql = trim($sql);
        if( substr($sql, -1, 1) != ',' )
            $sql .= ",";

        $sql .= " act_usuario = '{$this->usuario}', act_horario = NOW() ";
        $sql .= $where;

        return $sql;
    }

    /**
     * Ejecuta una consulta SQL y devuelve los resultados como array asociativo.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param mixed $params (opcional) Los parámetros a enlazar a la consulta SQL.
     * @param int $tipo (opcional) El tipo de fetch a utilizar (PDO::FETCH_ASSOC, PDO::FETCH_BOTH, PDO::FETCH_OBJ, etc.). Por defecto es PDO::FETCH_ASSOC.
     * @return mixed Los resultados de la consulta SQL, o false si no se pudo ejecutar la consulta.
     */
    function resultado( $sql, $params = false, $tipo = PDO::FETCH_ASSOC ) 
    {
        if( $this->ejecutar( $sql, $params ) ) {
            $salida = $this->stmt->fetchAll( $tipo );
            
            // Las SQL de un solo campo son tratadas diferentes para mantener retrocompatibilidad
            if( $this->stmt->columnCount() ===  1) {                
                if( $tipo == PDO::FETCH_ASSOC ) {
                    $columna = $this->stmt->getColumnMeta(0)['name'];

                } else if ($tipo == PDO::FETCH_NUM) {
                    $columna = 0;
                }
                $salida = array_column($salida, $columna );
            }

            return $salida;

        } else {
            return false;
        }
    }

    /**
     * Ejecuta una consulta SQL y devuelve los resultados como arrays. 
     * Tomando el primer campo de cada registro y usandolo como clave del array
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param mixed $params (opcional) Los parámetros a enlazar a la consulta SQL.
     * @throws MysqlException If there is an error 
     * @return mixed Los resultados de la consulta SQL, o false si no se pudo ejecutar la consulta.
     */
    function resultadoAssoc( $sql, $params = false ) 
    {
      $salida = $this->resultado( $sql, $params );

      if( ! is_array($salida) )
        return false;

      foreach( $salida as $array ) {
        $v = null;
        if(! is_array($array) ) {
            $primero = $array;

        } else {
            $primero = array_shift($array);
            if( $array == null )
                $v = null;
            else if( count($array) == 1)
                $v = array_shift($array);
            else
                $v = $array;
        }
        $opciones[$primero] = $v;
      }

	  return $opciones;
    }


    /**
     * Ejecuta una consulta SQL y devuelve los resultados como arrays numericos.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param mixed $params (opcional) Los parámetros a enlazar a la consulta SQL.
     * @throws MysqlException If there is an error 
     * @return mixed Los resultados de la consulta SQL, o false si no se pudo ejecutar la consulta.
     */
    function resultadoNumerico( $sql, $params = false ) 
    {
        return $this->resultado( $sql, $params, PDO::FETCH_NUM );
    }

    /**
     * Genera un array especial para usarse en un combo ( select ) de FORMY
     *
     * @param string $sql La consulta SQL a ejecutar deberia tener 2 campos ( id y descripcion ).
     * @param mixed $params (opcional) Los parámetros a enlazar a la consulta SQL.
     * @param string $titulo (opcional) El valor predeterminado a mostrarse en el combo.
     * @throws MysqlException If there is an error 
     * @return array Un array de opciones generado a partir de la consulta SQL.
     */
    function arrayParaSelect( $sql = "", $params = false, $titulo = "-- Seleccione --" )
    {
        // $opciones['ninguno'] = $titulo;

        $arraySelect = $this->resultadoNumerico( $sql, $params );

        if( is_array($arraySelect) )
        {
          foreach( $arraySelect as $array )
             //$opciones[$array[0]] = $array[1];
             $opciones[] = [ 'id' => $array[0], 'txt' => $array[1] ];

          return $opciones;

        } else {
          return [[ 'id' => 0, 'txt' => "-- No hay datos disponibles --" ]];

        }
    }


    /**
     * La version original de @arrayParaSelect que devuelve la info con otro formato
     * @param mixed $sql
     * @param mixed $titulo
     * @throws MysqlException If there is an error 
     * @return array
     */
    function arrayParaSelectOriginal( $sql = "", $titulo = "-- Seleccione --" )
    {
        $opciones['ninguno'] = $titulo;

        $arraySelect = $this->resultadoNumerico( $sql );

        if( is_array($arraySelect) )
        {
          foreach( $arraySelect as $array )
             $opciones[$array[0]] = $array[1];

          return $opciones;

        } else {
          return array( 0 => "-- No hay datos disponibles --");

        }
    }    

	
    private function tratarError( $params, $f_deshabOnDuplicate = true )
    {
        // En caso de no poder eliminar el registro por tener CONSTRAINTS asociados
        // Automaticamente deshabilitamos el registro
        
        if( isset( $this->stmt ) ) {
            list($ultimoErrnoANSI, $ultimoErrno, $ultimoError) = $this->stmt->errorInfo();

        } else {
            list($ultimoErrnoANSI, $ultimoErrno, $ultimoError) = $this->pdo->errorInfo();            

        }

        $tmpSQL = $this->ultimaQuery;

        $this->ultimaQuery = $tmpSQL;

        if( $ultimoErrno == 1451 && $f_deshabOnDuplicate ) {
          $partes = $this->sql2array( $this->ultimaQuery );
        
            // buscar si existe el campo f_deshab en la tabla
            $sql2 = "SELECT COLUMN_NAME 
                       FROM INFORMATION_SCHEMA.COLUMNS 
                      WHERE TABLE_SCHEMA = DATABASE() 
                        AND TABLE_NAME = '{$partes['from']}' 
                        AND COLUMN_NAME = 'f_deshab'" ;
            $tiene_f_deshab = $this->campos( $sql2, 'COLUMN_NAME' );

            if( $tiene_f_deshab ) {
                $nuevaSQL = "UPDATE {$partes['from']} SET f_deshab = '1' WHERE {$partes['where']}";

	  // trampa para que este UPDATE se puede ejecutar sin problemas
          $this->problemasEnTransaccion = false;
		
          return $this->ejecutar( $nuevaSQL, $params );
            }
        }

        $txt = "{$_SERVER['PHP_SELF']} [$ultimoErrno]  $ultimoError\n$this->ultimaQuery";
        $this->logE( $txt );

        throw new MysqlException( $ultimoError, $ultimoErrno );

    }


    /**
     * Obtiene el primer ( o unico ) registro de la SQL.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param mixed $campo (opcional) El nombre del campo a obtener. Si no se proporciona, se devuelve la primera fila completa.
     * @param array $params (opcional) Los parámetros a enlazar a la consulta SQL.
     * @throws MysqlException If there is an error 
     * @return mixed El valor del campo solicitado o la primera fila completa, o false si no se encontraron filas.
     */
    function campos( string $sql, $campo = false, $params = false  ) {
      $tipoSalida = ( is_numeric( $campo ) ) ? PDO::FETCH_BOTH : PDO::FETCH_ASSOC;

      if( $this->ejecutar( $sql, $params ) ) {
        $row = $this->stmt->fetch( $tipoSalida );

        if( ! $row )
          return false;

       	if( $campo === false )
          return $row;

   	    return $row[$campo];

      } else {
        return false;
      }
    }


    /**
     * Hace Replace multiple en una tabla. 
     * REPLACE INTO tabla VALUES(...), (...), ...
     *
     * @param string $tabla The name of the table.
     * @param array $valores An array of values (registers) to be replaced.
     * @param string $params The parameter string for the query ( like 'ssiis' )
     * @param array $columnas OPTIONAL An array of column names to be replaced
     * @return bool Returns true if the execution is successful, false otherwise.
     */    
    function replacesMasivos( string $tabla, array $valores, string $params = '', $columnas = [] ) 
    {
        // Llama a insertMasivos pero con el parametro 'REPLACE'
        return $this->insertMasivos($tabla, $valores, $params, $columnas, 'REPLACE' );
    }

    /**
     * Inserta multiples registros en una tabla. 
     * INSERT INTO tabla VALUES(...), (...), ...
     *
     * @param string $tabla The name of the table.
     * @param array $valores An array of values (registers) to be inserted.
     * @param string $params The parameter string for the query ( like 'ssiis' )
     * @param array $columnas OPTIONAL An array of column names to be inserted
     * @param string $sentencia Do not change it
     * @return bool Returns true if the execution is successful, false otherwise.
     */    
    function insertMasivos( string $tabla, array $valores, string $params = '', $columnas = [], $sentencia = 'INSERT' ) 
    {
        // arma el string sql con los valores en una sola query
        $cantCols  = count($valores[0]);
        
        $sql       = "$sentencia INTO $tabla ";        
        
        if( $cantCols > 0 ) {
            $sql  .= "(" . implode(", ", $columnas) . ") ";            
        }

        if( '' === $params ) {
            $params = str_repeat( "s", $cantCols );
        }

        $strValues = "(" . str_repeat("?, ", $cantCols - 1) . "?)";
        $sql      .= "VALUES " . implode( ',', array_fill(0, count($valores), $strValues) );
        
        // Preparar la consulta
        $this->stmt = $this->pdo->prepare($sql);

        $progresivo = 1;
        foreach ($valores as $registro) {
            foreach( $registro as $key => $val ) {
                $tipo = $params[$key];
                $this->stmt->bindValue( $progresivo++, $val, $this->paramsTypes[$tipo]);
            }
        }
        
        return $this->stmt->execute();
    }    

    /**
     * Ejecuta multiples SQL en una sola conexion a la base ( muy rapido )
     * Util si no se necesita interactuar con los resultados de cada SQL
     * 
     * Si una de las SQL genera error, se aborta la ejecucion y se retorna false
     * 
     * Si una de las SQL genera el error 1451 ("Cannot delete or update a parent row") 
     * se genera un error, y NO SE DESHABILITA el registro como es habitual en Ejecutar()
     * 
     * @param array $aSqls An array of SQL statements to execute.
     * @param array $params An optional array of parameters to bind to the SQL statements. [['s', $algo], ... ]
     * @throws PDOException If there is an error executing the SQL statements.
     * @return bool Returns true if the SQL statements are executed successfully, false otherwise.
     */
    function multiSQL( array $aSqls, array $params = [] ) 
    {
        $sqls = implode(";", $aSqls);

        $this->logC( $sqls );

        $this->stmt = $this->pdo->prepare($sqls);

        // bind params
        if( count($params) > 0 ) {
            foreach ($params as $key => $param) {
                $this->stmt->bindValue($key + 1, $param[1], $this->paramsTypes[$param[0]]);
            }
        }
        
        // check for errors and collect query results
        try {
            $orden = 0;
            $status = $this->stmt->execute();
            do {
                // Esto no tiene sentido, pero funcionaria
                // debug( $this->stmt->fetchAll() );
                $orden++;
            } while ($this->stmt->nextRowset());
            return true;

        } catch (PDOException $e) {
            $this->ultimaQuery = $aSqls[$orden];
            $this->problemasEnTransaccion = true;
            $this->tratarError( $params, false );
            return false;
        }
    }

    /**
     * Devuelve el ID de la ultima insercion con AUTO_INCREMENT
     * @return mixed
     */
    function lastID() {
        $sql = "SELECT LAST_INSERT_ID() AS lastID";
        return $this->campos($sql, 'lastID');
    }


    private function sql2array( $sql, $statement = false )
    {
        $sql = trim( $sql );
    
        if( $statement ) $statement = strtolower($statement);
    
        $pattern = '/^'.
                   '(select|delete)(.*?)'.
                   'from(.*?)'.
                   '(?:where(.*?))?'.
                   '(?:group by(.*?))?'.
                   '(?:having(.*?))?'.
                   '(?:order by(.*?))?'.
                   '(?:limit(.*?))?'.
                   '$/is';
    
        if ( !preg_match($pattern, $sql, $match) ) return FALSE;
    
        $result            = array();
        $result['select']  = trim($match[2]);
        $result['from']    = trim($match[3]);
        $result['where']   = ( isset($match[4]) ) ? trim($match[4]) : '';
        $result['groupby'] = ( isset($match[5]) ) ? trim($match[5]) : '';
        $result['having']  = ( isset($match[6]) ) ? trim($match[6]) : '';
        $result['orderby'] = ( isset($match[7]) ) ? trim($match[7]) : '';
        $result['limit']   = ( isset($match[8]) ) ? trim($match[8]) : '';
    
        if( ! $statement  )
            return $result;
        else if( ! in_array($statement,array_keys($result)) )
            return false;
        else
            return $result[$statement];
    
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario( string $user )
    {
        $this->usuario = $user;
    }
    
}
