$(document).ready(function() {

    // --------------------------------------------------------------------------------   
    $(document).on('click', '.edit', function() {

    });

    // --------------------------------------------------------------------------------   
    $(document).on('click', '.delete', function() {
        //Lấy id của phòng ban
        var departmentid = $(this).parent().siblings(":first").text();

        $.ajax({
            type: "post", // POST hoac GET
            url: "controller/department/departmentDelete.php",
            data: {
                departId: departmentid
            },
            dataType: "text",
            success: function(response) { // reponse la du lieu tu phia server tra ve
                //$('#divDepartment').html(response);
                //Kiểm tra xem có xóa được hay không
                // Nếu được thì xóa và bỏ khỏi table
                if (response) {
                    $(this).parent().parent().remove();
                }
            }
        });
    });

    // --------------------------------------------------------------------------------
    $(document).on('click', '.addNew', function() {
        $('.addNew').hide();
        $('#dvAddNew').show();
    });

    // --------------------------------------------------------------------------------
    $(document).on('click', '.btnClear', function() {
        $('#dvAddNew').hide();
        $('.addNew').show();
    });

    // --------------------------------------------------------------------------------
    $(document).on('click', '.btnSave', function() {
        var name = $('#txtNewDepartmentName').val().trim();

        //Cần kiểm tra xem chuỗi >5 thì cắt xuống còn 5 vì nếu không có thể tạo ra các Code trùng nhau
        var code = $('#txtNewDepartmentCode').val().trim();
        var type = $('#slDepartmentTypeNew').val().trim();
        var parent = '0';

        if (name != '' && code != '' && type != '0') {
            $.ajax({
                type: "post",
                url: "controller/department/departmentAdd.php",
                data: {
                    departname: name,
                    departcode: code,
                    departtype: type,
                    departparent: parent
                },
                dataType: "html",
                success: function(response) { // reponse la du lieu tu phia server tra ve
                    $('.addNew').html(response);
                    $('.addNew').show();
                }
            });
        } else {
            alert("Chưa nhập đủ thông tin phòng ban cần thêm");
        }
    });

    // --------------------------------------------------------------------------------
    $(document).on('click', '.btnSearch', function() {
        GetDepartmentList();
    });


    // --------------------------------------------------------------------------------
    $(document).on('keyup', '#txtSearch', function() {
        GetDepartmentList();
    });


    // --------------------------------------------------------------------------------
    $(document).on('change', '#slDepartmentType', function() {
        GetDepartmentList();
    });

    // --------------------------------------------------------------------------------
    $(document).on('change', '#slDepartmentParent', function() {
        GetDepartmentList();
    });

    // --------------------------------------------------------------------------------
    function GetDepartmentList() {
        var departmenttype = $('#slDepartmentType').val();
        var keyword = $('#txtSearch').val();
        var parent = $('#slDepartmentParent').val();

        $.ajax({
            type: "post", // POST hoac GET
            url: "controller/department/departmentSearch.php", // File tu phia server, se tiep nhan du lieu tu client gui len
            data: {
                departType: departmenttype,
                kw: keyword,
                prnt: parent
            }, // Du lieu gui len server (file departmentSearch.php se tiep nhan)
            dataType: "html", // Loai du lieu duoc tra ve tu phia server
            success: function(response) { // reponse la du lieu tu phia server tra ve
                $('#divDepartment').html(response);
            }
        });
    }

    /*
    $('#btnSend').click(function(e) {
        e.preventDefault();

    });
    */
    /* 
        var headingCls = $('.heading').attr('class');
        $('#hidHeading').val(headingCls);

        $(document).on('click', '#addChildren', function() {
            var divParent = $(this).parent().html();
            divParent = divParent.replace('Adult', 'Children');
            divParent = divParent.replace('Adult', 'Children');
            divParent = divParent.replace('<a', '<a style="display:none"');

            $(this).parent().append(divParent);
        }); */

    /*     $(document).on('change', '#slColor', function() {
            var color = $(this).val();
            var classes = $('#hidHeading').val();
            //var classes = $('.heading').attr('class');
            $('.heading').attr('class', classes);
            $('.heading').addClass(color);

            // Add css inline
            //$('.heading').css('color', color);

        }); */

    // $('.age').change(function(e) {
    //     e.preventDefault();
    //     var age = $(this).val();
    //     IsAgeInvalid(age);
    // });
    /*  $(document).on('change', '.age', function() {
         var age = $(this).val();
         IsAgeInvalid(age);
     });

     $(document).on('click', '#btnSend', function() {
         var isValid = true;
         var gender = $('.slGender').val();
         var age = $('.age').val();
         if (IsAgeInvalid(age)) {
             isValid = false;
         }

         if (gender == '') {
             $('.slGender').css('border', '1px solid red');
             $('.genderErr').html('Vui lòng chọn.');
             $('.genderErr').show()
             isValid = false;
         } else {
             $('.slGender').css('border', '1px solid #ced4da');
             $('.genderErr').hide()
         }

         if (isValid) {
             $('#frmEmployee').submit();
         }
     }); */

    /*     function IsAgeInvalid(age) {
            if (age === undefined || age == '') {
                $('.age').css('border', '1px solid red');
                $('.ageErr').html('Vui lòng nhập tuổi!');
                $('.ageErr').show();
                return true;
            } else if (age < 18 || age > 80) {
                $('.age').css('border', '1px solid red');
                // Gắn nội dung thông báo lỗi
                $('.ageErr').html('Ngoài tuổi qui định!');
                // Hiển thị thông báo lỗi
                $('.ageErr').show();
                return true;
            } else {
                // Thiết lập border textbox sang màu đen
                $('.age').css('border', '1px solid #ced4da');
                // Ẩn thông báo lỗi
                $('.ageErr').hide();
                return false;
            }
        } */
});