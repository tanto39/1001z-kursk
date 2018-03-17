
$(document).ready(function() {

    //кнопка наверх
    function show_scrollTop() {
        ( $(window).scrollTop() > 450 ) ? $('.scroll').css('display', 'block') : $('.scroll').css('display', 'none');
    }

    $(window).scroll(function () {
        show_scrollTop();
    });
    show_scrollTop();
    $('.scroll').click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: 0}, 1000);
    });

    // $(document).ready(function(){
    //     var widthLeft = $('.leftmenu').width();
    //     function show_scrollTop1(){
    //         var leftmenu = $('.leftmenu');
    //         console.log(widthLeft);
    //         ( $(window).scrollTop() > 700) ? leftmenu.css({'position':'fixed','top':'1px', 'width':widthLeft}) : leftmenu.css({'position':'relative','top':'0px','width':'auto'});
    //     }
    //     $(window).scroll( function(){ show_scrollTop1(); } );
    //     show_scrollTop1();
    // });

    //ajax форма обратной связи отправка
    $(".form-zakaz form").submit(function(e) {
        e.preventDefault();
        $('.message-form').css('display','block');
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: str,
            success: function(data) {
                $('.message-form').html(data);
            }

        });
        return false;
    });

	//ссылка на  соглашение
	$(".form-pd a").attr("href", "pd.docx");

});