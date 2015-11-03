<?php
class Administrador {
private $user, $pass;
    public function __construct($user, $pass){
        $this->user = $user;
        $this->pass = $pass;

    }

    public function existe(){
    global $db;
    $existe = false;
    $sql = "SELECT * FROM administrador WHERE admin='$this->user' AND pass='$this->pass'";
    $result = $db->consultar($sql);
    if($result['found']){
        $existe = true;
    }
    else $existe = false;
    $db->liberarBuffer($result['result']);
    return $existe;
}


}

?>
