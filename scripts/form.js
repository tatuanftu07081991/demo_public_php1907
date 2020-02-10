$_DOMAIN = 'http://localhost/175em/';

// Active tab của menu
$('nav .nav-item').on('click', function() {
    $('nav .nav-item').removeClass('active');
    $(this).addClass('active');
});

//Autocomplete 
$( function() {
    var projects = [
      {
        value: "jquery",
        label: "jQuery",
        desc: "the write less, do more, JavaScript library",
        icon: "jquery_32x32.png"
      },
      {
        value: "jquery-ui",
        label: "jQuery UI",
        desc: "the official user interface library for jQuery",
        icon: "jqueryui_32x32.png"
      },
      {
        value: "sizzlejs",
        label: "Sizzle JS",
        desc: "a pure-JavaScript CSS selector engine",
        icon: "sizzlejs_32x32.png"
      }
    ];
 
    $( "#DpName" ).autocomplete({
      minLength: 0,
      //source: projects,
      source: "search.php",
      focus: function( event, ui ) {
        $( "#DpName" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#DpName" ).val( ui.item.label );
        //$( "#project-id" ).val( ui.item.value );
        $( "#DpId" ).val( ui.item.desc );
        //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
 
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "<br>" + item.desc + "</div>" )
        .appendTo( ul );
    };
  } );

// Multi Click
$('#list_acc  input[type="checkbox"]:eq(0)').on('click', function(){
    $('#list_acc  input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});


$('#formAdd select[id="provinceName"]').on('change', function() {
    $province = $(this).val();
    if($province != '') {
    	$.ajax({
            url : $_DOMAIN + 'importDistrict.php',
            type : 'POST',
            data : {
                province : $province
            }, success : function(data) {
                $('#formAdd div[id="districtName"]').html(data);
            }
        });
    }
});

$('.lock-acc-list').on('click', function() {
    $id_acc = $(this).attr('data-id');
 
    $.ajax({
        url : $_DOMAIN + 'accounts.php',
        type : 'POST',
        data : {
            id_acc : $id_acc,
            action : 'lock_acc'
        },
        success : function() {
            location.reload();
        }
    });
});

$('.unlock-acc-list').on('click', function() {
    $id_acc = $(this).attr('data-id');
 
    $.ajax({
        url : $_DOMAIN + 'accounts.php',
        type : 'POST',
        data : {
            id_acc : $id_acc,
            action : 'active_acc'
        },
        success : function() {
            location.reload();
        }
    });
});

// Xem ảnh trước
$('#img_up').on('change', function(){
    img_up = $('#img_up').val();
    // đếm số ảnh
    count_img_up = $('#img_up').get(0).files.length;
 
    // Nếu đã chọn ảnh
    if (img_up != '')
    {
        $('.box-pre-img').html('<p><strong>Ảnh xem trước</strong></p>');
        $('.box-pre-img').removeClass('d-none');
        for (i = 0; i <= count_img_up - 1; i++)
        {
            $('.box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[i]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom: 5px;"/>');
        }
    } 
    // Ngược lại chưa chọn ảnh
    else
    {
        $('.box-pre-img').html('');
        $('.box-pre-img').addClass('d-none');
    }
});

// AUTOCOMPLETE
    $("#MachineName").autocomplete({
        source: "controller/search.php"
    });    

    $("#MachineName").on('change', function(){
        $name = $(this).val();
        if($name != '') {
            if($name == "Sửa chữa nhỏ lẻ") {
                $('#Detail_input').removeClass('d-none');
            } else {
                $('#Detail_input').addClass('d-none');
                $.ajax({
                    url : $_DOMAIN + 'controller/search.php',
                    type : 'GET',
                    data : {
                        name : $name,
                        action : 'auto_input'
                    },
                    success : function(data) {
                        data = JSON.parse(data);
                        var html = '<label for="Model">Ký hiệu:</label>';
                            html += '<select id="Model" class="form-control" name="Model">';
                                html += '<option value="">Xin mời chọn</option>';
                                for (var i = 0; i < data.length; i++) {
                                    html +=  '<option id="'+i+'" value="' + data[i].Model + '">' + data[i].Model + '</option>';
                                }                         
                            html +=  '</select>';                         
                        $('#Model_input').html(html);

                        $("#Model_input").on('change', function(){
                            $id = $("#Model option:selected").attr("id");                        
                            $('#SN_input input#SN').val(data[$id].SN);  
                            $('#Country_input input#Country').val(data[$id].Country);  
                            $('#Department').val(data[$id].Department);
                            $('#MachineCode').val(data[$id].Id);
                            $('#Category').val(data[$id].Category);
                        });
                    }
                });
            }
        }        
    });
   

// Upload hình ảnh
$('#formAdd').submit(function(e) {
    img_up = $('#img_up').val();
    count_img_up = $('#img_up').get(0).files.length;
    error_size_img = 0;
    error_type_img = 0;
    $('#formAdd button[type=submit]').html('Đang tải ...');
 
    // Nếu có chọn ảnh
    if (img_up) {
        //e.preventDefault();
         
        // Kiểm tra dung lượng ảnh
        for (i = 0; i <= count_img_up - 1; i++)
        {
            size_img_up = $('#img_up')[0].files[i].size;
            if (size_img_up > 5242880) { // 5242880 byte = 5MB 
                error_size_img += 1; // Lỗi
            } else {
                error_size_img += 0; // Không lỗi
            }
        }
 
        // Kiểm tra định dạng ảnh
        for (i = 0; i <= count_img_up - 1; i++)
        {
            type_img_up = $('#img_up')[0].files[i].type;
            if (type_img_up == 'image/jpeg' || type_img_up == 'image/png' || type_img_up == 'image/gif') {
                error_type_img += 0;
            } else {
                error_type_img += 1;
            }
        }
 
        // Nếu lỗi về size ảnh
        if (error_size_img >= 1) {
            $('#formAdd button[type=submit]').html('Upload');
            $('#formAdd .alert').removeClass('d-none');
            $('#formAdd .alert').html('Một trong các tệp đã chọn có dung lượng lớn hơn mức cho phép.');
            return false;
        // Nếu số lượng ảnh vượt quá 2 file
        } else if (count_img_up > 2) {
            $('#formAdd button[type=submit]').html('Upload');
            $('#formAdd .alert').removeClass('d-none');
            $('#formAdd .alert').html('Số file upload cho mỗi lần vượt quá mức cho phép.');
            return false;
        } else if (error_type_img >= 1) {
            $('#formAdd button[type=submit]').html('Upload');
            $('#formAdd .alert').removeClass('d-none');
            $('#formAdd .alert').html('Một trong những file ảnh không đúng định dạng cho phép.');
            return false;
        } else {
            $(this).ajaxSubmit({ 
                beforeSubmit: function() {
                    target:   '#formAdd .alert', 
                    $("#formAdd .box-progress-bar").removeClass('d-none');
                    $("#formAdd .progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){ 
                    $("#formAdd .progress-bar").animate({width: percentComplete + '%'});
                    $("#formAdd .progress-bar").html(percentComplete + '%');
                },
                success: function (data) {     
                    $('#formAdd button[type=submit]').html('Upload');
                    $('#formAdd .alert.upload').attr('class', 'alert alert-success upload'); 
                    $('#formAdd .alert.upload').html(data);
                    window.location = $_DOMAIN;
                },
                error: function() {
                    $('#formAdd button[type=submit]').html('Upload');
                    $('#formAdd .alert.upload').removeClass('d-none');  
                    $('#formAdd .alert.upload').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
                },
                resetForm: true
            }); 
            return false;
        }
    // Ngược lại không chọn ảnh
    } else {
        $('#formAdd button[type=submit]').html('Upload');
        $('#formAdd .alert').removeClass('d-none');
        $('#formAdd .alert').html('Vui lòng chọn tệp hình ảnh.');
    }
});