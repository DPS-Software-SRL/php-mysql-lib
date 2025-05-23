<?php

namespace Dps;

/**
 * Summary of MysqlMessages
 */
class MysqlMessages { 

    static public $msg = [];

    public function __construct() { }

    /**
     * Devuelve el texto del numero de error indicado
     * @param int $nro
     * @return bool|string
     */
    static public function getMsg( int $nro ) {
        if( empty(self::$msg) ) {            
            self::$msg = self::setMessages();        
        }

        return self::$msg[$nro] ?? false;
    }

    /**
     * Setea mensajes de error
     * @return string[]
     */
    static private function setMessages() {

        return [

            1000 => "hashchk",
            1001 => "isamchk",
            1002 => "NO",
            1003 => "SI",
            1004 => "No puedo crear archivo",
            1005 => "No puedo crear tabla",
            1006 => "No puedo crear base de datos",
            1007 => "No puedo crear base de datos; la base de datos ya existe",
            1008 => "No puedo eliminar base de datos; la base de datos no existe",
            1009 => "Error eliminando la base de datos(no puedo borrar)",
            1010 => "Error eliminando la base de datos (No puedo borrar directorio)",
            1011 => "Error en el borrado",
            1012 => "No puedo leer el registro en la tabla del sistema",
            1013 => "No puedo obtener el estado",
            1014 => "No puedo acceder al directorio",
            1015 => "No puedo bloquear archivo",
            1016 => "No puedo abrir archivo",
            1017 => "No puedo encontrar archivo",
            1018 => "No puedo leer el directorio",
            1019 => "No puedo cambiar al directorio",
            1020 => "El registro ha cambiado desde la ultima lectura de la tabla",
            1021 => "Disco lleno. Esperando para que se libere algo de espacio..",
            1022 => "No puedo escribir, clave duplicada en la tabla",
            1023 => "Error en el cierre",
            1024 => "Error leyendo el fichero",
            1025 => "Error en el renombrado",
            1026 => "Error escribiendo el archivo",
            1027 => "Mensaje esta bloqueado contra cambios",
            1028 => "Ordeancion cancelada",
            1029 => "La vista no existe para",
            1030 => "Error desde el manejador de la tabla",
            1031 => "El manejador de la tabla no tiene esta opcion",
            1032 => "No puedo encontrar el registro en",
            1033 => "Informacion erronea en el archivo",
            1034 => "Clave de archivo erronea para la tabla; intente repararlo",
            1035 => "Clave de archivo antigua para la tabla; reparelo",
            1036 => "Mensaje es de solo lectura",
            1037 => "Memoria insuficiente. Reinicie el demonio e intentelo otra vez (necesita bytes)",
            1038 => "Memoria de ordenacion insuficiente. Incremente el tamano del buffer de ordenacion",
            1039 => "Inesperado fin de ficheroU mientras leiamos el archivo",
            1040 => "Demasiadas conexiones",
            1041 => "Memoria/espacio de traspaso insuficiente",
            1042 => "No puedo obtener el nombre de maquina de tu direccion",
            1043 => "Protocolo erroneo",
            1044 => "Acceso negado para usuario@ para la base de datos",
            1045 => "Acceso negado para usuario@ (Usando clave)",
            1046 => "Base de datos no seleccionada",
            1047 => "Comando desconocido",
            1048 => "La columna no puede ser nula",
            1049 => "Base de datos desconocida",
            1050 => "La tabla ya existe",
            1051 => "Tabla desconocida",
            1052 => "La columna en es ambigua",
            1053 => "Desconexion de servidor en proceso",
            1054 => "La columna en es desconocida",
            1055 => "Usado el cual no esta group by",
            1056 => "No puedo agrupar por",
            1057 => "El estamento tiene funciones de suma y columnas en el mismo estamento",
            1058 => "La columna con count no tiene valores para contar",
            1059 => "El nombre del identificador es demasiado grande",
            1060 => "Nombre de columna duplicado",
            1061 => "Nombre de clave duplicado",
            1062 => "Entrada duplicada para la clave",
            1063 => "Especificador de columna erroneo para la columna",
            1064 => "Mensaje cerca en la linea",
            1065 => "La query estaba vacia",
            1066 => "Tabla/alias es no unica",
            1067 => "Valor por defecto invalido para",
            1068 => "Multiples claves primarias definidas",
            1069 => "Demasiadas claves primarias declaradas. Un maximo de claves son permitidas",
            1070 => "Demasiadas partes de clave declaradas. Un maximo de partes son permitidas",
            1071 => "Declaracion de clave demasiado larga. La maxima longitud de clave es",
            1072 => "La columna clave no existe en la tabla",
            1073 => "La columna Blob no puede ser usada en una declaracion de clave",
            1074 => "Longitud de columna demasiado grande para la columna (maximo =).Usar BLOB en su lugar",
            1075 => "Puede ser solamente un campo automatico y este debe ser definido como una clave",
            1076 => "preparado para conexiones",
            1077 => "Apagado normal",
            1078 => "Recibiendo signal. Abortando",
            1079 => "Apagado completado",
            1080 => "Forzando a cerrar el thread usuario",
            1081 => "No puedo crear IP socket",
            1082 => "La tabla no tiene indice como el usado en CREATE INDEX. Crea de nuevo la tabla",
            1083 => "Los separadores de argumentos del campo no son los especificados. Comprueba el manual",
            1084 => "No puedes usar longitudes de filas fijos con BLOBs. Por favor usa 'campos terminados por '",
            1085 => "El archivo debe estar en el directorio de la base de datos o ser de lectura por todos",
            1086 => "El archivo ya existe",
            1087 => "Registros: Borrados: Saltados: Peligros",
            1088 => "Registros: Duplicados",
            1089 => "Parte de la clave es erronea. Una parte de la clave no es una cadena o la longitud usada es tan grande como la parte de la clave",
            1090 => "No puede borrar todos los campos con ALTER TABLE. Usa DROP TABLE para hacerlo",
            1091 => "No puedo ELIMINAR. compuebe que el campo/clave existe",
            1092 => "Registros: Duplicados: Peligros",
            1093 => "You cant specify target table for update in FROM clause",
            1094 => "Identificador del thread desconocido",
            1095 => "Tu no eres el propietario del thread",
            1096 => "No ha tablas usadas",
            1097 => "Muchas strings para columna y SET",
            1098 => "No puede crear un unico archivo log.(1-999)",
            1099 => "Tabla fue trabada con un READ lock y no puede ser actualizada",
            1100 => "Tabla no fue trabada con LOCK TABLES",
            1101 => "Campo Blob no puede tener valores patron",
            1102 => "Nombre de base de datos ilegal",
            1103 => "Nombre de tabla ilegal",
            1104 => "El SELECT puede examinar muchos registros y probablemente con mucho tiempo. Verifique tu WHERE y usa SET SQL_BIG_SELECTS=1 si el SELECT esta correcto",
            1105 => "Error desconocido",
            1106 => "Procedimiento desconocido",
            1107 => "Equivocado parametro count para procedimiento",
            1108 => "Equivocados parametros para procedimiento",
            1109 => "Tabla desconocida in",
            1110 => "Campo especificado dos veces",
            1111 => "Invalido uso de función' en grupo",
            1112 => "Tabla usa una extensión que no existe en esta MySQL versión",
            1113 => "Una tabla debe tener al menos 1 columna",
            1114 => "La tabla está llena",
            1115 => "Juego de caracteres desconocido",
            1116 => "Muchas tablas. MySQL solamente puede usar tablas en un join",
            1117 => "Muchos campos",
            1118 => "Tamaño de línea muy grande. Máximo tamaño de línea, no contando blob, es. Tu tienes que cambiar algunos campos para blob",
            1119 => "Sobrecarga de la pila de thread: Usada: de una pila. Use 'mysqld -O thread_stack=#' para especificar una mayor pila si necesario",
            1120 => "Dependencia cruzada encontrada en OUTER JOIN. Examine su condición ON",
            1121 => "Columna es usada con UNIQUE o INDEX pero no está definida como NOT NULL",
            1122 => "No puedo cargar función'",
            1123 => "No puedo inicializar función'",
            1124 => "No pasos permitidos para librarias conjugadas",
            1125 => "Función' ya existe",
            1126 => "No puedo abrir libraria conjugada",
            1127 => "No puedo encontrar función' en libraria",
            1128 => "Función' no está definida",
            1129 => "Servidor está bloqueado por muchos errores de conexión. Desbloquear con mysqladmin flush-hosts",
            1130 => "Servidor no está permitido para conectar con este servidor MySQL",
            1131 => "Tu estás usando MySQL como un usuario anonimo y usuarios anonimos no tienen permiso para cambiar las claves",
            1132 => "Tu debes de tener permiso para actualizar tablas en la base de datos mysql para cambiar las claves para otros",
            1133 => "No puedo encontrar una línea correponsdiente en la tabla user",
            1134 => "Líneas correspondientes: Cambiadas: Avisos",
            1135 => "No puedo crear un nuevo thread (errno). Si tu estás con falta de memoria disponible, tu puedes consultar el Manual para posibles problemas con SO",
            1136 => "El número de columnas no corresponde al número en la línea",
            1137 => "No puedo reabrir tabla",
            1138 => "Invalido uso de valor NULL",
            1139 => "Obtenido error de regexp",
            1140 => "Mezcla de columnas GROUP (MIN(),MAX(),COUNT()...) con no GROUP columnas es ilegal si no hat la clausula GROUP BY",
            1141 => "No existe permiso definido para usuario en el servidor",
            1142 => "Mensaje comando negado para usuario@ para tabla",
            1143 => "Mensaje comando negado para usuario@ para columna en la tabla",
            1144 => "Ilegal comando GRANT/REVOKE. Por favor consulte el manual para cuales permisos pueden ser usados",
            1145 => "El argumento para servidor o usuario para GRANT es demasiado grande",
            1146 => "Tabla no existe",
            1147 => "No existe tal permiso definido para usuario en el servidor en la tabla",
            1148 => "El comando usado no es permitido con esta versión de MySQL",
            1149 => "Algo está equivocado en su sintax",
            1150 => "Thread de inserción retarda no pudiendo bloquear para la tabla",
            1151 => "Muchos threads retardados en uso",
            1152 => "Conexión abortada para db usuario",
            1153 => "Obtenido un paquete mayor que max_allowed_packet",
            1154 => "Obtenido un error de lectura de la conexión pipe",
            1155 => "Obtenido un error de fcntl()",
            1156 => "Obtenido paquetes desordenados",
            1157 => "No puedo descomprimir paquetes de comunicación",
            1158 => "Obtenido un error leyendo paquetes de comunicación",
            1159 => "Obtenido timeout leyendo paquetes de comunicación",
            1160 => "Obtenido un error de escribiendo paquetes de comunicación",
            1161 => "Obtenido timeout escribiendo paquetes de comunicación",
            1162 => "La string resultante es mayor que max_allowed_packet",
            1163 => "El tipo de tabla usada no permite soporte para columnas BLOB/TEXT",
            1164 => "El tipo de tabla usada no permite soporte para columnas AUTO_INCREMENT",
            1165 => "INSERT DELAYED no puede ser usado con tablas, porque esta bloqueada con LOCK TABLES",
            1166 => "Incorrecto nombre de columna",
            1167 => "El manipulador de tabla usado no puede indexar columna",
            1168 => "Todas las tablas en la MERGE tabla no estan definidas identicamente",
            1169 => "No puedo escribir, debido al único constraint, para tabla",
            1170 => "Columna BLOB column usada en especificación de clave sin tamaño de la clave",
            1171 => "Todas las partes de un PRIMARY KEY deben ser NOT NULL; Si necesitas NULL en una clave, use UNIQUE",
            1172 => "Resultado compuesto de mas que una línea",
            1173 => "Este tipo de tabla necesita de una primary key",
            1174 => "Esta versión de MySQL no es compilada con soporte RAID",
            1175 => "Tu estás usando modo de actualización segura y tentado actualizar una tabla sin un WHERE que usa una KEY columna",
            1176 => "Clave no existe en la tabla",
            1177 => "No puedo abrir tabla",
            1178 => "El manipulador de la tabla no permite soporte para",
            1179 => "No tienes el permiso para ejecutar este comando en una transición",
            1180 => "Obtenido error durante COMMIT",
            1181 => "Obtenido error durante ROLLBACK",
            1182 => "Obtenido error durante FLUSH_LOGS",
            1183 => "Obtenido error durante CHECKPOINT",
            1184 => "Abortada conexión para db usuario servidor",
            1185 => "El manipulador de tabla no soporta dump para tabla binaria",
            1186 => "Binlog closed, cannot RESET MASTER",
            1187 => "Falla reconstruyendo el indice de la tabla dumped",
            1188 => "Error del master",
            1189 => "Error de red leyendo del master",
            1190 => "Error de red escribiendo para el master",
            1191 => "No puedo encontrar índice FULLTEXT correspondiendo a la lista de columnas",
            1192 => "No puedo ejecutar el comando dado porque tienes tablas bloqueadas o una transición activa",
            1193 => "Desconocida variable de sistema",
            1194 => "Tabla está marcada como crashed y debe ser reparada",
            1195 => "Tabla está marcada como crashed y la última reparación (automactica?) falló",
            1196 => "Aviso: Algunas tablas no transancionales no pueden tener rolled back",
            1197 => "Multipla transición necesita mas que max_binlog_cache_size bytes de almacenamiento. Aumente esta variable mysqld y tente de nuevo",
            1198 => "Esta operación no puede ser hecha con el esclavo funcionando, primero use STOP SLAVE",
            1199 => "Esta operación necesita el esclavo funcionando, configure esclavo y haga el START SLAVE",
            1200 => "El servidor no está configurado como esclavo, edite el archivo config file o con CHANGE MASTER TO",
            1201 => "Could not initialize master info structure; more error messages can be found in the MySQL error log",
            1202 => "No puedo crear el thread esclavo, verifique recursos del sistema",
            1203 => "Usario ya tiene mas que max_user_connections conexiones activas",
            1204 => "Tu solo debes usar expresiones constantes con SET",
            1205 => "Tiempo de bloqueo de espera excedido",
            1206 => "El número total de bloqueos excede el tamaño de bloqueo de la tabla",
            1207 => "Bloqueos de actualización no pueden ser adqueridos durante una transición READ UNCOMMITTED",
            1208 => "DROP DATABASE no permitido mientras un thread esté ejerciendo un bloqueo de lectura global",
            1209 => "CREATE DATABASE no permitido mientras un thread esté ejerciendo un bloqueo de lectura global",
            1210 => "Argumentos errados para",
            1211 => "no es permitido para crear nuevos usuarios",
            1212 => "Incorrecta definición de la tabla; Todas las tablas MERGE deben estar en el mismo banco de datos",
            1213 => "Encontrado deadlock cuando tentando obtener el bloqueo; Tente recomenzar la transición",
            1214 => "El tipo de tabla usada no soporta índices FULLTEXT",
            1215 => "No puede adicionar clave extranjera constraint",
            1216 => "No puede adicionar una línea hijo: falla de clave extranjera constraint",
            1217 => "No puede deletar una línea padre: falla de clave extranjera constraint",
            1218 => "Error de coneccion a master",
            1219 => "Error executando el query en master",
            1220 => "Error de",
            1221 => "Equivocado uso de y",
            1222 => "El comando SELECT usado tiene diferente número de columnas",
            1223 => "No puedo ejecutar el query porque usted tiene conflicto de traba de lectura",
            1224 => "Mezla de transancional y no-transancional tablas está deshabilitada",
            1225 => "Opción usada dos veces en el comando",
            1226 => "Usuario ha excedido el recurso (actual valor:)",
            1227 => "Acceso negado. Usted necesita el privilegio para esta operación",
            1228 => "Variable es una SESSION variable y no puede ser usada con SET GLOBAL",
            1229 => "Variable es una GLOBAL variable y no puede ser configurada con SET GLOBAL",
            1230 => "Variable no tiene un valor patrón",
            1231 => "Variable no puede ser configurada para el valor",
            1232 => "Tipo de argumento equivocado para variable",
            1233 => "Variable solamente puede ser configurada, no leída",
            1234 => "Equivocado uso/colocación",
            1235 => "Esta versión de MySQL no soporta todavia",
            1236 => "Recibió fatal error del master cuando leyendo datos del binary log",
            1237 => "Slave SQL thread ignorado el query debido a las reglas de replicación--tabla",
            1238 => "Variable es una variable",
            1239 => "Equivocada definición de llave extranjera para",
            1240 => "Referencia de llave y referencia de tabla no coinciden",
            1241 => "Operando debe tener columna(s)",
            1242 => "Subconsulta retorna mas que 1 línea",
            1243 => "Desconocido preparado comando handler dado para",
            1244 => "Base de datos Help está corrupto o no existe",
            1245 => "Cílica referencia en subconsultas",
            1246 => "Convirtiendo columna de para",
            1247 => "Referencia no soportada",
            1248 => "Cada tabla derivada debe tener su propio alias",
            1249 => "Select fué reducido durante optimización",
            1250 => "Tabla de uno de los SELECT no puede ser usada en",
            1251 => "Cliente no soporta protocolo de autenticación solicitado por el servidor; considere actualizar el cliente MySQL",
            1252 => "Todas las partes de una SPATIAL index deben ser NOT NULL",
            1253 => "COLLATION no es válido para CHARACTER SET",
            1254 => "Slave ya está funcionando",
            1255 => "Slave ya fué parado",
            1256 => "Tamaño demasiado grande para datos descomprimidos. El máximo tamaño es. (probablemente, extensión de datos descomprimidos fué corrompida)",
            1257 => "No suficiente memoria para zlib",
            1258 => "No suficiente espacio en el búfer de salida para zlib (probablemente, extensión de datos descomprimidos fué corrompida)",
            1259 => "ZLIB: Dato de entrada fué corrompido para zlib",
            1260 => "línea(s) fue(fueron) cortadas por group_concat()",
            1261 => "Línea no contiene datos para todas las columnas",
            1262 => "Línea fué truncada; La misma contine mas datos que las que existen en las columnas de entrada",
            1263 => "Datos truncado, NULL suministrado para NOT NULL columna en la línea",
            1264 => "Datos truncados, fuera de gama para columna en la línea",
            1265 => "Datos truncados para columna en la línea",
            1266 => "Usando motor de almacenamiento para tabla",
            1267 => "Ilegal mezcla de collations para operación",
            1268 => "Cannot drop one or more of the requested users",
            1269 => "No puede revocar todos los privilegios, derecho para uno o mas de los usuarios solicitados",
            1270 => "Ilegal mezcla de collations para operación",
            1271 => "Ilegal mezcla de collations para operación",
            1272 => "Variable no es una variable componente (No puede ser usada como XXXX.variable_name)",
            1273 => "Collation desconocida",
            1274 => "Parametros SSL en CHANGE MASTER son ignorados porque este slave MySQL fue compilado sin soporte SSL; pueden ser usados despues cuando el slave MySQL con SSL sea inicializado",
            1275 => "Servidor está rodando en modo --secure-auth, pero@ tiene clave en el antiguo formato; por favor cambie la clave para el nuevo formato",
            1276 => "Campo o referencia de SELECT fue resuelto en SELECT",
            1277 => "Parametro equivocado o combinación de parametros para START SLAVE UNTIL",
            1278 => "Es recomendado rodar con --skip-slave-start cuando haciendo replicación step-by-step con START SLAVE UNTIL, a menos que usted no esté seguro en caso de inesperada reinicialización del mysqld slave",
            1279 => "SQL thread no es inicializado tal que opciones UNTIL son ignoradas",
            1280 => "Nombre de índice incorrecto",
            1281 => "Nombre de catalog incorrecto",
            1282 => "Query cache fallada para configurar tamaño, nuevo tamaño de query cache es",
            1283 => "Columna no puede ser parte de FULLTEXT index",
            1284 => "Desconocida key cache",
            1285 => "MySQL esta inicializado en modo --skip-name-resolve. Usted necesita reinicializarlo sin esta opción para este derecho funcionar",
            1286 => "Desconocido motor de tabla",
            1287 => "Mensaje está desaprobado, use en su lugar",
            1288 => "La tabla destino del no es actualizable",
            1289 => "El recurso fue deshabilitado; usted necesita construir MySQL con para tener eso funcionando",
            1290 => "El servidor MySQL está rodando con la opción tal que no puede ejecutar este comando",
            1291 => "Columna tiene valor doblado en",
            1292 => "Equivocado truncado valor",
            1293 => "Incorrecta definición de tabla; Solamente debe haber una columna TIMESTAMP con CURRENT_TIMESTAMP en DEFAULT o ON UPDATE cláusula",
            1294 => "Inválido ON UPDATE cláusula para campo",
            1295 => "This command is not supported in the prepared statement protocol yet",
            1296 => "Got error from",
            1297 => "Got temporary error from",
            1298 => "Unknown or incorrect time zone",
            1299 => "Invalid TIMESTAMP value in column at row",
            1300 => "Invalid character string",
            1301 => "Result of() was larger than max_allowed_packet - truncated",
            1302 => "Conflicting declarations",
            1303 => "Cant create a from within another stored routine",
            1304 => "Mensaje already exists",
            1305 => "Mensaje does not exist",
            1306 => "Failed to DROP",
            1307 => "Failed to CREATE",
            1308 => "Mensaje with no matching label",
            1309 => "Redefining label",
            1310 => "End-label without match",
            1311 => "Referring to uninitialized variable",
            1312 => "PROCEDURE cant return a result set in the given context",
            1313 => "RETURN is only allowed in a FUNCTION",
            1314 => "Mensaje is not allowed in stored procedures",
            1315 => "The update log is deprecated and replaced by the binary log; SET SQL_LOG_UPDATE has been ignored",
            1316 => "The update log is deprecated and replaced by the binary log; SET SQL_LOG_UPDATE has been translated to SET SQL_LOG_BIN",
            1317 => "Query execution was interrupted",
            1318 => "Incorrect number of arguments for; expected, got",
            1319 => "Undefined CONDITION",
            1320 => "No RETURN found in FUNCTION",
            1321 => "FUNCTION ended without RETURN",
            1322 => "Cursor statement must be a SELECT",
            1323 => "Cursor SELECT must not have INTO",
            1324 => "Undefined CURSOR",
            1325 => "Cursor is already open",
            1326 => "Cursor is not open",
            1327 => "Undeclared variable",
            1328 => "Incorrect number of FETCH variables",
            1329 => "No data - zero rows fetched, selected, or processed",
            1330 => "Duplicate parameter",
            1331 => "Duplicate variable",
            1332 => "Duplicate condition",
            1333 => "Duplicate cursor",
            1334 => "Failed to ALTER",
            1335 => "Subselect value not supported",
            1336 => "Mensaje is not allowed in stored function or trigger",
            1337 => "Variable or condition declaration after cursor or handler declaration",
            1338 => "Cursor declaration after handler declaration",
            1339 => "Case not found for CASE statement",
            1340 => "Configuration file is too big",
            1341 => "Malformed file type header in file",
            1342 => "Unexpected end of file while parsing comment",
            1343 => "Error while parsing parameter (line)",
            1344 => "Unexpected end of file while skipping unknown parameter",
            1345 => "EXPLAIN/SHOW can not be issued; lacking privileges for underlying table",
            1346 => "File has unknown type in its header",
            1347 => "Mensaje is not",
            1348 => "Column is not updatable",
            1349 => "Views SELECT contains a subquery in the FROM clause",
            1350 => "Views SELECT contains clause",
            1351 => "Views SELECT contains a variable or parameter",
            1352 => "Views SELECT refers to a temporary table",
            1353 => "Views SELECT and views field list have different column counts",
            1354 => "View merge algorithm cant be used here for now (assumed undefined algorithm)",
            1355 => "View being updated does not have complete key of underlying table in it",
            1356 => "View references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them",
            1357 => "Cant drop or alter a from within another stored routine",
            1358 => "GOTO is not allowed in a stored procedure handler",
            1359 => "Trigger already exists",
            1360 => "Trigger does not exist",
            1361 => "Triggers is view or temporary table",
            1362 => "Updating of row is not allowed intrigger",
            1363 => "There is no row in trigger",
            1364 => "Field doesnt have a default value",
            1365 => "Division by 0",
            1366 => "Incorrect value for column at row",
            1367 => "Illegal value found during parsing",
            1368 => "CHECK OPTION on non-updatable view",
            1369 => "CHECK OPTION failed",
            1370 => "Mensaje command denied to user@ for routine",
            1371 => "Failed purging old relay logs",
            1372 => "Password hash should be a-digit hexadecimal number",
            1373 => "Target log not found in binlog index",
            1374 => "I/O error reading log index file",
            1375 => "Server configuration does not permit binlog purge",
            1376 => "Failed on fseek()",
            1377 => "Fatal error during log purge",
            1378 => "A purgeable log is in use, will not purge",
            1379 => "Unknown error during log purge",
            1380 => "Failed initializing relay log position",
            1381 => "You are not using binary logging",
            1382 => "The syntax is reserved for purposes internal to the MySQL server",
            1383 => "WSAStartup Failed",
            1384 => "Cant handle procedures with different groups yet",
            1385 => "Select must have a group with this procedure",
            1386 => "Cant use ORDER clause with this procedure",
            1387 => "Binary logging and replication forbid changing the global server",
            1388 => "Cant map file, errno",
            1389 => "Wrong magic in",
            1390 => "Prepared statement contains too many placeholders",
            1391 => "Key part length cannot be 0",
            1392 => "View text checksum failed",
            1393 => "Can not modify more than one base table through a join view",
            1394 => "Can not insert into join view without fields list",
            1395 => "Can not delete from join view",
            1396 => "Operation failed for",
            1397 => "XAER_NOTA: Unknown XID",
            1398 => "XAER_INVAL: Invalid arguments (or unsupported command)",
            1399 => "XAER_RMFAIL: The command cannot be executed when global transaction is in the state",
            1400 => "XAER_OUTSIDE: Some work is done outside global transaction",
            1401 => "XAER_RMERR: Fatal error occurred in the transaction branch - check your data for consistency",
            1402 => "XA_RBROLLBACK: Transaction branch was rolled back",
            1403 => "There is no such grant defined for user on host on routine",
            1404 => "Failed to grant EXECUTE and ALTER ROUTINE privileges",
            1405 => "Failed to revoke all privileges to dropped routine",
            1406 => "Data too long for column at row",
            1407 => "Bad SQLSTATE",
            1408 => "ready for connections. Version socket port",
            1409 => "Cant load value from file with fixed size rows to variable",
            1410 => "You are not allowed to create a user with GRANT",
            1411 => "Incorrect value for function",
            1412 => "Table definition has changed, please retry transaction",
            1413 => "Duplicate handler declared in the same block",
            1414 => "OUT or INOUT argument for routine is not a variable or NEW pseudo-variable in BEFORE trigger",
            1415 => "Not allowed to return a result set from a",
            1416 => "Cannot get geometry object from data you send to the GEOMETRY field",
            1417 => "A routine failed and has neither NO SQL nor READS SQL DATA in its declaration and binary logging is enabled; if non-transactional tables were updated, the binary log will miss their changes",
            1418 => "This function has none of DETERMINISTIC, NO SQL, or READS SQL DATA in its declaration and binary logging is enabled (you might want to use the less safe log_bin_trust_function_creators variable)",
            1419 => "You do not have the SUPER privilege and binary logging is enabled (you might want to use the less safe log_bin_trust_function_creators variable)",
            1420 => "You cant execute a prepared statement which has an open cursor associated with it. Reset the statement to re-execute it",
            1421 => "The statement has no open cursor",
            1422 => "Explicit or implicit commit is not allowed in stored function or trigger",
            1423 => "Field of view underlying table doesnt have a default value",
            1424 => "Recursive stored functions and triggers are not allowed",
            1425 => "Too big scale specified for column. Maximum is",
            1426 => "Too big precision specified for column. Maximum is",
            1427 => "For float(M,D), double(M,D) or decimal(M,D), M must be >= D (column)",
            1428 => "You cant combine write-locking of system table with other tables",
            1429 => "Unable to connect to foreign data source",
            1430 => "There was a problem processing the query on the foreign data source. Data source",
            1431 => "The foreign data source you are trying to reference does not exist. Data source error",
            1432 => "Cant create federated table. The data source connection string is not in the correct format",
            1433 => "The data source connection string is not in the correct format",
            1434 => "Cant create federated table. Foreign data src error",
            1435 => "Trigger in wrong schema",
            1436 => "Thread stack overrun: bytes used of a byte stack, and bytes needed. Use mysqld -O thread_stack=# to specify a bigger stack",
            1437 => "Routine body for is too long",
            1438 => "Cannot drop default keycache",
            1439 => "Display width out of range for column (max =)",
            1440 => "XAER_DUPID: The XID already exists",
            1441 => "Datetime function field overflow",
            1442 => "Cant update table in stored function/trigger because it is already used by statement which invoked this stored function/trigger",
            1443 => "The definition of table prevents operation on table",
            1444 => "The prepared statement contains a stored routine call that refers to that same statement. Its not allowed to execute a prepared statement in such a recursive manner",
            1445 => "Not allowed to set autocommit from a stored function or trigger",
            1446 => "Definer is not fully qualified",
            1447 => "View. has no definer information (old table format). Current user is used as definer. Please recreate the view",
            1448 => "You need the SUPER privilege for creation view with@ definer",
            1449 => "There is no@ registered",
            1450 => "Changing schema from to is not allowed",
            1451 => "Cannot delete or update a parent row: a foreign key constraint fails",
            1452 => "Cannot add or update a child row: a foreign key constraint fails",
            1453 => "Variable must be quoted with `...`, or renamed",
            1454 => "No definer attribute for trigger.. The trigger will be activated under the authorization of the invoker, which may have insufficient privileges. Please recreate the trigger",
            1455 => "Mensaje has an old format, you should re-create the object(s)",
            1456 => "Recursive limit (as set by the max_sp_recursion_depth variable) was exceeded for routine",
            1457 => "Failed to load routine. The table mysql.proc is missing, corrupt, or contains bad data (internal code)",
            1458 => "Incorrect routine name",
            1459 => "Table upgrade required. Please do REPAIR TABLE to fix it!",
            1460 => "AGGREGATE is not supported for stored functions",
            1461 => "Cant create more than max_prepared_stmt_count statements (current value)",
            1462 => "contains view recursion",
            1463 => "non-grouping field is used in clause",
            1464 => "The used table type doesnt support SPATIAL indexes",
            1465 => "Triggers can not be created on system tables",
            1466 => "Leading spaces are removed from name",
            1467 => "Failed to read auto-increment value from storage engine",
            1468 => "user name",
            1469 => "host name",
            1470 => "String is too long for (should be no longer than)",
            1471 => "The target table of the is not insertable-into",
            2000 => "Unknown MySQL error",
            2001 => "Cant create UNIX socket",
            2002 => "Cant connect to local MySQL server through socket",
            2003 => "Cant connect to MySQL server on",
            2004 => "Cant create TCP/IP socket",
            2005 => "Unknown MySQL server host",
            2006 => "MySQL server has gone away",
            2007 => "Protocol mismatch",
            2008 => "MySQL client ran out of memory",
            2009 => "Wrong host info",
            2010 => "Localhost via UNIX socket",
            2011 => "Mensaje via TCP/IP",
            2012 => "Error in server handshake",
            2013 => "Lost connection to MySQL server during query",
            2014 => "Commands out of sync; you cant run this command now",
            2015 => "Named pipe",
            2016 => "Cant wait for named pipe to host pipe",
            2017 => "Cant open named pipe to host pipe",
            2018 => "Cant set state of named pipe to host pipe",
            2019 => "Cant initialize character set",
            2020 => "Got packet bigger than max_allowed_packet bytes",
            2021 => "Embedded server",
            2022 => "Error on SHOW SLAVE STATUS",
            2023 => "Error on SHOW SLAVE HOSTS",
            2024 => "Error connecting to slave",
            2025 => "Error connecting to master",
            2026 => "SSL connection error",
            2027 => "Malformed packet",
            2028 => "This client library is licensed only for use with MySQL servers having license",
            2029 => "Invalid use of null pointer",
            2030 => "Statement not prepared",
            2031 => "No data supplied for parameters in prepared statement",
            2032 => "Data truncated",
            2033 => "No parameters exist in the statement",
            2034 => "Invalid parameter number",
            2035 => "Cant send long data for non-string/non-binary data types (parameter:)",
            2036 => "Using unsupported buffer type: (parameter:)",
            2037 => "Shared memory",
            2038 => "Cant open shared memory; client could not create request event",
            2039 => "Cant open shared memory; no answer event received from server",
            2040 => "Cant open shared memory; server could not allocate file mapping",
            2041 => "Cant open shared memory; server could not get pointer to file mapping",
            2042 => "Cant open shared memory; client could not allocate file mapping",
            2043 => "Cant open shared memory; client could not get pointer to file mapping",
            2044 => "Cant open shared memory; client could not create event",
            2045 => "Cant open shared memory; no answer from server",
            2046 => "Cant open shared memory; cannot send request event to server",
            2047 => "Wrong or unknown protocol",
            2048 => "Invalid connection handle",
            2049 => "Connection using old (pre-4.1.1) authentication protocol refused (client option secure_auth enabled)",
            2050 => "Row retrieval was canceled by mysql_stmt_close() call",
            2051 => "Attempt to read column without prior row fetch",
            2052 => "Prepared statement contains no metadata",
            2053 => "Attempt to read a row while there is no result set associated with the statement",
            2054 => "This feature is not implemented yet",
            2055 => "Lost connection to MySQL server at, system error",

        ];

    }
}