<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class EqModel extends Db {
        private $start, $limit;

        function __construct($start, $limit)
        {
            // kết nối DB
            parent::__construct();
            $this->start = $start;
            $this->limit = $limit;
        }

        public function getEqList(){
            $sql = "SELECT * FROM equipment ORDER BY ID ASC LIMIT ?, ?";
            $result = $this->SelectList($sql, [$this->start , $this->limit]);
            return $result;
        }      

        public function getCountEq(){
            $sql = "SELECT * FROM equipment";
            $result = $this->countRecord($sql);
            return $result;
        }
    }