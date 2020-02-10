<?php
    /* Lớp lấy dữ liệu cứng dưới các dạng khác nhau */
    abstract class FixData {
        protected $data = null;
        public abstract function getAsList($name);
        public abstract function GetName($key);
    }


    /*Lớp kế thừa FixData sử dụng cho các dữ liệu có 2 truòng như bảng DepartmantType, Unit, UserAvailable,...*/
    class FixData1Code extends FixData{
        /*Hàm lấy danh sách Phòng ban dưới dạng List
        $name: tên của select
        $data: dữ liệu của từng loại bảng, được truyền vào qua constructor của lớp thừa kế
        Khi cần gọi, xem ví dụ:
            $depType = new DepartmentType; 
            echo $depType->getAsList('slDepartmentType');
            $name = $depType->GetName($key);
        */       
        public function getAsList($name){
            $selectList = '<select id="'.$name.'" class="form-control" name="'.$name.'">';
            foreach($this->data as $key => $value){               
                $selectList .= '<option value="'.$key.'">'.$value.'</option>';
            }                 
            $selectList .= '</select>';  
            return $selectList;
        }

        /* Hàm trả về Name khi đưa vào key, dùng để chuyển id thành tên giống như đặt quan hệ */
        public function GetName($key){
            $name = null;
            foreach($this->data as $id => $value){               
                if($key == $id){
                    $name = $value;
                    break;
                }
            }
            return $name;
        }

    }     

    
    /*Lớp kế thừa FixData sử dụng cho các dữ liệu có 3 truòng như bảng DamageLevel, Solution,...*/
    class FixData2Codes extends FixData{

        //Overload hàm getAsList($name) của lớp FixData
        public function getAsList($name){
            $selectList = '<select id="'.$name.'" class="form-control ">';
            foreach($this->data as $key => $value){               
                //$selectList .= '<option value="'.$key.'">'.$value[1].'|'.$value[2].'</option>';
                $selectList .= '<option value="'.$key.'">'.$value[2].'</option>';
            }                 
            $selectList .= '</select>';  
            return $selectList;
        }

        //Overload hàm GetName($key) của lớp FixData
        public function GetName($key){
            $name = null;
            foreach($this->data as $id => $value){               
                if($key = $id){
                    $name = $value[2];
                    break;
                }
            }
            return $name;
        }

    }
    
    class DepartmentType extends FixData1Code {
        public function __construct(){
            $this->data = array(
                '0'=> 'Tất cả',
                '1'=> 'Khối Nội',
                '2'=> 'Khối Ngoại',
                '3'=> 'Khối Cận Lâm sàng',
                '4'=> 'Khối Cơ quan'
            );
        }

    }

    class UserAvailable extends FixData1Code {
        public function __construct(){
            $this->data = array(
                '1'=> 'Làm việc',
                '2'=> 'Phép',
                '3'=> 'Ốm',
                '4'=> 'Nghỉ trực',
                '5'=> 'Công tác',
                '6'=> 'Nghỉ khác'
            );
        }
    }

    class Unit extends FixData1Code{
        public function __construct(){
            $this->data = array(
                '1'=> 'Bộ',
                '2'=> 'Cái',
                '3'=> 'Cơ số',
                '4'=> 'Hộp',
                '5'=> 'Hệ thống'
            );
        }
   }

   class Rank extends FixData1Code{
        public function __construct(){
            $this->data = array(
                '1'=> 'Cấp 1',
                '2'=> 'Cấp 2',
                '3'=> 'Cấp 3',
                '4'=> 'Cấp 4',
                '5'=> 'Cấp 5'
            );
        }
    }

   class OperationStatus extends FixData1Code{
        public function __construct(){
            $this->data = array(
                '1'=> 'Ngừng hoạt động',
                '2'=> 'Hoạt động nhưng hạn chế'
            );
        }
    }

    class ResolvedType extends FixData1Code{
        public function __construct(){
            $this->data = array(
                '1'=> 'Dự toán sửa chữa hàng tháng',
                '2'=> 'Lập hợp đồng sửa chữa'
            );
        }
    }
	
   
    class Solution extends FixData2Codes {
        public function __construct(){
            $this->data = array(
                array('1', 'M', 'Mất'),
                array('2', 'HTM', 'Hỏng thay mới'),
                array('3', 'SC', 'Sửa chữa'),
                array('4', 'BD', 'Bảo dưỡng'),
                array('5', 'TH', 'Thu hồi')
            );                
        } 
    }

    class PartProcurement extends FixData2Codes {
        public function __construct(){
            $this->data = array(
                array('1', 'U1', 'Vật tư có ở Kho của Khoa Trang bị'),
                array('2', 'U2', 'Vật tư không có ở Kho của Khoa Trang bị nhưng sẵn có trên thị trường'),
                array('3', 'U3', 'Vật tư không có ở Kho của Khoa Trang bị và không sẵn có trên thị trường'),
                array('4', 'U4', 'Vật tư chỉ có ở hãng')
            );
        }
    }

    class DamageLevel extends FixData2Codes {
        public function __construct(){
            $this->data = array(
                array('1', 'HH1', 'Kỹ sư Bệnh viện không sửa chữa được, cần can thiệp của hãng'),
                array('2', 'HH2', 'Kỹ sư Bệnh viện sửa được, cần vật tư'),
                array('3', 'HH3', 'Kỹ sư Bệnh viện sửa được, không cần vật tư')
            );
        }
    }
   

   class Priority extends FixData2Codes {
    public function __construct(){
        $this->data = array(
            array('1', 'M1', 'Gây nguy hiểm đến Bệnh nhân'),
            array('2', 'M2', 'Không gây nguy hiểm đến Bệnh nhân nhưng ảnh hưởng đến hoạt động của Khoa'),
            array('3', 'M3', 'Không gây nguy hiểm đến Bệnh nhân và ảnh hưởng đến hoạt động của Khoa')
        );
        }
    }

    class Adress extends FixData1Code {
        private $key;
        public function __construct($key=null){
            $this->key = $key;
            $this->data = array(
               'An Giang' => array(
                    'Huyện An Phú',
                    'Huyện Châu Phú',
                    'Huyện Châu Thành',
                    'Huyện Chợ Mới',
                    'Huyện Phú Tân',
                    'Huyện Thoại Sơn',
                    'Huyện Tịnh Biên',
                    'Huyện Tri Tôn',
                    'Thành phố Châu Đốc',
                    'Thành phố Long Xuyên',
                    'Thị xã Tân Châu'
                ) ,
                'Bà Rịa Vũng Tàu' => array(
                    'Huyện Châu Đức',
                    'Huyện Côn Đảo',
                    'Huyện Đất Đỏ',
                    'Huyện Long Điền',
                    'Huyện Tân Thành',
                    'Huyện Xuyên Mộc',
                    'Thành phố Bà Rịa',
                    'Thành phố Vũng Tàu'
                ) ,
                'Bạc Liêu' => array(
                    'Huyện Đông Hải',
                    'Huyện Hoà Bình',
                    'Huyện Hồng Dân',
                    'Huyện Phước Long',
                    'Huyện Vĩnh Lợi',
                    'Thành phố Bạc Liêu',
                    'Thị xã Giá Rai'
                ) ,
                'Bắc Kạn' => array(
                    'Huyện Ba Bể',
                    'Huyện Bạch Thông',
                    'Huyện Chợ Đồn',
                    'Huyện Chợ Mới',
                    'Huyện Na Rì',
                    'Huyện Ngân Sơn',
                    'Huyện Pác Nặm',
                    'Thành Phố Bắc Kạn',
                ) ,
                'Bắc Giang' => array(
                    'Huyện Hiệp Hòa',
                    'Huyện Lạng Giang',
                    'Huyện Lục Nam',
                    'Huyện Lục Ngạn',
                    'Huyện Sơn Động',
                    'Huyện Tân Yên',
                    'Huyện Việt Yên',
                    'Huyện Yên Dũng',
                    'Huyện Yên Thế',
                    'Thành phố Bắc Giang'
                ) ,
                'Bắc Ninh' => array(
                    'Huyện Gia Bình',
                    'Huyện Lương Tài',
                    'Huyện Quế Võ',
                    'Huyện Thuận Thành',
                    'Huyện Tiên Du',
                    'Huyện Yên Phong',
                    'Thành phố Bắc Ninh',
                    'Thị xã Từ Sơn'
                ) ,
                'Bến Tre' => array(
                    'Huyện Ba Tri',
                    'Huyện Bình Đại',
                    'Huyện Châu Thành',
                    'Huyện Chợ Lách',
                    'Huyện Giồng Trôm',
                    'Huyện Mỏ Cày Bắc',
                    'Huyện Mỏ Cày Nam',
                    'Huyện Thạnh Phú',
                    'Thành phố Bến Tre'
                ) ,
                'Bình Dương' => array(
                    'Huyện Bắc Tân Uyên',
                    'Huyện Bàu Bàng',
                    'Huyện Dầu Tiếng',
                    'Huyện Phú Giáo',
                    'Thành phố Thủ Dầu Một',
                    'Thị xã Bến Cát',
                    'Thị xã Dĩ An',
                    'Thị xã Tân Uyên',
                    'Thị xã Thuận An'
                ) ,
                'Bình Định' => array(
                    'Huyện An Lão',
                    'Huyện Hoài Ân',
                    'Huyện Hoài Nhơn',
                    'Huyện Phù Cát',
                    'Huyện Phù Mỹ',
                    'Huyện Tây Sơn',
                    'Huyện Tuy Phước',
                    'Huyện Vân Canh',
                    'Huyện Vĩnh Thạnh',
                    'Thành phố Qui Nhơn',
                    'Thị xã An Nhơn'
                ) ,
                'Bình Phước' => array(
                    'Huyện Bù Đăng',
                    'Huyện Bù Đốp',
                    'Huyện Bù Gia Mập',
                    'Huyện Chơn Thành',
                    'Huyện Đồng Phú',
                    'Huyện Hớn Quản',
                    'Huyện Lộc Ninh',
                    'Huyện Phú Riềng',
                    'Thị xã Bình Long',
                    'Thị xã Đồng Xoài',
                    'Thị xã Phước Long'
                ) ,
                'Bình Thuận' => array(
                    'Huyện Bắc Bình',
                    'Huyện Đức Linh',
                    'Huyện Hàm Tân',
                    'Huyện Hàm Thuận Bắc',
                    'Huyện Hàm Thuận Nam',
                    'Huyện Phú Quí',
                    'Huyện Tánh Linh',
                    'Huyện Tuy Phong',
                    'Thành phố Phan Thiết',
                    'Thị xã La Gi'
                ) ,
                'Cà Mau' => array(
                    'Huyện Cái Nước',
                    'Huyện Đầm Dơi',
                    'Huyện Năm Căn',
                    'Huyện Ngọc Hiển',
                    'Huyện Phú Tân',
                    'Huyện Thới Bình',
                    'Huyện Trần Văn Thời',
                    'Huyện U Minh',
                    'Thành phố Cà Mau'
                ) ,
                'Cao Bằng' => array(
                    'Huyện Bảo Lạc',
                    'Huyện Bảo Lâm',
                    'Huyện Hạ Lang',
                    'Huyện Hà Quảng',
                    'Huyện Hoà An',
                    'Huyện Nguyên Bình',
                    'Huyện Phục Hoà',
                    'Huyện Quảng Uyên',
                    'Huyện Thạch An',
                    'Huyện Thông Nông',
                    'Huyện Trà Lĩnh',
                    'Huyện Trùng Khánh',
                    'Thành phố Cao Bằng'
                ) ,
                'Cần Thơ' => array(
                    'Huyện Cờ Đỏ',
                    'Huyện Phong Điền',
                    'Huyện Thới Lai',
                    'Huyện Vĩnh Thạnh',
                    'Quận Bình Thuỷ',
                    'Quận Cái Răng',
                    'Quận Ninh Kiều',
                    'Quận Ô Môn',
                    'Quận Thốt Nốt',
                ) ,
                'Đà Nẵng' => array(
                    'Huyện Hòa Vang',
                    'Huyện Hoàng Sa',
                    'Quận Cẩm Lệ',
                    'Quận Hải Châu',
                    'Quận Liên Chiểu',
                    'Quận Ngũ Hành Sơn',
                    'Quận Sơn Trà',
                    'Quận Thanh Khê',
                ) ,
                'Đăk Lăk' => array(
                    'Huyện Buôn Đôn',
                    'Huyện Cư Kuin',
                    'Huyện Cư M gar',
                    'Huyện Ea H leo',
                    'Huyện Ea Kar',
                    'Huyện Ea Súp',
                    'Huyện Krông A Na',
                    'Huyện Krông Bông',
                    'Huyện Krông Búk',
                    'Huyện Krông Năng',
                    'Huyện Krông Pắc',
                    'Huyện Lắk',
                    'Huyện M Đrắk',
                    'Thành phố Buôn Ma Thuột',
                    'Thị Xã Buôn Hồ'
                ) ,
                'Đăk Nông' => array(
                    'Huyện Cư Jút',
                    'Huyện Đăk Glong',
                    'Huyện Đắk Mil',
                    'Huyện Đắk R Lấp',
                    'Huyện Đắk Song',
                    'Huyện Krông Nô',
                    'Huyện Tuy Đức',
                    'Thị xã Gia Nghĩa'
                ) ,
                'Đồng Nai' => array(
                    'Huyện Cẩm Mỹ',
                    'Huyện Định Quán',
                    'Huyện Long Thành',
                    'Huyện Nhơn Trạch',
                    'Huyện Tân Phú',
                    'Huyện Thống Nhất',
                    'Huyện Trảng Bom',
                    'Huyện Vĩnh Cửu',
                    'Huyện Xuân Lộc',
                    'Thành phố Biên Hòa',
                    'Thị xã Long Khánh'
                ) ,
                'Đồng Tháp' => array(
                    'Huyện Cao Lãnh',
                    'Huyện Châu Thành',
                    'Huyện Hồng Ngự',
                    'Huyện Lai Vung',
                    'Huyện Lấp Vò',
                    'Huyện Tam Nông',
                    'Huyện Tân Hồng',
                    'Huyện Thanh Bình',
                    'Huyện Tháp Mười',
                    'Thành phố Cao Lãnh',
                    'Thành phố Sa Đéc',
                    'Thị xã Hồng Ngự'
                ) ,
                'Điện Biên' => array(
                    'Huyện Điện Biên',
                    'Huyện Điện Biên Đông',
                    'Huyện Mường Ảng',
                    'Huyện Mường Chà',
                    'Huyện Mường Nhé',
                    'Huyện Nậm Pồ',
                    'Huyện Tủa Chùa',
                    'Huyện Tuần Giáo',
                    'Thành phố Điện Biên Phủ',
                    'Thị Xã Mường Lay'
                ) ,
                'Gia Lai' => array(
                    'Huyện Chư Păh',
                    'Huyện Chư Prông',
                    'Huyện Chư Pưh',
                    'Huyện Chư Sê',
                    'Huyện Đăk Đoa',
                    'Huyện Đăk Pơ',
                    'Huyện Đức Cơ',
                    'Huyện Ia Grai',
                    'Huyện Ia Pa',
                    'Huyện KBang',
                    'Huyện Kông Chro',
                    'Huyện Krông Pa',
                    'Huyện Mang Yang',
                    'Huyện Phú Thiện',
                    'Thành phố Pleiku',
                    'Thị xã An Khê',
                    'Thị xã Ayun Pa'
                ) ,
                'Hà Giang' => array(
                    'Huyện Bắc Mê',
                    'Huyện Bắc Quang',
                    'Huyện Đồng Văn',
                    'Huyện Hoàng Su Phì',
                    'Huyện Mèo Vạc',
                    'Huyện Quản Bạ',
                    'Huyện Quang Bình',
                    'Huyện Vị Xuyên',
                    'Huyện Xín Mần',
                    'Huyện Yên Minh',
                    'Thành phố Hà Giang'
                ) ,
                'Hà Nam' => array(
                    'Huyện Bình Lục',
                    'Huyện Duy Tiên',
                    'Huyện Kim Bảng',
                    'Huyện Lý Nhân',
                    'Huyện Thanh Liêm',
                    'Thành phố Phủ Lý'
                ) ,
                'Hà Nội' => array(
                    'Huyện Ba Vì',
                    'Huyện Chương Mỹ',
                    'Huyện Đan Phượng',
                    'Huyện Đông Anh',
                    'Huyện Gia Lâm',
                    'Huyện Hoài Đức',
                    'Huyện Mê Linh',
                    'Huyện Mỹ Đức',
                    'Huyện Phú Xuyên',
                    'Huyện Phúc Thọ',
                    'Huyện Quốc Oai',
                    'Huyện Sóc Sơn',
                    'Huyện Thạch Thất',
                    'Huyện Thanh Oai',
                    'Huyện Thanh Trì',
                    'Huyện Thường Tín',
                    'Huyện Ứng Hòa',
                    'Quận Ba Đình',
                    'Quận Bắc Từ Liêm',
                    'Quận Cầu Giấy',
                    'Quận Đống Đa',
                    'Quận Hà Đông',
                    'Quận Hai Bà Trưng',
                    'Quận Hoàn Kiếm',
                    'Quận Hoàng Mai',
                    'Quận Long Biên',
                    'Quận Nam Từ Liêm',
                    'Quận Tây Hồ',
                    'Quận Thanh Xuân',
                    'Thị xã Sơn Tây'
                ) ,
                'Hà Tĩnh' => array(
                    'Huyện Cẩm Xuyên',
                    'Huyện Can Lộc',
                    'Huyện Đức Thọ',
                    'Huyện Hương Khê',
                    'Huyện Hương Sơn',
                    'Huyện Kỳ Anh',
                    'Huyện Lộc Hà',
                    'Huyện Nghi Xuân',
                    'Huyện Thạch Hà',
                    'Huyện Vũ Quang',
                    'Thành phố Hà Tĩnh',
                    'Thị xã Hồng Lĩnh',
                    'Thị xã Kỳ Anh'
                ) ,
                'Hải Dương' => array(
                    'Huyện Bình Giang',
                    'Huyện Cẩm Giàng',
                    'Huyện Gia Lộc',
                    'Huyện Kim Thành',
                    'Huyện Kinh Môn',
                    'Huyện Nam Sách',
                    'Huyện Ninh Giang',
                    'Huyện Thanh Hà',
                    'Huyện Thanh Miện',
                    'Huyện Tứ Kỳ',
                    'Thành phố Hải Dương',
                    'Thị xã Chí Linh'
                ) ,
                'Hải Phòng' => array(
                    'Huyện An Dương',
                    'Huyện An Lão',
                    'Huyện Bạch Long Vĩ',
                    'Huyện Cát Hải',
                    'Huyện Kiến Thuỵ',
                    'Huyện Thuỷ Nguyên',
                    'Huyện Tiên Lãng',
                    'Huyện Vĩnh Bảo',
                    'Quận Đồ Sơn',
                    'Quận Dương Kinh',
                    'Quận Hải An',
                    'Quận Hồng Bàng',
                    'Quận Kiến An',
                    'Quận Lê Chân',
                    'Quận Ngô Quyền'
                ) ,
                'Hòa Bình' => array(
                    'Huyện Cao Phong',
                    'Huyện Đà Bắc',
                    'Huyện Kim Bôi',
                    'Huyện Kỳ Sơn',
                    'Huyện Lạc Sơn',
                    'Huyện Lạc Thủy',
                    'Huyện Lương Sơn',
                    'Huyện Mai Châu',
                    'Huyện Tân Lạc',
                    'Huyện Yên Thủy',
                    'Thành phố Hòa Bình'
                ) ,
                'Hậu Giang' => array(
                    'Huyện Châu Thành',
                    'Huyện Châu Thành A',
                    'Huyện Long Mỹ',
                    'Huyện Phụng Hiệp',
                    'Huyện Vị Thuỷ',
                    'Thành phố Vị Thanh',
                    'Thị xã Long Mỹ',
                    'Thị xã Ngã Bảy'
                ) ,
                'Hưng Yên' => array(
                    'Huyện Ân Thi',
                    'Huyện Khoái Châu',
                    'Huyện Kim Động',
                    'Huyện Mỹ Hào',
                    'Huyện Phù Cừ',
                    'Huyện Tiên Lữ',
                    'Huyện Văn Giang',
                    'Huyện Văn Lâm',
                    'Huyện Yên Mỹ',
                    'Thành phố Hưng Yên'
                ) ,
                'Hồ Chí Minh' => array(
                    'Huyện Bình Chánh',
                    'Huyện Cần Giờ',
                    'Huyện Củ Chi',
                    'Huyện Hóc Môn',
                    'Huyện Nhà Bè',
                    'Quận 1',
                    'Quận 10',
                    'Quận 11',
                    'Quận 12',
                    'Quận 2',
                    'Quận 3',
                    'Quận 4',
                    'Quận 5',
                    'Quận 6',
                    'Quận 7',
                    'Quận 8',
                    'Quận 9',
                    'Quận Bình Tân',
                    'Quận Bình Thạnh',
                    'Quận Gò Vấp',
                    'Quận Phú Nhuận',
                    'Quận Tân Bình',
                    'Quận Tân Phú',
                    'Quận Thủ Đức'
                ) ,
                'Khánh Hòa' => array(
                    'Huyện Cam Lâm',
                    'Huyện Diên Khánh',
                    'Huyện Khánh Sơn',
                    'Huyện Khánh Vĩnh',
                    'Huyện Trường Sa',
                    'Huyện Vạn Ninh',
                    'Thành phố Cam Ranh',
                    'Thành phố Nha Trang',
                    'Thị xã Ninh Hòa'
                ) ,
                'Kiên Giang' => array(
                    'Huyện An Biên',
                    'Huyện An Minh',
                    'Huyện Châu Thành',
                    'Huyện Giang Thành',
                    'Huyện Giồng Riềng',
                    'Huyện Gò Quao',
                    'Huyện Hòn Đất',
                    'Huyện Kiên Hải',
                    'Huyện Kiên Lương',
                    'Huyện Phú Quốc',
                    'Huyện Tân Hiệp',
                    'Huyện U Minh Thượng',
                    'Huyện Vĩnh Thuận',
                    'Thành phố Rạch Giá',
                    'Thị xã Hà Tiên'
                ) ,
                'Kon Tum' => array(
                    'Huyện Đắk Glei',
                    'Huyện Đắk Hà',
                    'Huyện Đắk Tô',
                    'Huyện Ia H Drai',
                    'Huyện Kon Plông',
                    'Huyện Kon Rẫy',
                    'Huyện Ngọc Hồi',
                    'Huyện Sa Thầy',
                    'Huyện Tu Mơ Rông',
                    'Thành phố Kon Tum'
                ) ,
                'Lai Châu' => array(
                    'Huyện Mường Tè',
                    'Huyện Nậm Nhùn',
                    'Huyện Phong Thổ',
                    'Huyện Sìn Hồ',
                    'Huyện Tam Đường',
                    'Huyện Tân Uyên',
                    'Huyện Than Uyên',
                    'Thành phố Lai Châu'
                ) ,
                'Lào Cai' => array(
                    'Huyện Bắc Hà',
                    'Huyện Bảo Thắng',
                    'Huyện Bảo Yên',
                    'Huyện Bát Xát',
                    'Huyện Mường Khương',
                    'Huyện Sa Pa',
                    'Huyện Si Ma Cai',
                    'Huyện Văn Bàn',
                    'Thành phố Lào Cai'
                ) ,
                'Lạng Sơn' => array(
                    'Huyện Bắc Sơn',
                    'Huyện Bình Gia',
                    'Huyện Cao Lộc',
                    'Huyện Chi Lăng',
                    'Huyện Đình Lập',
                    'Huyện Hữu Lũng',
                    'Huyện Lộc Bình',
                    'Huyện Tràng Định',
                    'Huyện Văn Lãng',
                    'Huyện Văn Quan',
                    'Thành phố Lạng Sơn'
                ) ,
                'Lâm Đồng' => array(
                    'Huyện Bảo Lâm',
                    'Huyện Cát Tiên',
                    'Huyện Đạ Huoai',
                    'Huyện Đạ Tẻh',
                    'Huyện Đam Rông',
                    'Huyện Di Linh',
                    'Huyện Đơn Dương',
                    'Huyện Đức Trọng',
                    'Huyện Lạc Dương',
                    'Huyện Lâm Hà',
                    'Thành phố Bảo Lộc',
                    'Thành phố Đà Lạt'
                ) ,
                'Long An' => array(
                    'Huyện Bến Lức',
                    'Huyện Cần Đước',
                    'Huyện Cần Giuộc',
                    'Huyện Châu Thành',
                    'Huyện Đức Hòa',
                    'Huyện Đức Huệ',
                    'Huyện Mộc Hóa',
                    'Huyện Tân Hưng',
                    'Huyện Tân Thạnh',
                    'Huyện Tân Trụ',
                    'Huyện Thạnh Hóa',
                    'Huyện Thủ Thừa',
                    'Huyện Vĩnh Hưng',
                    'Thành phố Tân An',
                    'Thị xã Kiến Tường'
                ) ,
                'Nam Định' => array(
                    'Huyện Giao Thủy',
                    'Huyện Hải Hậu',
                    'Huyện Mỹ Lộc',
                    'Huyện Nam Trực',
                    'Huyện Nghĩa Hưng',
                    'Huyện Trực Ninh',
                    'Huyện Vụ Bản',
                    'Huyện Xuân Trường',
                    'Huyện Ý Yên',
                    'Thành phố Nam Định'
                ) ,
                'Nghệ An' => array(
                    'Huyện Anh Sơn',
                    'Huyện Con Cuông',
                    'Huyện Diễn Châu',
                    'Huyện Đô Lương',
                    'Huyện Hưng Nguyên',
                    'Huyện Kỳ Sơn',
                    'Huyện Nam Đàn',
                    'Huyện Nghi Lộc',
                    'Huyện Nghĩa Đàn',
                    'Huyện Quế Phong',
                    'Huyện Quỳ Châu',
                    'Huyện Quỳ Hợp',
                    'Huyện Quỳnh Lưu',
                    'Huyện Tân Kỳ',
                    'Huyện Thanh Chương',
                    'Huyện Tương Dương',
                    'Huyện Yên Thành',
                    'Thành phố Vinh',
                    'Thị xã Cửa Lò',
                    'Thị xã Hoàng Mai',
                    'Thị xã Thái Hoà'
                ) ,
                'Ninh Bình' => array(
                    'Huyện Gia Viễn',
                    'Huyện Hoa Lư',
                    'Huyện Kim Sơn',
                    'Huyện Nho Quan',
                    'Huyện Yên Khánh',
                    'Huyện Yên Mô',
                    'Thành phố Ninh Bình',
                    'Thành phố Tam Điệp'
                ) ,
                'Ninh Thuận' => array(
                    'Huyện Bác Ái',
                    'Huyện Ninh Hải',
                    'Huyện Ninh Phước',
                    'Huyện Ninh Sơn',
                    'Huyện Thuận Bắc',
                    'Huyện Thuận Nam',
                    'Thành phố Phan Rang-Tháp Chàm'
                ) ,
                'Phú Thọ' => array(
                    'Huyện Cẩm Khê',
                    'Huyện Đoan Hùng',
                    'Huyện Hạ Hoà',
                    'Huyện Lâm Thao',
                    'Huyện Phù Ninh',
                    'Huyện Tam Nông',
                    'Huyện Tân Sơn',
                    'Huyện Thanh Ba',
                    'Huyện Thanh Sơn',
                    'Huyện Thanh Thuỷ',
                    'Huyện Yên Lập',
                    'Thành phố Việt Trì',
                    'Thị xã Phú Thọ'
                ) ,
                'Phú Yên' => array(
                    'Huyện Đông Hòa',
                    'Huyện Đồng Xuân',
                    'Huyện Phú Hoà',
                    'Huyện Sơn Hòa',
                    'Huyện Sông Hinh',
                    'Huyện Tây Hoà',
                    'Huyện Tuy An',
                    'Thành phố Tuy Hoà',
                    'Thị xã Sông Cầu'
                ) ,
                'Quảng Bình' => array(
                    'Huyện Bố Trạch',
                    'Huyện Lệ Thủy',
                    'Huyện Minh Hóa',
                    'Huyện Quảng Ninh',
                    'Huyện Quảng Trạch',
                    'Huyện Tuyên Hóa',
                    'Thành Phố Đồng Hới',
                    'Thị xã Ba Đồn'
                ) ,
                'Quảng Nam' => array(
                    'Huyện Bắc Trà My',
                    'Huyện Đại Lộc',
                    'Huyện Đông Giang',
                    'Huyện Duy Xuyên',
                    'Huyện Hiệp Đức',
                    'Huyện Nam Giang',
                    'Huyện Nam Trà My',
                    'Huyện Nông Sơn',
                    'Huyện Núi Thành',
                    'Huyện Phú Ninh',
                    'Huyện Phước Sơn',
                    'Huyện Quế Sơn',
                    'Huyện Tây Giang',
                    'Huyện Thăng Bình',
                    'Huyện Tiên Phước',
                    'Thành phố Hội An',
                    'Thành phố Tam Kỳ',
                    'Thị xã Điện Bàn'
                ) ,
                'Quảng Ngãi' => array(
                    'Huyện Ba Tơ',
                    'Huyện Bình Sơn',
                    'Huyện Đức Phổ',
                    'Huyện Lý Sơn',
                    'Huyện Minh Long',
                    'Huyện Mộ Đức',
                    'Huyện Nghĩa Hành',
                    'Huyện Sơn Hà',
                    'Huyện Sơn Tây',
                    'Huyện Sơn Tịnh',
                    'Huyện Tây Trà',
                    'Huyện Trà Bồng',
                    'Huyện Tư Nghĩa',
                    'Thành phố Quảng Ngãi'
                ) ,
                'Quảng Ninh' => array(
                    'Huyện Ba Chẽ',
                    'Huyện Bình Liêu',
                    'Huyện Cô Tô',
                    'Huyện Đầm Hà',
                    'Huyện Hải Hà',
                    'Huyện Hoành Bồ',
                    'Huyện Tiên Yên',
                    'Huyện Vân Đồn',
                    'Thành phố Cẩm Phả',
                    'Thành phố Hạ Long',
                    'Thành phố Móng Cái',
                    'Thành phố Uông Bí',
                    'Thị xã Đông Triều',
                    'Thị xã Quảng Yên'
                ) ,
                'Quảng Trị' => array(
                    'Huyện Cam Lộ',
                    'Huyện Cồn Cỏ',
                    'Huyện Đa Krông',
                    'Huyện Gio Linh',
                    'Huyện Hải Lăng',
                    'Huyện Hướng Hóa',
                    'Huyện Triệu Phong',
                    'Huyện Vĩnh Linh',
                    'Thành phố Đông Hà',
                    'Thị xã Quảng Trị'
                ) ,
                'Sóc Trăng' => array(
                    'Huyện Châu Thành',
                    'Huyện Cù Lao Dung',
                    'Huyện Kế Sách',
                    'Huyện Long Phú',
                    'Huyện Mỹ Tú',
                    'Huyện Mỹ Xuyên',
                    'Huyện Thạnh Trị',
                    'Huyện Trần Đề',
                    'Thành phố Sóc Trăng',
                    'Thị xã Ngã Năm',
                    'Thị xã Vĩnh Châu'
                ) ,
                'Sơn La' => array(
                    'Huyện Bắc Yên',
                    'Huyện Mai Sơn',
                    'Huyện Mộc Châu',
                    'Huyện Mường La',
                    'Huyện Phù Yên',
                    'Huyện Quỳnh Nhai',
                    'Huyện Sông Mã',
                    'Huyện Sốp Cộp',
                    'Huyện Thuận Châu',
                    'Huyện Vân Hồ',
                    'Huyện Yên Châu',
                    'Thành phố Sơn La'
                ) ,
                'Tây Ninh' => array(
                    'Huyện Bến Cầu',
                    'Huyện Châu Thành',
                    'Huyện Dương Minh Châu',
                    'Huyện Gò Dầu',
                    'Huyện Hòa Thành',
                    'Huyện Tân Biên',
                    'Huyện Tân Châu',
                    'Huyện Trảng Bàng',
                    'Thành phố Tây Ninh'
                ) ,
                'Thái Bình' => array(
                    'Huyện Đông Hưng',
                    'Huyện Hưng Hà',
                    'Huyện Kiến Xương',
                    'Huyện Quỳnh Phụ',
                    'Huyện Thái Thụy',
                    'Huyện Tiền Hải',
                    'Huyện Vũ Thư',
                    'Thành phố Thái Bình'
                ) ,
                'Thái Nguyên' => array(
                    'Huyện Đại Từ',
                    'Huyện Định Hóa',
                    'Huyện Đồng Hỷ',
                    'Huyện Phú Bình',
                    'Huyện Phú Lương',
                    'Huyện Võ Nhai',
                    'Thành phố Sông Công',
                    'Thành phố Thái Nguyên',
                    'Thị xã Phổ Yên'
                ) ,
                'Thanh Hóa' => array(
                    'Huyện Bá Thước',
                    'Huyện Cẩm Thủy',
                    'Huyện Đông Sơn',
                    'Huyện Hà Trung',
                    'Huyện Hậu Lộc',
                    'Huyện Hoằng Hóa',
                    'Huyện Lang Chánh',
                    'Huyện Mường Lát',
                    'Huyện Nga Sơn',
                    'Huyện Ngọc Lặc',
                    'Huyện Như Thanh',
                    'Huyện Như Xuân',
                    'Huyện Nông Cống',
                    'Huyện Quan Hóa',
                    'Huyện Quan Sơn',
                    'Huyện Quảng Xương',
                    'Huyện Thạch Thành',
                    'Huyện Thiệu Hóa',
                    'Huyện Thọ Xuân',
                    'Huyện Thường Xuân',
                    'Huyện Tĩnh Gia',
                    'Huyện Triệu Sơn',
                    'Huyện Vĩnh Lộc',
                    'Huyện Yên Định',
                    'Thành phố Thanh Hóa',
                    'Thị xã Bỉm Sơn',
                    'Thị xã Sầm Sơn'
                ) ,
                'Thừa Thiên Huế' => array(
                    'Huyện A Lưới',
                    'Huyện Nam Đông',
                    'Huyện Phong Điền',
                    'Huyện Phú Lộc',
                    'Huyện Phú Vang',
                    'Huyện Quảng Điền',
                    'Thành phố Huế',
                    'Thị xã Hương Thủy',
                    'Thị xã Hương Trà'
                ) ,
                'Tiền Giang' => array(
                    'Huyện Cái Bè',
                    'Huyện Cai Lậy',
                    'Huyện Châu Thành',
                    'Huyện Chợ Gạo',
                    'Huyện Gò Công Đông',
                    'Huyện Gò Công Tây',
                    'Huyện Tân Phú Đông',
                    'Huyện Tân Phước',
                    'Thành phố Mỹ Tho',
                    'Thị xã Cai Lậy',
                    'Thị xã Gò Công'
                ) ,
                'Trà Vinh' => array(
                    'Huyện Càng Long',
                    'Huyện Cầu Kè',
                    'Huyện Cầu Ngang',
                    'Huyện Châu Thành',
                    'Huyện Duyên Hải',
                    'Huyện Tiểu Cần',
                    'Huyện Trà Cú',
                    'Thành phố Trà Vinh',
                    'Thị xã Duyên Hải'
                ) ,
                'Tuyên Quang' => array(
                    'Huyện Chiêm Hóa',
                    'Huyện Hàm Yên',
                    'Huyện Lâm Bình',
                    'Huyện Nà Hang',
                    'Huyện Sơn Dương',
                    'Huyện Yên Sơn',
                    'Thành phố Tuyên Quang'
                ) ,
                'Vĩnh Long' => array(
                    'Huyện  Vũng Liêm',
                    'Huyện Bình Tân',
                    'Huyện Long Hồ',
                    'Huyện Mang Thít',
                    'Huyện Tam Bình',
                    'Huyện Trà Ôn',
                    'Thành phố Vĩnh Long',
                    'Thị xã Bình Minh'
                ) ,
                'Vĩnh Phúc' => array(
                    'Huyện Bình Xuyên',
                    'Huyện Lập Thạch',
                    'Huyện Sông Lô',
                    'Huyện Tam Đảo',
                    'Huyện Tam Dương',
                    'Huyện Vĩnh Tường',
                    'Huyện Yên Lạc',
                    'Thành phố Vĩnh Yên',
                    'Thị xã Phúc Yên'
                ) ,
                'Yên Bái' => array(
                    'Huyện Lục Yên',
                    'Huyện Mù Căng Chải',
                    'Huyện Trạm Tấu',
                    'Huyện Trấn Yên',
                    'Huyện Văn Chấn',
                    'Huyện Văn Yên',
                    'Huyện Yên Bình',
                    'Thành phố Yên Bái',
                    'Thị xã Nghĩa Lộ'
                ) 
            );
            if(isset($this->key)){
                $this->data = $this->GetName($this->key);
            }
            return $this->data;
        }
        
        public function getAsList($name){
            $selectList = '<select id="'.$name.'" class="form-control" name="'.$name.'">';
            foreach($this->data as $key => $value){               
                $selectList .= '<option value="'.$value.'">'.$value.'</option>';
            }                 
            $selectList .= '</select>';  
            return $selectList;
        }
        // function getData(){
        //     if(isset($this->key)){
        //         $this->data = $this->GetName($this->key);
        //     }
        //     return $this->data;
        // }
        
                       
    }

?>