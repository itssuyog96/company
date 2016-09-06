<?php

//include_once('../../../scripts/db-config.php');
//include_once('../../../scripts/sql/shared/ez_sql_core.php');
//include_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');

class Artist{

  //private tasklist = array();
  //private artistlist = array();

  function addNewTask($project, $shot, $seq, $ver, $status, $notes){
      //Adds new task(version) by calling appropriate function in class Shot
      $e = new Employee();
      if($uid = $shotObj->create_ver($e->get_emp('id'), $e->get_emp('deptid'), $project, $shot, $seq, $ver, $status, $notes)){
        //returns version UID on success
        return $uid;
      }
      else{
        //or else returns false
        return false;
      }
  }

  function modifyTask(){
      //Directly invokes information from database for the given task and retireve its information and then update it if necessary
  }

  function updateTaskStatus(){
      //updates status for a given task id
  }

  function shareTask(){
      //Share a task with other artist(s)
  }

  function getArtistList($empid){
      //gets list of all artists who are working on that task
     $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
    if($version = $db->get_results("SELECT * FROM `SHOTPRODEPT` WHERE EMPID = '$empid'"))
    {
      return $version;
    }
    else{
      $db->debug();
      return false;
    }
  }

  function getProjectList($empid){
    //gets projects related to that particular artist
    include_once('../../../scripts/functions.php');

    $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);
    if($proj = $db->get_results("SELECT UID FROM `SHOTPRODEPT` WHERE EMPID = '$empid'"))
    {
      $res = array();
      foreach($proj as $p){
        array_push($res, getprojid($p->UID));
      }

      return $res;
    }
    else{
      $db->debug();
      return false;
    }

  }

  function UpdateAll(){
      //Syncs all information with database
      //Shall be called periodically - After every 5 seconds
  }

}


?>
