require('./bootstrap');

// add custom js
$('.sidebar-toggle').on('click',function(){

    var cls =  $('body').hasClass('sidebar-collapse');
    if(cls == true){
        $('body').removeClass('sidebar-collapse');
    } else {
        $('body').addClass('sidebar-collapse');
    }

});
