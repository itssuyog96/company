<?php
/**
 * Created by PhpStorm.
 * User: itssu
 * Date: 23-Jul-16
 * Time: 11:41 AM
 */

require_once('../../login/classes/Login.php');
require_once('../../../scripts/sql/shared/ez_sql_core.php');
require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../../scripts/db-config.php');
require_once('../../../scripts/classes/employee.php');
require_once('../../../scripts/classes/project.php');


$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == false) {
    header('Location:../../login/');
}

$e = new Employee();

$db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
$proj = $_POST['project'];
if ($projList = $db->get_results("SELECT `PRJCTID`, `PRJCTNM` , `PRJCTDESCRI` FROM `PRJCTMASTER` WHERE PRJCTID = '$proj'")) {
    echo json_encode($projList);
} else {
    echo 'Error occured while fetching data';

}


?>
