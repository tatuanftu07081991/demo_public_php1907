<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class PaginationModel extends Db {
        private $tableName, $start, $limit;

        function __construct($tableName, $start, $limit)
        {
            // kết nối DB
            parent::__construct();
            $this->start = $start;
            $this->limit = $limit;
            $this->tableName = $tableName;
        }

        public function getList(){
            $sql = "SELECT * FROM ".$this->tableName." ORDER BY ID ASC LIMIT ?, ?";
            $result = $this->SelectList($sql, [$this->start , $this->limit]);
            return $result;
        }      

        public function getCount(){
            $sql = "SELECT * FROM ".$this->tableName;
            $result = $this->countRecord($sql);
            return $result;
        }
    }