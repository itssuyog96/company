<?php

include('../../../scripts/sql/shared/ez_sql_core.php');
include('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
include('../../../scripts/db-config.php');

$db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
$stat = $db->get_results("SELECT PTYPEID, PTYPENM FROM PTYPEMASTER ORDER BY PTYPENM");

if(!$stat)
    die("Error occured fetching data from database. Please contact database administartor!");

$roles = array();
foreach($stat as $s)
{
    $i = array();
    array_push($i, $s->PTYPEID);
    array_push($i, $s->PTYPENM);

    array_push($roles, $i);
}

echo json_encode($roles);

?>
