<?php

class Project{

  protected $pid      = null;
  protected $name     = null;
  protected $desc     = null;
  protected $opendt   = null;
  protected $closedt  = null;
  public    $oplogno  = null;


    /**
     *
     *FUNCTIONS
     * #-Create new Project (access to only Management)
     * #-(low priority) Edit Project details (such as name, description)
     * -___Create new Shot and assign it to Artist(s)(access to supervisor)
     * -___Create new Version (access to Artist only)
     * -___Create new Assets (access to supervisor)
     *
     * -Change Status of Project (WIP, DONE)
     * -___Update status of Version (WIP, Sent for Review, DONE, Reviewed, Delivery, Retake, Approved, Unapproved, Recieved | Move Forward)
     *
     * -___List all shot information  ________(with there status)
     * -___List all assets information
     * -Get Project details
     * @param $pid
     * @param null $pnm
     * @param null $pdesc
     * @param null $pstart
     * @param null $pend
     * @throws Exception
     */


  function __construct($pid, $pnm = null, $pdesc = null, $pstart = null, $pend = null){
    /**
    *Project constructor
    *
    *INITIALIZATIONS
    -Project ID
    -Project Name
    *
    **/

      if($pid == null){
          //Class is instantiated improperly_______________Actually Do nothing
          //Or throw an Exception
          throw new Exception('Project class instantiated with null Project ID');
      }
      else if($pnm = null && $pdesc && $pstart = null && $pend = null){
          $this->retrieveProject($pid);
          //Retrieve other Project information from DATABASE
      }
      else{
          $this->create($pid, $pnm, $pdesc, $pstart, $pend);
      }

  }

    /**
     *Create new project
     *
     *PARAMETERS:
     * -Project ID             - pid
     * -Project Name           - pnm
     * -Project Description    - pdesc   --optional
     * -Project Start DateTime - pstart
     * -Project End DateTime   - pend    (EXPECTED)
     *
     * @param $pid
     * @param $pnm
     * @param $pdesc
     * @param $pstart
     * @param $pend
     * @return bool
     * @throws Exception
     */


  public function create($pid, $pnm, $pdesc, $pstart, $pend){

      //Convert Project DateTimes to yyyy-mm-dd format
      $date = DateTime::createFromFormat('m/j/Y', $pstart);
      $pstartx = $date->format('Y-m-d');

      $date = DateTime::createFromFormat('m/j/Y', $pend);
      $pendx   = $date->format('Y-m-d');

      //Initialize DB pointer
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

      //SQL QUERY
      $QUERY = "INSERT INTO `PRJCTMASTER`(`PRJCTID`, `PRJCTNM`, `PRJCTDESCRI`, `OPENDT`, `CLOSEDT`, `OPLOGNO`) VALUES('$pid', '$pnm', '$pdesc', '$pstartx', '$pendx', '42')";

      //FEED DATA TO DATABASE
      if($db->query($QUERY)){
        $this->pid = $pid;
        return true;
      }
      else{
        throw new Exception('Unable to create new Project with <strong>Project ID:'.$pid.'</strong>');
      }

  }


    /**
     * @param $pid
     * @throws Exception
     */
    private function retrieveProject($pid){
        //Initialize DB pointer
        $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

        //SQL QUERY
        $QUERY = "SELECT * FROM `PRJCTMASTER` WHERE `PRJCTID` = '$pid'";

        //FEED DATA TO DATABASE
        if($row = $db->get_row($QUERY)){
            $this->pid      = $pid;
            $this->name     = $row->PRJCTNM;
            $this->desc     = $row->PRJCTDESCRI;
            $this->opendt   = $row->OPENDT;
            $this->closedt  = $row->CLOSEDT;
            $this->oplogno  = $row->OPLOGNO;
            return;
        }
        else{
            throw new Exception('Unable to retrieve Project Information with <strong>Project ID:'.$pid.'</strong>');
        }
    }

    /**
     * @param $pnm
     * @return bool
     * @throws Exception
     */
    public function update_name($pnm){

      //Initialize DB pointer
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

      //SQL QUERY
      $QUERY = "'$pnm'";

      //FEED DATA TO DATABASE
      if($db->query($QUERY)){
        return true;
      }
      else{
        throw new Exception('Unable to update Project Name for <strong>Project ID:'.$this->pid.'</strong>');
      }

  }

    /**
     * @param $pdesc
     * @return bool
     * @throws Exception
     */
    public function update_desc($pdesc){

      //Initialize DB pointer
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

      //SQL QUERY
      $QUERY = "'$pdesc'";

      //FEED DATA TO DATABASE
      if($db->query($QUERY)){
        return true;
      }
      else{
        throw new Exception('Unable to update Project Description for <strong>Project ID:'.$this->pid.'</strong>');
      }

  }

    /**
     * @param $pend
     * @return bool
     * @throws Exception
     */
    public function update_end_datetime($pend){

      //Convert Project DateTimes to yyyy-mm-dd format


      //Initialize DB pointer
      $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

      //SQL QUERY
      $QUERY = "'$pend'";

      //FEED DATA TO DATABASE
      if($db->query($QUERY)){
        return true;
      }
      else{
        throw new Exception('Unable to update Project End Date/Time for <strong>Project ID:'.$this->pid.'</strong>');
      }

  }

    /**
     * @param $empid
     * @param $shot
     * @param $seq
     * @param $ver
     * @param $character
     * @param $sets
     * @param $props
     * @param $status
     * @param $notes
     * @return bool|string
     * @throws Exception
     */
    public function create_shot_ver($empid, $shot, $seq, $ver, $character, $sets, $props, $status, $notes){

    //pass all the parameters to shot class to add the data to database
    $s = new Shot();
    if($this->id != null){
      if($uid = $s->add_ver($this->pid, $empid, $shot, $seq, $ver, $character, $sets, $props, $status, $notes)){
        return $uid;
      }
      else{
        throw new Exception('Unable to create shot version for <strong>Project ID:'.$this->pid.'</strong>');
      }
    }
    else{
      throw new Exception('Project ID not initialized or does not Exist');
    }
  }


    /**
     * @param $empid
     * @param $aid
     * @param $ver
     * @param $status
     * @param $notes
     * @return mixed
     * @throws Exception
     */
    public function create_asset_ver($empid, $aid, $ver, $status, $notes){

    //pass all the parameters to shot class to add the data to database
    $a = new Asset($this->pid);
    if($this->id != null){
      if($uid = $a->add_ver($this->pid, $empid, $aid, $ver, $status, $notes)){
        return $uid;
      }
      else{
        throw new Exception('Unable to create asset version for <strong>Project ID:'.$this->pid.'</strong>');
      }
    }
    else{
      throw new Exception('Project ID not initialized or does not Exist');
    }

  }

    /**
     * @return null
     */
    public function getPID(){
    return $this->pid;
  }

    /**
     * @return null
     */
    public function getOPLOGNO(){
    return $this->oplogno;
  }


    /**
     * @param $ptype
     * @return bool
     * @throws Exception
     */
    public function addProjectType($ptype){
        //Initialize DB pointer
        $db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

        //SQL QUERY
        $QUERY = "INSERT INTO `PTYPEMASTER`(`PTYPEID`, `PTYPENM`) VALUES ('','$ptype')";

        //FEED DATA TO DATABASE
        if($db->query($QUERY)){
            return true;
        }
        else{
            throw new Exception('Unable to add new Project Type:<strong>'.$ptype.'</strong><br>Database Error');
        }
    }

}


?>
