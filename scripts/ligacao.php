#!/usr/bin/php5 -q
<?php
define( "HOST", "localhost" );
define( "USER", "root" );
define( "PASS", "tagima" );
ob_implicit_flush( true );
set_time_limit( 6 );
error_reporting( 0 );
$in     = fopen( "php://stdin", "r" );
$stdlog = fopen( "/var/log/asterisk/agi.log", "w" );
// Habilita modo debugging (mais verbose)
$debug  = true;

// Do function definitions before we start the main loop
function read()
{
    global $in, $debug, $stdlog;
    $input = str_replace( "\n", "", fgets( $in, 4096 ) );
    if ( $debug )
        fputs( $stdlog, "read: $input\n" );
    return $input;
}

function write( $line )
{
    global $debug, $stdlog;
    if ( $debug )
        fputs( $stdlog, "write: $line\n" );
    echo $line . "\n";
}

// Coloca os headers AGI dentro de um array
while ( $env = read() )
{
    $s                                 = split( ": ", $env );
    $agi[ str_replace( "agi_", "", $s[ 0 ] ) ] = trim( $s[ 1 ] );
    if ( ($env == "") || ($env == "\n") )
    {
        break;
    }
}
//write( "GET VARIABLE NOTA1" );
//$c     = read();
//$nota1 = substr( $c, 14 );
//$nota1 = substr( $nota1, 0, -1 );
//if ( $nota1 == "" )
//{
//    $nota1  = 11;
//}
//write( "GET VARIABLE CELULA" );
//$c      = read();
//$celula = substr( $c, 14 );
//$celula = substr( $celula, 0, -1 );
//write( "GET VARIABLE NOTA2" );
//$c      = read();
//$nota2  = substr( $c, 14 );
//$nota2  = substr( $nota2, 0, -1 );
//if ( $nota2 == "" )
//{
//    $nota2      = 11;
//}
//write( "GET VARIABLE ID" );
//$c          = read();
//$idpesquisa = substr( $c, 14 );
//$idpesquisa = substr( $idpesquisa, 0, -1 );
//write( "GET VARIABLE NOTA3" );
//$c          = read();
//$nota3      = substr( $c, 14 );
//$nota3      = substr( $nota3, 0, -1 );
//if ( $nota3 == "" )
//{
//    $nota3       = 11;
//}
//write( "GET VARIABLE ID" );
//$c           = read();
//$idpesquisa  = substr( $c, 14 );
//$idpesquisa  = substr( $idpesquisa, 0, -1 );
//write( "GET VARIABLE TIME" );
//$c           = read();
//$datetime    = substr( $c, 14 );
//$datetime    = substr( $datetime, 0, -1 );
//write( "GET VARIABLE TIMEFIM" );
//$c           = read();
//$datetimefim = substr( $c, 14 );
//$datetimefim = substr( $datetimefim, 0, -1 );
//write( "GET VARIABLE CELULA" );
//$c           = read();
//$celula      = substr( $c, 14 );
//$celula      = substr( $celula, 0, -1 );
write( "GET VARIABLE TELCALL" );
$c           = read();
$calleridnum = substr( $c, 14 );
$calleridnum = substr( $calleridnum, 0, -1 );
write( "GET VARIABLE TELCAL" );
$c           = read();
$calleridnum = substr( $c, 14 );
$calleridnum = substr( $calleridnum, 0, -1 );
//write( "GET VARIABLE MATRICULA" );
//$c           = read();
//$matricula   = substr( $c, 14 );
//$matricula   = substr( $matricula, 0, -1 );
//write( "GET VARIABLE TELDNID" );
//$c           = read();
//$dnid        = substr( $c, 14 );
//$dnid        = substr( $dnid, 0, -1 );
//write( "GET VARIABLE MATRICULA" );
//$c           = read();
//$matricula   = substr( $c, 14 );
//$matricula   = substr( $matricula, 0, -1 );
//write( "GET VARIABLE TELCALORIG" );
//$c           = read();
//$telorigem   = substr( $c, 14 );
//$telorigem   = substr( $telorigem, 0, -1 );
//Inicia conexao com banco de dados
$conn        = @mysql_connect( HOST, USER, PASS );
//Seleciona a base de dados a ser utilizada
mysql_select_db( 'central', $conn );
//Imprime as variaveis a serem inseridas
echo "VERBOSE \"Iniciou Inserção no Banco\" \n";
//echo "VERBOSE \"$idpesquisa\" \n"; //comentar
//echo "VERBOSE \"$matricula\" \n";
//echo "VERBOSE \"$datetime\" \n";
//echo "VERBOSE \"$datetimefim\" \n";
//echo "VERBOSE \"$nota1\" \n";
//echo "VERBOSE \"$nota2\" \n";
//echo "VERBOSE \"$nota3\" \n";
echo "VERBOSE \"$calleridnum\" \n"; //comentar
//echo "VERBOSE \"$celula\" \n";
//echo "VERBOSE \"$dnid\" \n"; //comentar
//Variavel que recebe a instrucao SQL a ser execultada
$query2      = "insert into central.chamada (
                    calleridnum
                )
                values
                ( 
                    '".$calleridnum."' 
                )";
//Execucao do camando SQL
$sql         = mysql_query( $query2, $conn );
//Teste de validacao da insecao no Banco de dados
if ( $sql )
{
    echo "VERBOSE \"Terminou Inserção no Banco\" \n";
}
else
{
    echo mysql_error($conn);
}
//@odbc_close($conn);
@mysql_close( $conn );
fclose( $in );
fclose( $stdlog );
exit;
?>
