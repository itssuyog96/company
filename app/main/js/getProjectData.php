<?php

require_once('../../login/classes/Login.php');
require_once('../../../scripts/sql/shared/ez_sql_core.php');
require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../../scripts/db-config.php');
require_once('../../../scripts/classes/employee.php');
require_once('../../../scripts/classes/project.php');

$login = new Login();



// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == false)
{
    header('Location:../login/');
}

$e = new Employee();

if($e->get_emp('oplogno') == 999){
    header("Location: ../firstLogin.php");
}

$p = new Project();
try{
    $data = $p->retrieveAll();
    $datax = json_decode($data, true);
    for($i = 0; $i < sizeof($datax); $i++){
        $ptypeid = $datax[$i]['PRJCTTYPE'];
        $ptype =  $p->getProjectType($ptypeid);
        $datax[$i]['PRJCTTYPE'] = $ptype;
        $datax[$i]['PRJCTTYPEID'] = $ptypeid;
    }

    $data = json_encode($datax);
    echo '{"data":'.$data.'}';
}
catch(Exception $e){
    echo $e->getMessage();
}
