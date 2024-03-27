<?php
$env = parse_ini_file('../config/.env');
define('DIRETORIO_BACKEND', $env['DIRETORIO_BACKEND']);

require DIRETORIO_BACKEND . 'database/db_connection.php';
