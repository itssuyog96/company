<?php
/**
 * Created by PhpStorm.
 * User: itssu
 * Date: 25-Jul-16
 * Time: 11:46 AM
 */

require_once('../../login/classes/Login.php');
require_once('../../../scripts/sql/shared/ez_sql_core.php');
require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../../scripts/db-config.php');
require_once('../../../scripts/classes/employee.php');

$login = new Login();


// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == false)
{
    header('Location:../login/');
}

$e = new Employee();

try{
    $data = $e->retrieveArtistAll();
    $datax = json_decode($data, true);
    for($i = 0; $i < sizeof($datax); $i++){
        $id = $datax[$i]['EMPID'];
        try{
            $bid =  $e->getArtistAssignBids($id);
        }catch(Exception $em){
            $bid = 0;
        }

        $datax[$i]['ARTISTASSIGNBIDS'] = $bid;
    }
    $data = json_encode($datax);

    echo '{"data":'.$data.'}';
}
catch(Exception $em){
    echo $em->getMessage();
}
