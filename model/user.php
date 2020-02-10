<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class UserModel extends Db {
        private $UserName, $Password, $FullName, $Title, $DpId, $Email, $AvailableId, $UserType, $Phone, $Phone1;
        private $start;
        private $limit;

        public function __construct($UserName=null, $Password=null, $FullName=null, $Title=null, $DpId=null, $Email=null, $UserType=null, $Phone=null, $Phone1=null)
        {
            // kết nối DB
            parent::__construct();

            $this->UserName = $UserName;
            $this->Password = $Password;
            $this->FullName = $FullName;
            $this->Title = $Title;
            $this->DpId = empty($DpId) ? $this->getDpId() : $DpId;
            $this->Email = $Email;
            $this->AvailableId = 0;
            $this->UserType = empty($UserType) ? 3 : $UserType;
            $this->Phone = $Phone;
            $this->Phone1 = $Phone1;

            $this->start = $UserName;
            $this->limit = $Password;
        }

        public function GetRowUserInfoByUserName()
        {
            $sql = "SELECT * FROM user WHERE UserName = ?";
            return $this->SelectSingle($sql, [$this->UserName]);
        }

        public function loginVerify(){
            $result = $this->GetRowUserInfoByUserName();
            if($result) {
                if (!password_verify($this->Password, $result['Password']) || $result['AvailableId'] != 1) {
                    $result = false;
                }                
            }  
            return $result;          
        }

        public function signUpVerify(){
            $result = $this->GetRowUserInfoByUserName();
            
            if(!$result) {
                $pw = password_hash($this->Password, PASSWORD_BCRYPT);
                $activeCode = md5($this->Password);
                $resetCode = md5($this->UserName);
                $sql = "INSERT INTO user(UserName,Password,FullName,Title,DepartmentId,Email, AvailableId,UserType,Phone,Phone1,ActiveCode,ResetCode) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            
                $id_insert = $this->Insert($sql, [$this->UserName, $pw, $this->FullName, $this->Title, $this->DpId,$this->Email, $this->AvailableId, $this->UserType, $this->Phone, $this->Phone1,$activeCode,$resetCode]);
                return $id_insert;
            } else {
                return null;
            }
        }

        public function editInfomation(){
            $sql = "UPDATE user SET FullName=?, Title=?, Email=?, Phone=?, Phone1=? WHERE UserName=?";
            $result = $this->Update($sql, [$this->FullName, $this->Title, $this->Email, $this->Phone, $this->Phone1, $this->UserName]);
            return $result;
        }

        private function getDpId(){
            $sql = "SELECT DepartmentId FROM user WHERE UserType=? ORDER BY DepartmentId DESC LIMIT 1";
            $result = $this->SelectSingle($sql, [3]);
            return $result['DepartmentId'] + 1;
        } 

        public function getUserList(){
            $sql = "SELECT * FROM user ORDER BY Id ASC LIMIT ?, ?";
            $result = $this->SelectList($sql, [$this->start , $this->limit]);
            return $result;
        }      

        public function getCountUser(){
            $sql = "SELECT * FROM user";
            $result = $this->countRecord($sql);
            return $result;
        }

        public function GetCodeActive($id)
        {
            $sql = "SELECT ActiveCode FROM user WHERE Id = ?";
            return $this->SelectSingle($sql, [$id]);
        }

        public function SetActiveCode($id)
        {
                $sql = "UPDATE user SET AvailableId = ? , ActiveCode = ? WHERE Id = ?";
                return $this->Update($sql, [1,'',$id]);            
        }

        public function SetLockCode($id)
        {
                $sql = "UPDATE user SET AvailableId = ? , ActiveCode = ? WHERE Id = ?";
                return $this->Update($sql, [0,'',$id]);            
        }
    }

    /**
     *  
     */
    class changePwModel extends Db
    {
        private $PwNew, $RePw;
        function __construct($PwNew, $Id)
        {
            // kết nối DB
            parent::__construct();
            $this->PwNew = $PwNew;
            $this->Id = $Id;
        }
        function updatePw(){
            $pw = password_hash($this->PwNew, PASSWORD_BCRYPT);

            $sql = "UPDATE user SET Password = ? WHERE Id=?";
            return $this->Update($sql, [$pw, $this->Id]);

        }
    }
?>