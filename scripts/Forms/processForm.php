<?php

require_once('../../scripts/db-config.php');
require_once('../../scripts/sql/shared/ez_sql_core.php');
require_once('../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../app/login/classes/Login.php');
require_once('../classes/employee.php');
require_once('../classes/project.php');
require_once('../classes/manager.php');
require_once('../classes/artist.php');
require_once('../classes/management.php');
require_once('../classes/toast.php');

/**
 *Return JSON for Toaster
 */
function createProject(){
    $t = new Toast('New Project Add Failed', 'Module Under Development!', 'warning');
    echo $t->getToast();
    exit(0);

    $lg = new Login();

    // ... ask if we are logged in here:
    if ($lg->isUserLoggedIn() == false){
       //user not logged in error
        $t = new Toast('New Project Add Failed', 'Unauthorized request!', 'warning');
        echo $t->getToast();

     }
     else{

      $m = new Management();

      $pid      = $_POST['pid'];
      $pnm      = $_POST['pnm'];
      $pdesc    = $_POST['pdesc'];
      $opendt   = $_POST['opendt'];
      $closedt  = $_POST['closedt'];


      try{
        $m->create_project($pid, $pnm, $pdesc, $opendt, $closedt);
        $t = new Toast('New Project Added', 'Project ID : <strong>'.$pid.'</strong>', 'info');
        echo $t->getToast();
      }
      catch(Exception $e){
        $t = new Toast('New Project Add Failed', $e->getMessage(), 'error');
        echo $t->getToast();
      }
  }
}

function createUser(){

    $lg = new Login();

    // ... ask if we are logged in here:
    if ($lg->isUserLoggedIn() == false){
       //user not logged in error
        $t = new Toast('New User Add Failed', 'Unauthorized request!', 'warning');
        echo $t->getToast();
     }
     else{

      $e = new Employee();
      if(strcmp($e->get_emp('rolenm'),'MANAGER') == 0){
        $empid    = $_POST['empid'];
        $deptid   = $e->get_emp('deptid');
        $userid   = $_POST['username'];
        $roleid   = $_POST['roleid'];
        $password = $_POST['pass'];

        try{
          $e->addNewUser($deptid, $empid, $roleid, $userid, $password);
          $t = new Toast('New User Created', 'Uesr ID : <strong>'.$userid.'</strong>', 'info');
          echo $t->getToast();
        }
        catch(Exception $ex){

          $t = new Toast('New User Add Failed', $ex->getMessage(), 'error');
          echo $t->getToast();
        }
      }

      else if(strcmp($e->get_emp('rolenm'),'MANAGEMENT') == 0){

        $empid    = $_POST['empid'];
        $deptid   = $_POST['deptid'];
        $userid   = $_POST['username'];
        $roleid   = $_POST['roleid'];
        $password = $_POST['pass'];

        try{
          $e->addNewUser($deptid, $empid, $roleid, $userid, $password);
          $t = new Toast('New User Created', 'Uesr ID : <strong>'.$userid.'</strong>', 'info');
          echo $t->getToast();
        }
        catch(Exception $ex){
          $t = new Toast('New User Add Failed', $ex->getMessage(), 'error');
          echo $t->getToast();
        }
      }
      else{
        $t = new Toast('New User Add Failed', $e->get_emp('rolenm').' is not allowed to create new User', 'warning');
        echo $t->getToast();
      }
  }
}

function createShot(){
  $t = new Toast('Create new Shot Failed', 'Module Under Development', 'warning');
  echo $t->getToast();
}


function createAsset(){
  $t = new Toast('Create new Asset Failed', 'Module Under Development', 'warning');
  echo $t->getToast();
}

function addShotVersion(){
  $t = new Toast('Add new Shot Version Failed', 'Module Under Development', 'warning');
  echo $t->getToast();
}

function addAssetVersion(){
  $t = new Toast('Add new Asset Version Failed', 'Module Under Development', 'warning');
  echo $t->getToast();
}

function addProjectType(){
    $t = new Toast('Add new Project Type Failed', 'Module Under Development', 'warning');
    echo $t->getToast();
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "CP"  : createProject();   break;
      case "CU"  : createUser();      break;
      case "CS"  : createShot();      break;
      case "CA"  : createAsset();     break;
      case "AAV" : addAssetVersion(); break;
      case "ASV" : addShotVersion();  break;
      case "APT" : addProjectType();  break;
    }
  }
}
else{
  header('HTTP/1.1 503 Unauthorized/Bad Request');
  //header('Content-Type: application/json; charset=UTF-8');
  echo '<h1>503 UNAUTHORIZED/BAD REQUEST</h1><hr>';
  echo 'You are not authorized to access this content';
}



?>
