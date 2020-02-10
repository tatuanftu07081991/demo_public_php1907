<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/interface/idb.php';

    class Db implements IDb{

        // Các biến thông tin kết nối
        private     $hostname = '',
                    $username = 'root',
                    $password = '',
                    $dbname = 'inote',
                    $charset = 'utf8'; 
        // Biến lưu trữ kết nối
        private $cn = NULL;
        //Biến lưu giá trị trả về
        private $result;
        // Biến lưu thực thi truy vấn
        private $cursor = NULL;
        // Biến lưu số record trả về
        private $count = 0;
        // Biến lưu Id cuối cùng
        private $lastId;
        // Biến lưu ???
        private $options;
        
//--------------------------------------------------------------------------------------------------------------------
        // Hàm khởi tạo đối tượng đồng thời lập kết nối
        public function __construct()
        {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                ];
            
            // Đặt lại hostname tự động trước khi kết nối
            $this->hostname = $_SERVER['HTTP_HOST'];

            // Thực hiện kết nối
            try {
                $this->cn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password,$options);
            }
            catch(PDOException $e)
            {
            echo $e->getMessage();
            }

        }

        // Ngắt kết nối, hủy class
        public function __destruct(){
            $this->cn = null;
        }

//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------
        // Hàm thực hiện truy vấn query
        // vừa lấy câu lệnh $sql vừa lấy danh sách bindValue để gói gọn hơn nội dung của class vì hai việc này luôn đi cùng nhau
        // do đó không cần khai báo $sql là property của class Db nữa mà chỉ là 1 tham số của hàm này
        // Chỉ thực hiện truy vấn, ngoài ra không làm gì khác
        // Private để chỉ được gọi trong class này, thậm chí không thể gọi ở tầng hoặc lớp kế thừa

        private function executeSQL($sql, $options=array()) 
        {   
            if ($this->cn)
            {
                try{
                    $this->cursor = $this->cn->prepare($sql);
                    if(isset($options)){
                        for($i=0; $i<count($options); $i++) {
                            //  bindValue sử dụng với unnamed placedholder
                            $this->cursor->bindValue($i+1,$options[$i]);
                        }
                    }
                $this->cursor->execute();
                }
                catch (Exception $ex) {
                    die($ex ->getMessage());
                }
            }
        }
        
//--------------------------------------------------------------------------------------------------------------------        
        // Trả về kết quả truy vấn dưới dạng list
        // Đã được khai báo trong interface
        // $sql: câu truy vấn dưới dạng unnamed placeholder (có chứa các dấu ?)
        // $options=array(): danh sách các giá trị được bind với placeholder

        public function SelectList($sql, $options=array()){
            $this->executeSQL($sql, $options);
            $this->result = $this->cursor->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }
        
//--------------------------------------------------------------------------------------------------------------------        
        // Trả về kết quả truy vấn dưới dạng single, dùng để kiểm tra xem đã có trong Db hay chưa
        // Đã được khai báo trong interface
        public function SelectSingle($sql, $options=array()){
            $this->executeSQL($sql, $options);
            $this->result = $this->cursor->fetch();
            return $this->result;
        }
//-------------------------------------------------------------------------------------------------------------------- 
        // Hàm đếm số kết quả trả về
    public function countRecord($sql, $options=array()) {
        $this->executeSQL($sql, $options);
        $this->result = $this->cursor->rowCount();
        return $this->result;
    }

 //--------------------------------------------------------------------------------------------------------------------
        // Insert 1 hoặc nhiều record 
        // Đã được khai báo trong interface        
        public function Insert($sql, $options=array()){
            $this->executeSQL($sql, $options);
            return $this->cn->lastInsertId();
        }

//--------------------------------------------------------------------------------------------------------------------
        // Update record 
        // Đã được khai báo trong interface                                   
        public function Update($sql, $options=array()){
            $this->executeSQL($sql, $options);
            //$this->result = $this->cursor->fetch();
            //return $this->result;
        }
        
//--------------------------------------------------------------------------------------------------------------------
        // Delete record 
        // Đã được khai báo trong interface                                   
        public function Delete($sql, $options=array()){
            $this->executeSQL($sql, $options);
        }
        
}
?>