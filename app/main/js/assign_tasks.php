<?php
/**
 * Created by PhpStorm.
 * User: itssu
 * Date: 30-Jul-16
 * Time: 9:37 PM
 */

require_once('../../login/classes/Login.php');
require_once('../../../scripts/sql/shared/ez_sql_core.php');
require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../../scripts/db-config.php');
require_once('../../../scripts/classes/employee.php');
require_once('../../../scripts/classes/asset.php');
require_once('../../../scripts/classes/toast.php');


function assign_tasks(){
    if(isset($_POST['submitType']) && $_POST['submitType'] != ''){

        $qty = $_POST['qty'];
        if($qty > 1){

            $acodes = explode(',', $qty);

            for($i = 0; $i < $qty; $i++){
                
                try{

                    //fetch details from from tmp_asset_details
                    $db = new ezSQL_mysqli(DB_USER, DB_PASS, DB_NAME, DB_HOST);
                    $QUERY = "SELECT * FROM `TMP_ASSET_DETAILS` WHERE `ASSETCODE`='$acodes[$i]'";
                    $res = $db->get_results($QUERY);

                    //input details in assetmaster
                    $a = new Asset($res->PRJCTID);
                    $a->create_asset('', $res->ASSETTYPE, $res->ASSETCODE, $res->ASSETNM);

                    //input details in assign task
                    $a->assign_asset();

                    //change status in tmp_asset_details
                    $QUERY = "UPDATE `TMP_ASSET_DETAILS` SET `STATUS`='1' WHERE `ASSETCODE`='$acodes[$i]'";
                    $db->query($QUERY);
                    
                    $t = new Toast('Success', 'Bulk Data Feed successfully done', 'success');
                }
                catch(Exception $e){
                    $t = new Toast('Bulk Data Feed failed!', $e->getMessage(), 'error');
                    $qty = $i + 1;
                }
                finally{
                    if($qty == $i + 1)
                        echo $t->getToast();
                }

                




            }
        }
        else{

        }





    }
}

var_dump($_POST);

//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


if (is_ajax()) {
    assign_tasks();

}
else{
    header('HTTP/1.1 503 Unauthorized/Bad Request');
    //header('Content-Type: application/json; charset=UTF-8');
    echo '<h1>503 UNAUTHORIZED/BAD REQUEST</h1><hr>';
    echo 'You are not authorized to access this content';
}






