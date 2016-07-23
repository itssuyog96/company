<?php
/**
 * Created by PhpStorm.
 * User: itssu
 * Date: 17-Jul-16
 * Time: 12:50 PM
 */
require_once('../../login/classes/Login.php');
require_once('../../../scripts/sql/shared/ez_sql_core.php');
require_once('../../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../../scripts/db-config.php');
require_once('../../../scripts/classes/employee.php');
require_once('../../../scripts/classes/asset.php');
require_once('../../../scripts/classes/toast.php');


function asset_bulk(){
    if(isset($_POST['submitType']) && $_POST['submitType'] != ''){

        $formSize = $_POST['formSize'];
        switch($_POST['submitType']){
            case 'bulk':
                $y = array();
                for($i = 0; $i < $formSize; $i++){
                    $pid = $_POST['pid'];
                    $x = array();
                    if($i == 0){
                        array_push($x, $_POST['index']);
                        array_push($x, $_POST['asset_type']);
                        array_push($x, $_POST['asset_name']);
                        array_push($x, $_POST['asset_code']);
                        if($_POST['modelling']      == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['modelling']);        }
                        if($_POST['surfacing']      == 'null') {  array_push($x,0);     }else{  array_push($x, $_POST['surfacing']);        }
                        if($_POST['rigging']        == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['rigging']);          }
                        if($_POST['hair_fur']       == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['hair_fur']);         }
                        if($_POST['lookdev']        == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['lookdev']);          }
                        if($_POST['foliage']        == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['foliage']);          }
                        if($_POST['matte_painting'] == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['matte_painting']);   }
                    }
                    else{
                        array_push($x, $_POST['index_'.$i]);
                        array_push($x, $_POST['asset_type_'.$i]);
                        array_push($x, $_POST['asset_name_'.$i]);
                        array_push($x, $_POST['asset_code_'.$i]);
                        if($_POST['modelling_'.$i]      == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['modelling_'.$i]);        }
                        if($_POST['surfacing_'.$i]      == 'null') {  array_push($x,0);     }else{  array_push($x, $_POST['surfacing_'.$i]);        }
                        if($_POST['rigging_'.$i]        == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['rigging_'.$i]);          }
                        if($_POST['hair_fur_'.$i]       == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['hair_fur_'.$i]);         }
                        if($_POST['lookdev_'.$i]        == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['lookdev_'.$i]);          }
                        if($_POST['foliage_'.$i]        == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['foliage_'.$i]);          }
                        if($_POST['matte_painting_'.$i] == 'null') {  array_push($x, 0);    }else{  array_push($x, $_POST['matte_painting_'.$i]);   }

                    }

                    array_push($y, $x);
                    

                }

                try{
                    $a = new Asset($pid);
                    //$uid = $a->create_asset($type, $name, $code);
                    $a->bulk_entry($y);
                    $t = new Toast('Success', 'Bulk Data Feed successfully done', 'success');
                    echo $t->getToast();
                }
                catch(Exception $e){
                    $t = new Toast('Bulk Data Feed failed!', $e->getMessage(), 'error');
                    echo $t->getToast();
                }

            break;
        }
    }
}

//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


if (is_ajax()) {
    asset_bulk();

}
else{
    header('HTTP/1.1 503 Unauthorized/Bad Request');
    //header('Content-Type: application/json; charset=UTF-8');
    echo '<h1>503 UNAUTHORIZED/BAD REQUEST</h1><hr>';
    echo 'You are not authorized to access this content';
}




