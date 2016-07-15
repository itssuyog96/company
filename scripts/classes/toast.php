<?php class Toast{

  public $title = '';
  public $msg = '';
  public $type = '';


  function __construct($title, $msg, $type){

      $this->title = $title;
      $this->msg = $msg;
      $this->type = $type;
  }

  public function getToast(){

    return json_encode(array('error' => array(
     'title' => $this->title,
     'msg' => $this->msg,
     'type'=> $this->type
   )));

  }
}

?>
