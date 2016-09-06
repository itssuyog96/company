<?php

//require_once('../../login/classes/Login.php');
//require_once('../../../scripts/sql/shared/ez_sql_core.php');

//require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
//require_once('../../../scripts/db-config.php');
//require_once('../../../scripts/classes/employee.php');

class Manager{

  private $deptid = '';

  function __construct(){

    $e = new Employee();
    $this->deptid = $e->get_emp('deptid');
  }

  public function addNewUser($empid, $roleid, $username, $pass){
      //Adds new user and returns login id & password
      $flag=0;
      // check for minimum PHP version
      if (version_compare(PHP_VERSION, '5.3.7', '<')) {
          exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
      } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
          // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
          // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
          require_once('../../app/login/libraries/password_compatibility_library.php');
      }
      // include the config
      require_once('../../app/login/config/config.php');

      // include the to-be-used language, english by default. feel free to translate your project and include something else
      require_once('../../app/login/translations/en.php');
      // include the PHPMailer library
      require_once('../../app/login/libraries/PHPMailer.php');
      require_once('../../app/login/classes/Registration.php');
      $reg = new Registration();
      if($reg->registerNewUser($username, $pass, $pass)){
        $flag=1;
      }
      else{
        $flag=0;
      }

      if($db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST)){
        if($db->query("INSERT INTO `empmaster`(`USERID`, `EMPID`, `DEPTID`, `ROLEID`, `OPLOGNO`) VALUES ('$username', '$empid', '$this->deptid', '$roleid', '999')")){$flag=1;}
        else{$flag=0;}
      }
        else{$flag=0;}


        if($flag==1){
          return true;
        }
        else{
          return false;
        }

  }

  public function getUsersList(){
    //Gets all users list from the department whom the manager belongs
    $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
      if($userx = $db->get_results("SELECT USERID, EMPID, ROLEID, EMPFNM, DATEOFBIRTH, GENDER, MOBILENO, OPENDT, CLOSEDT FROM EMPMASTER WHERE DEPTID = '$this->deptid' AND ROLEID = 3")){
        return $userx;
      }
      else {
        return false;
      }
  }

  function updateUser(){
      //Updates user information
  }

  function allTasks(){
      //Project wise task listing
  }

  function allProjects(){
      //Lists all projects
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
      if($projx = $db->get_results("SELECT `PRJCTID`, `PRJCTNM`, `PRJCTDESCRI`, `OPENDT`, `CLOSEDT` FROM `prjctmaster`")){
        return $projx;
      }
      else {
        return false;
      }
  }

  public function addProject($pid, $pnm, $pdesc, $opendt, $closedt){
      //Adds new project
      include('project.php');
      $p = new Project();
      if($p->create_project($pid, $pnm, $pdesc, $opendt, $closedt)){
        throw new Exception('From pre class');
      }


  }

  function forgotPass(){
      //Manages forgotten password
  }

  function modifyProject(){
      //Modifications in project details
  }

  function modifyTask(){
      //Global access to do modifications in tasks
  }
}


?>
