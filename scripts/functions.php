
<?php


define(PROJ_ID_LENGTH , 4);   //Project ID Lengt
define(SEQ_NO_LENGTH  , 3);   //Sequence No Length
define(SHOT_NO_LENGTH , 3);   //Shot No Length
define(VER_NO_LENGTH  , 2);   //Version No Length
define(ASSET_ID_LENGTH, 3);   //Asset ID Length
define(YEAR_LENGTH    , 4);   //Year Length (YY | YYYY)

function generate_shot_id($p, $seq, $shot, $ver){

  $year = date("Y");


  if (strlen($p) < PROJ_ID_LENGTH) {
    for($i = 0; $i <= PROJ_ID_LENGTH - strlen($p); $i++){
      $p = "0".$p;
    }
  }

  if (strlen($seq) < SEQ_NO_LENGTH) {
    for($i = 0; $i <= SEQ_NO_LENGTH - strlen($seq); $i++){
      $seq = "0".$seq;
    }
  }


  if (strlen($shot) < SHOT_NO_LENGTH) {
    for($i = 0; $i <= SHOT_NO_LENGTH - strlen($shot); $i++){
      $shot = "0".$shot;
    }
  }


  if (strlen($ver) < VER_NO_LENGTH) {
    for($i = 0; $i <= VER_NO_LENGTH - strlen($ver); $i++){
      $ver = "0".$ver;
    }
  }


  $id = $year.$p.$seq.$shot.$ver;

  return $id;
}


function getyear($id){
  return (int)substr($id, 0, YEAR_LENGTH);
}

function getprojid($id){
  return (int)substr($id, YEAR_LENGTH, PROJ_ID_LENGTH);
}

function getseq($id){
  return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH, SEQ_NO);
}


function getshot($id){
  return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH + SEQ_NO_LENGTH, SHOT_NO_LENGTH);
}

function getver($id){
  return (int)substr($id, YEAR_LENGTH + PROJ_ID_LENGTH + SEQ_NO_LENGTH + SHOT_NO_LENGTH, VER_NO_LENGTH);
}






?>
