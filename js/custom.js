$(".working").click(function(){
    var id=$(this).val();
    if(id=='0'){
        $(".last_work").show();
    }else{
        $(".last_work").hide();
    }
    
});


// $("#datereli").click(function(){
//     var datejoin=$("#datejoin").val();
//     //$("#datereli").attr('max',datejoin);
    
//     alert(datejoin);
    
    
// });




$(document).on("click","#datereli",function(){
    var datejoin=$("#datejoin").val();
    // $("#datereli").attr('min',datejoin);
    
});


$("#registrationsub").click(function(){

    var text=$("#registrationsub").text();
    $("#registrationsub").text('Please Wait...');

    
    
});





