<?php
require_once 'DB.php';
class user extends DB{
    protected $UserName = '';
    protected $Password = '';
    //DpId : DepartmentId
    protected $Id, $FullName, $Title, $DpId, $Email, $Phone, $Phone1;
    protected $UserType = "3", $AvailableId = "1";
    //--------------------
    // ----- Set Data ----
    //--------------------
    public function setId($Id){
        $this->Id = $Id;
    }
    public function getId(){
        return $this->Id;
    }    
    public function setUsername($UserName){
        $this->UserName = $UserName;
    }
    public function getUsername(){
        return $this->UserName;
    }    
    public function setPassword($Password){
        $this->Password = $Password;
    }
    public function getPassword(){
        return $this->Password;
    }
    public function setFullName($FullName){
        $this->FullName = $FullName;
    }
    public function getFullName(){
        return $this->FullName;
    }
    public function setTitle($Title){
        $this->Title = $Title;
    }
    public function getTitle(){
        return $this->Title;
    }
    public function setDpId($DpId){
        $this->DpId = $DpId;
    }
    public function getDpId(){
        if(isset($this->DpId)) return $this->DpId;
        else {
            $sql = "SELECT DepartmentId FROM user WHERE UserType=3 ORDER BY DepartmentId DESC LIMIT 1";
            $this->setQuery($sql);
            $this->executeSQL();
            $this->DpId = $this->loadRow()['DepartmentId'] + 1;
        }
    }
    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function getEmail(){
        return $this->Email;
    }
    public function setAvailableId($AvailableId){
        $this->AvailableId = $AvailableId;
    }
    public function getAvailableId(){
        return $this->AvailableId;  
    }
    public function setUserType($UserType){
        $this->UserType = $UserType;
    }
    public function getUserType(){
        return $this->UserType;
    }
    public function setPhone($Phone){
        $this->Phone = $Phone;
    }
    public function getPhone(){
        return $this->Phone;
    }
    public function setPhone1($Phone1){
        $this->Phone1 = $Phone1;
    }
    public function getPhone1(){
        return $this->Phone1;
    }
    //------------------------
    // ----- Set Function ----
    //------------------------
    public function login() {
        $sql = "SELECT * FROM user WHERE UserName=? AND Password=?";
        $this->setQuery($sql);
        $this->executeSQL([$this->UserName, $this->Password]);
        if($this->loadRecord() > 0){
            $_SESSION["UserName"] = $this->UserName;
            $_SESSION["Password"] = $this->Password;
            return "user valid";
        }
    }
    
    public function addUser() {
        $sql = "SELECT * FROM user WHERE UserName=?";
        $this->setQuery($sql);
        $this->executeSQL([$this->UserName]);       
        if($this->loadRecord() > 0){
            return "USER EXIST";
        } else {
            $sql = "INSERT INTO user(UserName,Password,FullName,Title,DepartmentId,Email, AvailableId,UserType,Phone,Phone1) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $this->setQuery($sql);
            if($this->executeSQL([$this->UserName, $this->Password, $this->FullName, $this->Title, $this->DpId,$this->Email, $this->AvailableId, $this->UserType, $this->Phone, $this->Phone1])){
            //var_dump($this->getDpId());
            return "USER CREATED";
            }
        }
    }
    
    public function edit_user() {
        $sql = "SELECT * FROM user WHERE UserName=?";
        $this->setQuery($sql);
        $this->executeSQL([$this->UserName]);
        if($this->loadRecord() > 0){
            return "user exist";
        } else {
            $sql = "UPDATE user SET user_name=?,user_pass=? WHERE Id=? AND ID1_?";
            $this->setQuery($sql);
            $this->executeSQL([$this->UserName, $this->Password, $this->Id]);
            return "edit thanh cong";
        }
    }
    
    public function del_user() {
        $sql = "DELETE FROM user WHERE Id=?";
        $this->setQuery($sql);
        $this->executeSQL([$this->Id]);
    }
    
}
