<?php

class Criteria
{
    public $page;
    public $perPageNum;
    
    public function __construct()
    {
        $this->page = 1;
        $this->perPageNum = 10;
    }

    public function setPage($page){
        // 페이지가 0보다 작으면 1로
        if($page<0)$page = 1;
        $this->page = $page;
    }

    public function setPerPageNum($perPageNum){
        if($perPageNum == null)$perPageNum=10;
        if($perPageNum < 10 || $perPageNum > 100){
            $perPageNum = 10;
        }
        $this->perPageNum = $perPageNum;
    }

    

    /**
     * Get the value of page
     */ 
    public function getstartPage():int
    {
       return ($this->page - 1) * $this->perPageNum;
    }



    /**
     * Get the value of perPageNum
     */ 
    public function getPerPageNum()
    {
        return $this->perPageNum;
    }
}






?>