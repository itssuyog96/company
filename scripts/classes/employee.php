<?php

//include_once('../../../scripts/db-config.php');
//include_once('../../../scripts/sql/shared/ez_sql_core.php');
//include_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');


class Employee{

    /**
     * @var null
     */
    protected $id       =   null;
    /**
     * @var null|string
     */
    protected $userid   =   null;
    /**
     * @var null
     */
    protected $deptid   =   null;
    /**
     * @var null
     */
    private $name       =   null;
  //private $company  =   null;
    /**
     * @var null
     */
    private $roleid     =   null;
    /**
     * @var null
     */
    private $rolenm     =   null;
    /**
     * @var null
     */
    private $pin        =   null;
    /**
     * @var null
     */
    private $dob        =   null;
    /**
     * @var null
     */
    private $gender     =   null;
    /**
     * @var null
     */
    private $mob        =   null;
    /**
     * @var null
     */
    private $opendt     =   null;
    /**
     * @var null
     */
    private $closedt    =   null;
    /**
     * @var null
     */
    private $oplogno    =   null;

    /**
     * Employee constructor.
     */
    public function __construct(){

   // session_start();
    $lg = new Login();

    if($lg->isUserLoggedIn() == true){


      if(isset($_SESSION['rolenm'])){
          $this->loadFromSession();


      }
      else{
          $this->userid = $lg->getUsername();
          $this->loadFromDB();

      }


    }
    else{

      die('User not logged in! &amp; <a href="../login/">Login</a>|'.$lg->getUsername().'|');
    }

  }

    /**
     *
     */
    private function loadFromSession(){

    if(isset($_SESSION['update']) && $_SESSION['update'] == true){
      $this->loadFromDB();
    }
    else{
     $this->id       = $_SESSION['id'];
     $this->userid   = $_SESSION['userid'];
     $this->name     = $_SESSION['name'];
     $this->deptid   = $_SESSION['deptid'];
     $this->roleid   = $_SESSION['roleid'];
     $this->pin      = $_SESSION['pin'];
     $this->dob      = $_SESSION['dob'];
     $this->gender   = $_SESSION['gender'];
     $this->mob      = $_SESSION['mob'];
     $this->opendt   = $_SESSION['opendt'];
     $this->closedt  = $_SESSION['closedt'];
     $this->oplogno  = $_SESSION['oplogno'];
     $this->rolenm   = $_SESSION['rolenm'];
    }
  }

    /**
     *
     */
    private function loadFromDB(){
    $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
    if($userx = $db->get_row("SELECT EMPID, DEPTID, ROLEID, EMPFNM, PIN, DATEOFBIRTH, GENDER, MOBILENO, OPENDT, CLOSEDT, OPLOGNO FROM EMPMASTER WHERE USERID = '$this->userid'")){

       $this->id       = $userx->EMPID;
       $this->name     = $userx->EMPFNM;
       $this->deptid   = $userx->DEPTID;
       $this->roleid   = $userx->ROLEID;
       $this->pin      = $userx->PIN;
       $this->dob      = $userx->DATEOFBIRTH;
       $this->gender   = $userx->GENDER;
       $this->mob      = $userx->MOBILENO;
       $this->opendt   = $userx->OPENDT;
       $this->closedt  = $userx->CLOSEDT;
       $this->oplogno  = $userx->OPLOGNO;

       $_SESSION['id']      = $this->id;
       $_SESSION['userid']  = $this->userid;
       $_SESSION['name']    = $this->name;
       $_SESSION['roleid']  = $this->roleid;
       $_SESSION['deptid']  = $this->deptid;
       $_SESSION['pin']     = $this->pin;
       $_SESSION['dob']     = $this->dob;
       $_SESSION['gender']  = $this->gender;
       $_SESSION['mob']     = $this->mob;
       $_SESSION['opendt']  = $this->opendt;
       $_SESSION['closedt'] = $this->closedt;
       $_SESSION['oplogno'] = $this->oplogno;

      $this->getrole($this->roleid);
      //print_r $user;
      $_SESSION['update'] = false;

      //unset($user);
    }
    else{

        die("Wrong employee OR login TOKEN/ID : "."$this->userid"."|".$this->id."|");
    }
  }

    /**
     * @param $roleidx
     */
    public function getrole($roleidx)
  {
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
      if($rolex = $db->get_row("SELECT ROLENM, ROLEDESCRI FROM EMPROLES WHERE ROLEID = '$roleidx'")){
        $this->rolenm = $rolex->ROLENM;
        $_SESSION['rolenm']  = $this->rolenm;
      }
  }

    /**
     * @param $q
     * @return null|string
     */
    public function get_emp($q){

    if($q == 'name')        return  $this->name;
    if($q == 'id')          return  $this->id;
    if($q == 'userid')      return  $this->userid;
    if($q == 'roleid')      return  $this->roleid;
    if($q == 'pin')         return  $this->pin;
    if($q == 'dob')         return  $this->dob;
    if($q == 'gender')      return  $this->gender;
    if($q == 'mob')         return  $this->mob;
    if($q == 'opendt')      return  $this->opendt;
    if($q == 'closedt')     return  $this->closedt;
    if($q == 'oplogno')     return  $this->oplogno;
    if($q == 'pin')         return  $this->pin;
    if($q == 'rolenm')      return  $this->rolenm;
    if($q == 'deptid')      return  $this->deptid;


  }

    /**
     * @param $deptid
     * @param $empid
     * @param $roleid
     * @param $username
     * @param $pass
     * @throws Exception
     */
    public function addNewUser($deptid, $empid, $roleid, $username, $pass){
      //Adds new user and returns login id & password

      // check for minimum PHP version
      if (version_compare(PHP_VERSION, '5.3.7', '<')) {
          throw new Exception('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
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
      if(!$reg->registerNewUser($username, $pass, $pass)){
        throw new Exception('Error occured in Registration class . <br>FUNCTION: registerNewUser(__parameters__)');
      }

      $QUERY = "INSERT INTO `empmaster`(`USERID`, `EMPID`, `DEPTID`, `ROLEID`, `OPLOGNO`) VALUES ('$username', '$empid', '$deptid', '$roleid', '999')";

      if($db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST)){
        if(!$db->query($QUERY)){
          throw new Exception('Query Error:'.$QUERY);
        }
      }
      else{
        throw new Exception('Error occured while initializing DB pointer');
      }

  }

    /**
     * @param $fname
     * @param $lname
     * @param $dob
     * @param $gender
     * @param $mob
     * @return bool
     */
    public function post_reg($fname, $lname, $dob, $gender, $mob){
    $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

    $fullname = $fname.' '.$lname;
    $date = DateTime::createFromFormat('m/j/Y', $dob);

    $dobx = $date->format('Y-m-d');

    if($db->query("UPDATE `empmaster` SET `EMPFNM`='$fullname',`DATEOFBIRTH`='$dobx',`GENDER`= '$gender',`MOBILENO`='$mob', `OPLOGNO`= 'NULL' WHERE USERID = '$this->userid'")){
      $_SESSION['update'] = true;
      session_destroy();
      return true;
    }
    else{
      return false;
    }
  }

    /**
     * @param $q
     * @throws Exception
     */
    public function update_details($q){

      throw new Exception('Module creation in Progress<br>Parameters passed:'.$q);

  }

    /**
     * @return null
     */
    public function getDeptId(){
        return $this->deptid;
    }
}


?>
