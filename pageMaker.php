<?php

class PageMaker
{

    public $startPage;
    public $endPage;
    public $totalCount;
    public $disPlayPageNum;

    public $prev;
    public $next;

    public $cri;

    public function __construct(&$cri, $totalCount)
    {
        $this->startPage = 1;
        $this->endPage = 1;
        $this->disPlayPageNum = 10;
        $this->prev = false;
        $this->next = false;
        $this->cri = $cri;
        $this->totalCount = $totalCount;
        $this->calc();
    }

    public function calc()
    {

        $this->endPage = (int) (ceil($this->cri->page / floatval($this->disPlayPageNum)) * $this->disPlayPageNum);
        $this->startPage = ($this->endPage - $this->disPlayPageNum) + 1;
        $tempPage = (int) ceil($this->totalCount / $this->cri->perPageNum);
    
        if($this->endPage > $tempPage){
            $this->endPage = $tempPage;
            $this->endPage = $tempPage == 0? 1:$tempPage;
        }
        $this->prev = $this->startPage == 1? false:true;
        $this->next = ($this->endPage * $this->cri->perPageNum) >= $this->totalCount? false:true;
    }

   
  
   
}
