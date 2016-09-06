<?php

require_once 'project.php';

define(PROJ_ID_LENGTH, 4);   //Project ID Lengt
define(VER_NO_LENGTH, 2);   //Version No Length
define(ASSET_ID_LENGTH, 3);   //Asset ID Length
define(YEAR_LENGTH, 4);   //Year Length (YY | YYYY)

class Asset extends Project
{


    private $aid = null;
    private $atype = null;
    private $acode = null;
    private $aname = null;

    /**
     *
     *FUNCTIONS:
     * -Create new Asset and assign it to Artist(s)(access to supervisor)
     * -Create new Version (access to Artist only)
     *
     * -Update status of Version (WIP, Sent for Review, DONE, Reviewed, Delivery, Retake, Approved, Unapproved,
     * Recieved | Move Forward)
     *
     * -___Create UID for Version
     *
     * @param null $proj_id
     * @param null $asset_id
     * @throws Exception
     */

    function __construct($proj_id, $asset_id = null)
    {
        /**
         *Asset constructor
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
         * -ASSET ID
         **/

        if ($proj_id == null)
            throw new Exception('No Project Selected!');

        parent::__construct($proj_id);

        if ($asset_id != null) {
            if (isset($_SESSION[$asset_id . '_aid'])) {
                $this->loadFromSession($asset_id);


            } else {
                $this->aid = $asset_id;
                $this->loadFromDB();

            }
        }
    }




    public function bulk_entry($data)
    {
        //INitialize DB pointer
        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        foreach ($data as $d) {

            //Create QUER to insert data into DATABASE
            $QUERY = "INSERT INTO `TMP_ASSET_DETAILS`(`PRJCTID`, `ASSETTYPE`, `ASSETNM`, `ASSETCODE`, `MO`, `SU`, `RI`, `HF`, `LD`, `FO`, `MP`) VALUES ('$this->pid','$d[1]','$d[2]','$d[3]','$d[4]','$d[5]','$d[6]','$d[7]','$d[8]','$d[9]','$d[10]')";
            if ($db->query($QUERY)) {

            } else {
                throw new Exception('Error inserting in Database| QUERY:' . $QUERY);
            }
        }
    }

    public function retrieveAll()
    {

        //Initialize DB pointer
        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        //SQL QUERY
        $QUERY = "SELECT * FROM `TMP_ASSET_DETAILS` WHERE `PRJCTID`='$this->pid'";

        //GET DATA FROM DATABASE
        if ($data = $db->get_results($QUERY)) {
            return json_encode($data);
        } else {
            throw new Exception('Unable to fetch Asset List');
        }
    }

    public function create_asset($id = null, $atype, $acode, $aname)
    {

        //generate asset id
        $this->generate_id($acode);

        //INitialize DB pointer
        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        //Create QUER to insert data into DATABASE
        $QUERY = "INSERT INTO `ASSETMASTER`(`ASSETID`, `ASSETTYPE`, `ASSETCODE`, `ASSETNM`) VALUES('$id', '$atype', '$acode', '$aname')";
        if ($db->query($QUERY)) {

            $this->aid = $id;
            $this->atype = $atype;
            $this->acode = $acode;
            $this->aname = $aname;

            return true;
        } else {
            return false;
        }

    }


    private function loadFromDB()
    {
        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
        if ($assetx = $db->get_row("SELECT ASSETTYPE, ASSETCODE, ASSETNM FROM ASSETMASTER WHERE ASSETID = '$this->aid'")) {


            $this->aname = $assetx->ASSETNM;
            $this->atype = $assetx->ASSETTYPE;
            $this->acode = $assetx->ASSETCODE;

            $_SESSION[$this->aid . '_aid'] = $this->aid;
            $_SESSION[$this->aid . '_atype'] = $this->atype;
            $_SESSION[$this->aid . '_acode'] = $this->acode;
            $_SESSION[$this->aid . '_aname'] = $this->aname;

            $_SESSION[$this->aid . '_update'] = false;


        } else {

            die("Wrong ASSET TOKEN/ID : " . "$this->aid" . "|" . $this->aname . "|");
        }
    }

    private function loadFromSession($pre)
    {

        if (isset($_SESSION[$pre . '_update']) && $_SESSION[$pre . '_update'] == true) {
            $this->loadFromDB();
        } else {
            $this->aid = $_SESSION[$pre . '_aid'];
            $this->aname = $_SESSION[$pre . '_aname'];
            $this->atype = $_SESSION[$pre . '_atype'];
            $this->acode = $_SESSION[$pre . '_acode'];
        }
    }


    /**
     * @param $proj_id
     * @param $empid
     * @param $asset_code
     * @param $ver
     * @param $status
     * @param $notes
     * @return bool|string
     * @throws Exception
     */
    public function add_ver($empid, $ver, $status, $notes)
    {
        //recieved from Artist class FUNCTION:create_ver(same_parameter_list)
        //RETURN TYPE: BOOLEAN


        $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);
        $uid = $this->generate_ver_id($this->pid, $this->acode, $ver);

        $e = new Employee();
        $deptid = $e->getDeptId();

        $now_date = date('Y-m-d');
        $now_time = date('Y-m-d H:i:s');


        /** @var INSERT INTO `ASSETDETAILS` $QUERY */
        $QUERY = "INSERT INTO `ASSETDETAILS`(`UID`, `EMPID`, `PRJCTID`, `DEPTID`, `ASSETID`, `VERSION`, `STATUS`, `NOTES`, `DATE`, `STARTTIME`, `ENDTIME`, `OPLOGNO`, `OPER1`)"
            . "VALUES ('$uid','$empid','$this->pid','$deptid','$this->acode','$ver','$status','$notes','$now_date','$now_time','','','')";

        if ($db->query($QUERY)) {
            return $uid;
        } else {
            throw new Exception('Query Error : <strong>' . $QUERY . '</strong>');
        }

        return false;

    }


    public function update_status($uid, $new_status, $empid)
    {
        //recieved from Artist class FUNCTION:update_status(same_paramater_list)
        //RETURN TYPE: BOOLEAN

        include_once('../sql/shared/ez_sql_core.php');
        include_once('../sql/mysqli/ez_sql_mysqli.php');
        include_once('../functions.php');
        include_once('../db-config.php');
        if ($uid != '') {
            $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

            $QUERY = "UPDATE `ASSETDETAILS` SET  STATUS = '$new_status' WHERE UID = '$uid' AND EMPID = '$empid'";

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


        include_once('../sql/shared/ez_sql_core.php');
        include_once('../sql/mysqli/ez_sql_mysqli.php');
        include_once('../functions.php');
        include_once('../db-config.php');

        if ($uid != '') {
            $db = new ezSQL_mysqli(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

            $QUERY = "SELECT `STATUS` FROM `ASSETDETAILS` WHERE UID = '$uid' AND EMPID = '$empid'";

            if ($v = $db->get_var($QUERY)) {
                return $v;
            } else {
                throw new Exception('Query Error : <strong>' . $QUERY . '</strong>');
            }
        } else {
            return false;
        }

        return false;

    }

    public function assign_asset()
    {

    }

    private function generate_id($acode){
        return $this->pid.$acode;
    }

    private function generate_ver_id($p, $aid, $ver)
    {

        $year = date("Y");


        if (strlen($p) < PROJ_ID_LENGTH) {
            for ($i = 0; $i <= PROJ_ID_LENGTH - strlen($p); $i++) {
                $p = "0" . $p;
            }
        }


        if (strlen($aid) < ASSET_ID_LENGTH) {
            for ($i = 0; $i <= ASSET_ID_LENGTH - strlen($aid); $i++) {
                $aid = "0" . $aid;
            }
        }


        if (strlen($ver) < VER_NO_LENGTH) {
            for ($i = 0; $i <= VER_NO_LENGTH - strlen($ver); $i++) {
                $ver = "0" . $ver;
            }
        }


        $uid = $year . $p . $aid . $ver;

        return $uid;
    }



    private function getyear($id)
    {
        return (int)substr($id, 0, YEAR_LENGTH);
    }

    private function getprojid($id)
    {
        return (int)substr($id, YEAR_LENGTH, PROJ_ID_LENGTH);
    }

    private function getaid($id)
    {
        return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH, ASSET_ID_LENGTH);
    }

    private function getver($id)
    {
        return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH + ASSET_ID_LENGTH, VER_NO_LENGTH);
    }


}


?>
