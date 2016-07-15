<?php

include_once('../sql/shared/ez_sql_core.php');
include_once('../sql/mysqli/ez_sql_mysqli.php');
include_once('../db-config.php');


/**
 *
 */
define(PROJ_ID_LENGTH, 4);   //Project ID Lengt
define(SEQ_NO_LENGTH, 3);   //Sequence No Length
define(SHOT_NO_LENGTH, 3);   //Shot No Length
define(VER_NO_LENGTH, 2);   //Version No Length
define(YEAR_LENGTH, 4);   //Year Length (YY | YYYY)


class Shot extends Project
{


    /**
     * @var null
     */
    private $sid = null;
    /**
     * @var null
     */
    private $sname = null;
    /**
     * @var null
     */
    private $sdesc = null;
    /**
     * @var null
     */
    private $opendt = null;
    /**
     * @var null
     */
    private $closedt = null;

    /**
     *
     *FUNCTIONS:
     * -Create new Shot and assign it to Artist(s)(access to supervisor)
     * -Create new Version (access to Artist only)
     * -Create new Assets (access to supervisor)
     *
     * -Update status of Version (WIP, Sent for Review, DONE, Reviewed, Delivery, Retake, Approved, Unapproved,
     * Recieved | Move Forward)
     *
     * -___Create UID for Version
     *
     * @param $proj_id
     * @param null $shot_id
     * @throws Exception
     */

    function __construct($proj_id, $shot_id = null)
    {
        /**
         *Shot constructor
         *
         *INITIALIZATIONS:
         * -Version UID(In case of Artist)   |
         * -Version Start Date               |->NOT DECIDED YET
         * -Version End Date                 |
         *
         * -__Project ID
         * -__Project Name
         *
         *PARAMETERS:
         * -Project ID
         * -Shot ID
         **/


        parent::__construct($proj_id);

        if($shot_id != null){
            if (isset($_SESSION[$shot_id . '_sid'])) {
                $this->loadFromSession($shot_id);


            } else {
                $this->sid = $shot_id;
                $this->loadFromDB();

            }
        }
        else{
            //throw new Exception('Shot ID null');
            //_____Call to create new Shot
        }
    }

    /**
     * @param $pre
     * @throws Exception
     */
    private function loadFromSession($pre)
    {

        if (isset($_SESSION[$pre . '_update']) && $_SESSION[$pre . '_update'] == true) {
            $this->loadFromDB();
        } else {
            $this->sid = $_SESSION[$pre . '_sid'];
            $this->sname = $_SESSION[$pre . '_sname'];
            $this->sdesc = $_SESSION[$pre . '_sdesc'];
            $this->opendt = $_SESSION[$pre . '_opendt'];
            $this->closedt = $_SESSION[$pre . '_closedt'];
            //$this->oplogno  = $_SESSION['_oplogno'];
        }
    }

    /**
     * @throws Exception
     */
    private function loadFromDB()
    {
        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
        if ($shotx = $db->get_row("SELECT SHOTNM, SHOTDESC, OPENDT, CLOSEDT, OPLOGNO FROM SHOTMASTER WHERE SHOTID = '$this->sid'")) {


            $this->sname = $shotx->SHOTNM;
            $this->sdesc = $shotx->SHOTDESC;
            $this->opendt = $shotx->OPENDT;
            $this->closedt = $shotx->CLOSEDT;
            //$this->oplogno  =  $shotx->OPLOGNO;

            $_SESSION[$this->sid . '_sid'] = $this->sid;
            $_SESSION[$this->sid . '_sname'] = $this->sname;
            $_SESSION[$this->sid . '_sdesc'] = $this->sdesc;
            $_SESSION[$this->sid . '_opendt'] = $this->opendt;
            $_SESSION[$this->sid . '_closedt'] = $this->closedt;
            //$_SESSION[$this->sid.'_oplogno'] = $this->oplogno;

            //print_r $user;
            $_SESSION[$this->sid . '_update'] = false;

            //unset($user);
        } else {

            throw new Exception("Wrong SHOT TOKEN/ID : " . "$this->sid" . "|" . $this->sname . "|");
        }
    }

    /**
     * @param $proj_id
     * @param $id
     * @param $name
     * @param $desc
     * @param $opendt
     * @param $closedt
     * @throws Exception
     */
    function __construct1($proj_id, $id, $name, $desc, $opendt, $closedt)
    {
        /**
         *Shot constructor
         *
         *-----------Called to create new shot
         *
         *INITIALIZATIONS:
         * -Version UID(In case of Artist)   |
         * -Version Start Date               |->NOT DECIDED YET
         * -Version End Date                 |
         *
         * -__Project ID
         * -__Project Name
         *
         *PARAMETERS:
         * -Project ID
         **/


        parent::__construct($proj_id);

        $this->create_shot($id, $name, $desc, $opendt, $closedt);

    }

    /**
     * @param $id
     * @param $name
     * @param $desc
     * @param $opendt
     * @param $closedt
     * @throws Exception
     */
    private function create_shot($id, $name, $desc, $opendt, $closedt)
    {
        //INitialize DB pointer
        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        //Create QUER to insert data into DATABASE
        $QUERY = "INSERT INTO `SHOTMASTER`(`SHOTID`, `SHOTNM`, `SHOTDESC`, `OPENDT`, `CLOSEDT`) VALUES('$id', '$name', '$desc', '$opendt', '$closedt')";
        if ($db->query($QUERY)) {

            $this->sid = $id;
            $this->sname = $name;
            $this->sdesc = $desc;
            $this->opendt = $opendt;
            $this->closedt = $closedt;
        } else {
            throw new Exception('Query Error : <strong>' . $QUERY . '</strong>');
        }

    }

    /**
     * @param $proj_id
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
    public function add_ver($proj_id, $empid, $shot, $seq, $ver, $character, $sets, $props, $status, $notes)
    {
        //recieved from Artist class FUNCTION:create_ver(same_parameter_list)
        //@return RETURN TYPE: BOOLEAN
        include_once('../sql/shared/ez_sql_core.php');
        include_once('../sql/mysqli/ez_sql_mysqli.php');
        include_once('../db-config.php');


        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        //Shot id can be decimal Convert it to non decimal format
        //For Example - 10.1 -> 1011
        $shot = $this->convertShotId($shot);

        //Generate UID
        $uid = $this->generate_id($proj_id, $seq, $shot, $ver);

        //Generate Department ID from Employee Class
        $e = new Employee();
        $deptid = $e->getDeptId();

        $now_date = date('Y-m-d');
        $now_time = date('Y-m-d H:i:s');

        $QUERY = "INSERT INTO `SHOTPRODEPT`(`UID`, `EMPID`, `PRJCTID`, `DEPTID`, `SEQ`, `SHOT`, `VERSION`, `STATUS`, `NOTES`, `DATE`, `STARTTIME`, `ENDTIME`, `CHRCTCOUNT`, `SETCOUNT`, `PROPSCOUNT`, `OPLOGNO`, `OPER1`)"
            . "VALUES ('$uid','$empid','$proj_id','$deptid','$seq','$shot','$ver','$status','$notes','$now_date','$now_time','','$character','$sets','$props','','')";

        if ($db->query($QUERY)) {
            return $uid;
        } else {
            throw new Exception('Query Error : <strong>' . $QUERY . '</strong>');
        }

        return false;

    }

    /**
     * @param $shot
     * @return mixed
     */
    private function convertShotId($shot)
    {
        //Shot id can be decimal Convert it to non decimal format
        //For Example - 10.1 -> 1011
        return $shot;
    }

    /**
     * @param $p
     * @param $seq
     * @param $shot
     * @param $ver
     * @return string
     */
    private function generate_id($p, $seq, $shot, $ver)
    {

        $year = date("Y");


        if (strlen($p) < PROJ_ID_LENGTH) {
            for ($i = 0; $i <= PROJ_ID_LENGTH - strlen($p); $i++) {
                $p = "0" . $p;
            }
        }

        if (strlen($seq) < SEQ_NO_LENGTH) {
            for ($i = 0; $i <= SEQ_NO_LENGTH - strlen($seq); $i++) {
                $seq = "0" . $seq;
            }
        }


        if (strlen($shot) < SHOT_NO_LENGTH) {
            for ($i = 0; $i <= SHOT_NO_LENGTH - strlen($shot); $i++) {
                $shot = "0" . $shot;
            }
        }


        if (strlen($ver) < VER_NO_LENGTH) {
            for ($i = 0; $i <= VER_NO_LENGTH - strlen($ver); $i++) {
                $ver = "0" . $ver;
            }
        }


        $id = $year . $p . $seq . $shot . $ver;

        return $id;
    }

    /**
     * @param $uid
     * @param $new_status
     * @param $empid
     * @return bool
     * @throws Exception
     */
    public function update_status($uid, $new_status, $empid)
    {
        //recieved from Artsist class FUNCTION:update_status(same_paramater_list)
        //RETURN TYPE: BOOLEAN

        if ($uid != '') {
            $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

            $QUERY = "UPDATE SHOTPRODEPT SET  STATUS = '$new_status' WHERE UID = '$uid' AND EMPID = '$empid'";

            if ($db->query($QUERY)) {
                return true;
            } else {
                throw new Exception('Query Error : <strong>' . $QUERY . '</strong>');
            }
        } else {
            return false;
        }

        return false;
    }

    /**
     * @param $uid
     * @param $empid
     * @return bool|null
     * @throws Exception
     */
    public function get_status($uid, $empid)
    {
        //recieved from Artist class FNUCTION:get_status(UID)
        //RETURN TYPE : BOOLEAN | STATUS


        if ($uid != '') {
            $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

            $QUERY = "SELECT `STATUS` FROM SHOTPRODEPT WHERE UID = '$uid' AND EMPID = '$empid'";

            if ($v = $db->get_var($QUERY)) {
                return $v;
            } else {
                throw new Exception('Query Error : <strong>' . $QUERY . '</strong>');
            }
        } else {
            throw new Exception('UID is Empty');
        }


    }

    /**
     * @param $id
     * @return int
     */
    private function getyear($id)
    {
        return (int)substr($id, 0, YEAR_LENGTH);
    }

    /**
     * @param $id
     * @return int
     */
    private function getprojid($id)
    {
        return (int)substr($id, YEAR_LENGTH, PROJ_ID_LENGTH);
    }

    /**
     * @param $id
     * @return int
     */
    private function getseq($id)
    {
        return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH, SEQ_NO);
    }


    /**
     * @param $id
     * @return int
     */
    private function getshot($id)
    {
        return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH + SEQ_NO_LENGTH, SHOT_NO_LENGTH);
    }

    /**
     * @param $id
     * @return int
     */
    private function getver($id)
    {
        return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH + SEQ_NO_LENGTH + SHOT_NO_LENGTH, VER_NO_LENGTH);
    }


}


?>
