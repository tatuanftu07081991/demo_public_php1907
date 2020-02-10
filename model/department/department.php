<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/oop/db.php';
    define("DEPARTMENT_LIMIT",100);

    class DepartmentModel extends Db{
        private $name = null, $code = null, $type = null, $parent = null, $id = null; 

        public function __construct($name = null, $code = null, $type = null, $parent = null, $id = null)
        {
            parent::__construct();
            $this->name = $name;
            $this->code = $code;
            $this->type = $type;
            $this->parent = $parent;
            $this->id = $id;
        }
//--------------------------------------------------------------------------------------------------------------------
        // Hàm kiểm tra xem đối tượng này đã có trong database hay chưa
        public function checkExist(){          
            $this->prepareCondition();
            $this->sql = "SELECT Id FROM department WHERE ".$this->sql;
            if($this->SelectSingle($this->sql, $this->Options)){
                return true;
            }
            return false;
        }

//--------------------------------------------------------------------------------------------------------------------
        // Hàm insert record
        public function insertDepartment(){
            $sql = "INSERT INTO department(Name,Code,Type,Parent) VALUES (?,?,?,?)";
            $options = array($this->name,$this->code,$this->type,$this->parent);
            if($this->Insert($sql, $options)){
                return true;
            }
            return false;
        }

//--------------------------------------------------------------------------------------------------------------------
        // Hàm trả về danh sách các phòng ban
        // Nếu không có biến $nolimit thì lấy theo limit mwacj định 
        public function getDepartmentList($nolimit = null){
            $this->prepareCondition();
            if(isset($nolimit)){
                $this->sql = "SELECT ID,Name,Code,Type FROM department WHERE ".$this->sql;
            }else{
                $this->sql = "SELECT ID,Name,Code,Type FROM department WHERE ".$this->sql." LIMIT ".DEPARTMENT_LIMIT;
            }
            $result = $this->SelectList($this->sql, $this->Options);
            return $result;
        }

        // public function getDepartmentList($page=null, $limit = null){
        //     $this->prepareCondition();

        //     // if($page == true){
        //     //     $this->sql = "SELECT ID,Name,Code,Type FROM department WHERE ".$this->sql;
        //     //     $result = $this->SelectList($this->sql, $this->Options);
        //     // }
        //     // else {
        //         $page = ($page - 1) * $limit;
        //         $options = array($page,$limit);
                
        //         $this->sql = "SELECT ID,Name,Code,Type FROM department WHERE ".$this->sql." LIMIT ?, ?";
                
        //         $result = $this->SelectList($this->sql, $options);
        //     // }
        //      return $result;
        // }

        // public function getDepartmentCount(){
        //     $this->prepareCondition();
            
        //     $this->sql = "SELECT ID,Name,Code,Type FROM department WHERE ".$this->sql;
            
        //     $result = $this->countRecord($this->sql);
        //     return $result;
        // }

//--------------------------------------------------------------------------------------------------------------------
        // Hàm delete record
        public function deleteDepartment(){
            $this->prepareCondition();
            $this->sql = "DELETE FROM department WHERE ".$this->sql;
            return $this->Delete($this->sql, $this->Options);
        }

//--------------------------------------------------------------------------------------------------------------------
        // Hàm chuẩn bị Option và điều kiện WHERE của câu lệnh sql
        public function prepareCondition(){
            $this->sql ="";
            if(isset($this->id)){                           //Nếu có Id, dùng trong trường hợp Delete hoặc kiểm tra tồn tại
                $this->sql .= "Id = ?" ;
                $this->Options = array($this->id);
            }else{
                if($this->name != "" || $this->code !=""){ //Có tên hoặc code
                    $this->sql .= "(Name LIKE ? OR Code LIKE ?)" ;
                    $this->Options = array("%".$this->name."%","%".$this->code."%");
                    if($this->type != 0){
                        $this->sql .= " AND Type = ?" ;
                        $this->Options[] = (int)$this->type;
                    }
                    if($this->parent != 0){
                        $this->sql .= " AND Parent = ?" ;
                        $this->Options[] = (int)$this->parent;
                    }
                }else{                                      //Không có tên hoặc code
                    if($this->type != 0){                   //Có type
                        $this->sql .= "Type = ?" ;
                        $this->Options = array((int)$this->type);
                        if($this->parent != 0){
                            $this->sql .= " AND Parent = ?" ;
                            $this->Options[] = (int)$this->parent;
                        }
                    }else{                                  //Không có type
                        if($this->parent != 0){
                            $this->sql .= "Parent = ?" ;
                            $this->Options = array((int)$this->parent);
                        }else{
                            $this->sql .= "1";
                            $this->Options =array();
                        }
                    }
                }
            }
    }
//End of Class
}

?>