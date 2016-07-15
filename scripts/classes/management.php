<?php


class Management extends Employee{


    /**
    *
    *JOBS:
    -Create new Supervisor
    -Create new Project
    -get List of all related tasks( such as versions, todo, assigned tasks by management)
    -get List of Projects assigned to him
    -Change status of Project

    *RIGHTS:
    -Limited to Company
    -Limited to particular shots as maintained by the supervisor (afterwards)

    *CLASSES WHICH CAN BE ACCESSED:
    -Project
    -Shot (via Project | No direct access will be granted)
    -Asset (via Project | No direct access will be granted)
    *
    **/


    /**
    *@
    *@return Project Object
    *@var pid, pnm, pdesc, pstart, pend
    */
    public function create_project($pid, $pnm, $pdesc, $pstart, $pend){

      //ASSIGN TASK TO COMPANY (CODE IF ANY)

      //Call Project Constructor
      //$p = new Project($pid, $pnm, $pdesc, $pstart, $pend);
      //return $p;

      $p = new Project();
      $p->create($pid, $pnm, $pdesc, $pstart, $pend);

    }

    private function __createUser(){
      //Should not be implemented
      //Main implementation in parent class ---Employee---
    }



}




 ?>
