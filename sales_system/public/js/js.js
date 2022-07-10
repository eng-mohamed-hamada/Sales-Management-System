$(document).ready(function(){
    $(".sideBar-button").click(function(){
        $(".sideBar").toggle(300);
    });
    $(".sideBar").niceScroll();
    //printing the table data
    $("body").on("click", "button[name='print_table']", function(){

        var page_content = $("body").html();
        var table_content = $(this).parents(".myTable:first").html();
        $("body").html(table_content);
        window.print();
        $("body").html(page_content);
    });

    $("#table_body").on("click", "a[name='show_photo']", function(e){
        e.preventDefault();
        var photo = $(this).attr("href");
        $("#show_photo").html("<img src='"+photo+"'>");
        $("#show_photo").css("display", "block");
    });
    $("#show_photo").on("click", "img", function(){
        $("#show_photo").html("");
        $("#show_photo").css("display","none");
    });
    $("body").on("click", "a[name='delete']",function(e){
        e.preventDefault();
        var _token = $("#_token").val();
        var url = $(this).attr("href");
        var status = confirm("حذفك لهذا الحقل سيؤدى الى حذف جميع البيانات المتعلقه به");
        if(status==true){
            $.ajax({
                url:url,
                method:"post",
                data:{"_token":_token},
                beforeSend:function(){
                    $(".load_content").css("display","block");
                },
                success:function(responsetext){
                    $(".load_content").css("display","none");
                    $("#alert_message").text("تم حذف الحقل بنجاح").fadeIn().delay(2000).fadeOut();
                    $("#table_body").html(responsetext);
                },
                error: function(data_error, exception){
                    $(".load_content").css("display","none");
                    if(exception == "error"){
                        $("#alert_message").text(data_error.responseJSON.message).fadeIn().delay(2000).fadeOut();
                    }
                }
            });
        }
        
    });
    $("button[name='add']").on("click",function(){
        var theform = $(this).parents('form:first');
        var theform_id = $(this).parents('form:first').attr("id");
        var formData = new FormData(document.forms[theform_id]);
        
        var url = theform.attr("action");
        $.ajax({
            url: url,
            method:'POST',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            asyn:false,
            beforeSend:function(){
                $(".load_content").css("display","block");
            },
            success:function(responsetext){
                $(".load_content").css("display","none");
                if(responsetext == "amount_not_avaliable"){
                    $("#alert_message").text("الكميه المراد اضافتها غير متاحه").fadeIn().delay(2000).fadeOut();
                }else if(responsetext == "borrow_end"){
                    $("#alert_message").text("تم انتهاء السلفه لهذا الموظف").fadeIn().delay(2000).fadeOut();
                }else{
                    $("#alert_message").text("تم اضافة البيانات").fadeIn().delay(2000).fadeOut();
                    $("#table_body").html(responsetext);
                }

            },
            error: function(data_error, exception){
                $(".load_content").css("display","none");
                if(exception == "error"){
                    $("#alert_message").text("تحقق من البيانات المدخله وحاول مره اخرى").fadeIn().delay(2000).fadeOut();
                }
            }
        });
    });

    $("#search").on("click",function(){
        var search_text = $("#search_text").val();
        var url = $(this).parents('form:first').attr("action");
        var _token = $("#_token").val();
        $.ajax({
            url:url,
            method:"post",
            data:{"_token":_token,"search_text":search_text},
            beforeSend:function(){
                $(".load_content").css("display","block");
            },
            success:function(responsetext){
                $(".load_content").css("display","none");
                $("#table_body").html(responsetext);
            },
            error: function(data_error, exception){
                $(".load_content").css("display","none");
                if(exception == "error"){
                    $("#alert_message").text("تحقق من البيانات المدخله وحاول مره اخرى").fadeIn().delay(2000).fadeOut();
                }
            }
        });
    });

    $("#update").on("click", "button[name='close']", function(){
        $("#update").text("");
        $("#update").css("display", "none");
    });
    $("#update").on("click", "button[name='update']", function() {
        var theform = $(this).parents('form:first');
        var theform_id = $(this).parents('form:first').attr("id");
        var formData = new FormData(document.forms[theform_id]);
    
        var url = theform.attr("action");
        $.ajax({
            url: url,
            method:'POST',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $(".load_content").css("display","block");
            },
            success:function(responsetext){
                $(".load_content").css("display","none");
                if(responsetext == "amount_not_avaliable"){
                    $("#alert_message").text("الكميه المراد اضافتها غير متاحه").fadeIn().delay(2000).fadeOut();
                }else if(responsetext == "borrow_end"){
                    $("#alert_message").text("تم انتهاء السلفه لهذا الموظف").fadeIn().delay(2000).fadeOut();
                }else{
                    $("#alert_message").text("تم تحديث البيانات بنجاح").fadeIn().delay(2000).fadeOut();
                    $("#table_body").html(responsetext);
                    $("#update").text("");
                    $("#update").css("display", "none");
                }
            },
            error: function(data_error, exception){
                $(".load_content").css("display","none");
                if(exception == "error"){
                    $("#alert_message").text("تحقق من البيانات المدخله وحاول مره اخرى").fadeIn().delay(2000).fadeOut();
                }
            }
        });
    });
    
    $("body").on("click", "a[name='edit']",function(e){
        e.preventDefault();
        var _token = $("#_token").val();
        var url = $(this).attr("href");
        $.ajax({
            url:url,
            method:"post",
            data:{"_token":_token},
            beforeSend:function(){
                $(".load_content").css("display","block");
            },
            success:function(responsetext){
                $(".load_content").css("display","none");
                $("#update").html(responsetext);
                $("#update").css("display", "block");
            },
            error: function(data_error, exception){
                $(".load_content").css("display","none");
                if(exception == "error"){
                    $("#alert_message").text(data_error.responseJSON.message).fadeIn().delay(2000).fadeOut();
                }
            }
        });
    });
    
    //get department's categories
    $("body").on("change", "select[name='depart_number']", function(){
        var department_number = $(this).val();
        var _token =$("#_token").val();
        $.ajax({
            url:"/get/department/categories",
            method:"post", 
            data:{"_token":_token, "department_number":department_number},
            success: function(responsetext){
                $("select[name='category_number']").html(responsetext);
            }
        });
    });

    //get category products
    $(document).on("change", "select[name='category_number']", function(){
        var category_number = $(this).val();
        var _token =$("#_token").val();
        $.ajax({
            url:"/get/category/products",
            method:"post", 
            data:{"_token":_token, "category_number":category_number},
            success: function(responsetext){
                $("select[name='product_number']").html(responsetext);
            }
        });
    });
});



