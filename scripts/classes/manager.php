<?php


class Manager extends Employee{


    /**
    *
    *JOBS:
    -Create new Artist
    -Create new shots
    -Create new assets
    -get List of all related tasks( such as versions, todo, assigned tasks by management)
    -get List of Projects assigned to him
    -Change status of Project

    *RIGHTS:
    -Limited to department (currently)
    -Limited to particular shots as maintained by the supervisor (afterwards)

    *CLASSES WHICH CAN BE ACCESSED:
    -Project
    -Shot (via Project | No direct access will be granted)
    -Asset (via Project | No direct access will be granted)
    *
    **/

    public function create_seq($proj_id, $from, $to){

      //Validate Project ID to which SEQ is ADDED
      $p = new Project($proj_id);
      if($p->getOPLOGNO() != 42){
        throw new Exception('Project ID:'.$proj_id.' is not ACTIVE!');
      }

      //Validate SEQNO to be added
      $QUERY = "SELECT MAX(`SEQNO`) FROM `PROJSEQ` WHERE `PID` = '$proj_id'";
      $maxseqno = $db->get_var($QUERY);
      if($maxseqno >= $from){
        throw new Exception('Please verify SEQNO range. Range : '.$from.' to '.$to);
      }

      //Add SEQNO to DB
      //INitialize DB pointer
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

      for($i = $from; $i <= $to; $i++){
        //Create QUER to insert data into DATABASE
        $QUERY = "INSERT INTO `PROJSEQ`(`PID`, `SEQNO`, `STATUS`, `OPCODE`) VALUES ($p->getProjectID(), $i, '42', '')";
        if($db->query($QUERY)){
          return;
        }
        else{
          throw new Exception('Query Error : <strong>'.$QUERY.'</strong>');
        }
      }
    }

    public function create_shot($proj_id, $id, $name, $des, $opendt, $closedt){
      //ASSIGN TASK TO COMPANY (CODE IF ANY)

      //Call Project Constructor
      $s = new Shot($proj_id, $id, $name, $des, $opendt, $closedt);
      $s = null;

    }

    public function create_asset($proj_id, $id, $name, $des, $opendt, $closedt){

      //ASSIGN TASK TO COMPANY (CODE IF ANY)

      //Call Project Constructor
      $s = new Asset($proj_id, $id, $name, $des, $opendt, $closedt);
      $s = null;

    }
}




 ?>
