<?php

class Criteria
{
    public $page;
    public $perPageNum;
    public $period;
    public $searchType;
    public $keyword;
    

    public function __construct()
    {
        $this->page = 1;
        $this->perPageNum = 10;
        $this->searchType = "";
        $this->keyword = "";
    }

    public function setPage($page)
    {
        // 페이지가 0보다 작으면 1로
        if ($page < 0) {
            $page = 1;
        }

        $this->page = $page;
    }

    public function setPerPageNum($perPageNum)
    {
        if ($perPageNum == null) {
            $perPageNum = 10;
        }

        if ($perPageNum < 10 || $perPageNum > 100) {
            $perPageNum = 10;
        }
        $this->perPageNum = $perPageNum;
    }

    // 파라미터값이 존재하면 cri에 셋팅 page, keyword, period
    public static function setParam(&$cri)
    {
        if (isset($_REQUEST['page'])) {
            $cri->setPage($_REQUEST['page']);
        }
        if (isset($_REQUEST['keyword'])) {
            $cri->setSearchType($_REQUEST['searchType'])->setKeyword($_REQUEST['keyword']);
        }

        if (isset($_REQUEST['period'])) {
            $cri->setPeriod($_REQUEST['period']);
        }
    }

  


    public static function mkSearchUrl(&$cri){
        return "?page={$cri->page}&period={$cri->period}&searchType={$cri->searchType}&keyword={$cri->keyword}";
    }
    /**
     * Get the value of page
     */
    public function getstartPage(): int
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

    /**
     * Get the value of period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set the value of period
     *
     * @return  self
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get the value of searchType
     */
    public function getSearchType()
    {
        return $this->searchType;
    }

    /**
     * Set the value of searchType
     *
     * @return  self
     */
    public function setSearchType($searchType)
    {
        $this->searchType = $searchType;

        return $this;
    }

    /**
     * Get the value of keyword
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set the value of keyword
     *
     * @return  self
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }
}
