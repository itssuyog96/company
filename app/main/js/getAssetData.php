<?php
/**
 * Created by PhpStorm.
 * User: itssu
 * Date: 24-Jul-16
 * Time: 1:32 PM
 */

require_once('../../login/classes/Login.php');
require_once('../../../scripts/sql/shared/ez_sql_core.php');
require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../../scripts/db-config.php');
require_once('../../../scripts/classes/employee.php');
require_once('../../../scripts/classes/project.php');
require_once('../../../scripts/classes/asset.php');


$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == false) {
    header('Location:../../login/');
}

$e = new Employee();

$db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

if(isset($_GET['id']) && !empty($_GET['id'])){

    $a = new Asset($_GET['id']);
    try{
        $data = $a->retrieveAll();
        echo '{"data":'.$data.'}';
    }
    catch(Exception $e){
        header('HTTP/1.1 503 Unauthorized/Bad Request');
        echo $e->getMessage();
    }
    
}
else{
    header('HTTP/1.1 503 Unauthorized/Bad Request');
    echo "BAD REQUEST";
}



?>
