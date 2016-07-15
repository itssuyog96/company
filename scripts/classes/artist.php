<?php

require_once('employee.php');
//require_once('../../app/login/classes/Login.php');

class Artist extends Employee{

  /**
   *
   *JOBS:
   * #-Create new Version
   * #-Update state of version
   * -get List of all related tasks( such as versions, todo, assigned tasks by supervisor)
   * -get List of Projects assigned to him
   *RIGHTS:
   * -Limited to project (currently)
   * -Limited to particular shots as maintained by the supervisor (afterwards)
   *CLASSES WHICH CAN BE ACCESSED:
   * -Project
   * -Shot (via Project | No direct access will be granted)
   *
   * @param $project
   * @param $shot
   * @param $seq
   * @param $ver
   * @param $character
   * @param $sets
   * @param $props
   * @param $status
   * @param $notes
   * @return bool
   */


  public function create_shot_ver($project, $shot, $seq, $ver, $character, $sets, $props, $status, $notes){

    //additional actions (such as start Artist time couter o nthat version)

    //pass all the parameters to shot class to add the data to database
    $p = new Project($project);
    if($uid = $p->create_ver($this->id, $shot, $seq, $ver, $character, $sets, $props, $status, $notes)){
      return $uid;
    }
    else{
      return false;
    }
  }

  /**
   * @param $project
   * @param $asset_code
   * @param $ver
   * @param $status
   * @param $notes
   * @return bool
     */
  public function create_asset_ver($project, $asset_code, $ver, $status, $notes){

    //additional actions (such as start Artist time couter o nthat version)

    //pass all the parameters to shot class to add the data to database
    $p = new Project($project);
    if($uid = $p->create_ver($this->id, $asset_code, $ver, $status, $notes)){
      return $uid;
    }
    else{
      return false;
    }
  }


  /**
   * @param $uid
   * @param $new_status
   * @return bool
   * @throws Exception
     */
  public function update_status($uid, $new_status){
    $s = new Shot();

    //additional actions (such as verify status flow)
    $cur_status = $this->get_ver_status($uid);    //<---Current status must be less than New Status

    /**

    -CODE TO PERFORM CHECK FOR APPROPRIATE STATUS FLOW


    **/

    //pass all the parameters to class Shot to update status in database
    return $s->update_status($uid, $new_status, $this->id) ? true : false;
  }

  /**
   * @param $uid
   * @return bool
     */
  public function get_ver_status($uid){
    $s = new Shot();

    //pass all parameters to class Shot to recieve status
    if($status = $s->get_ver_status($uid, $this->id)){
      return $status;
    }
    else{
      return false;
    }
  }

  /**
   * @throws Exception
   */
  public function getArtistList() {
    //___NOT TO BE IMPLEMENTED
    throw new Exception('No details found!');
  }
}

?>
