<?php
require "../page.php";
$a = new A();
$t=$a->$b->$page;
//echo $t;
$cri = new Criteria();
echo var_dump($cri);
echo var_dump($_GET["page"]);



class A{

    public $b;

    public function __construct() {
        $this->$b = new B();
    }
 function print(){
     echo "A클래스";
 }

}


class B{
    public $page;

    public function __construct() {
        $this->$page = 1;
    }

    function print(){
        echo "B클래스";
    }

}

?>