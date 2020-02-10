<?php
    interface IDb{
        public function SelectSingle($sql, $options=array());
        public function SelectList($sql, $options=array());
        public function Insert($sql, $options=array());
        public function Update($sql, $options=array());
        public function Delete($sql, $options=array());
    }
?>