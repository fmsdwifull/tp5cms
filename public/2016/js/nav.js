$(function () {


    //-------- 导航 --------


    //-------- 判断分辨率 --------

    $(window).resize(function () {

    })

    $(window).load(function () {
        positioncont();
        $(window).resize(function () {
            positioncont();
        })
    })

    function positioncont() {}
	
	var overflowwid = $("body").css("overflow", "hidden").width();
    var windowwid = $("body").removeAttr("style").width();
    var scrollwid = overflowwid - windowwid;
	
	
	 if (windowwid + scrollwid > 991) {
            //pc导航
            $('.wwnav ul li').unbind("mouseenter").bind('mouseenter', function () {
                $(this).find('.wwnavlist').show();
            });

            $('.wwnav ul li').unbind("mouseleave").bind('mouseleave', function () {
                $(this).find('.wwnavlist').hide();

            });

            $('.wwnavdrop').unbind("mouseenter").bind('mouseenter', function () {

				if($(this).find('ul li').length == 0){
				    $(this).find('.wwnavdroplist').hide()
				}else{
					 $(this).find('.wwnavdroplist').show();	
				}
            });

            $('.wwnavdrop').unbind("mouseleave").bind('mouseleave', function () {
                $(this).find('.wwnavdroplist').hide();

            });

			if($('.wwnavdrop').find('.wwnavdroplist').lengths > 0){
				
				
            $('.wwnavdrop').unbind("mouseenter").bind('mouseenter', function () {

                $(this).find('.wwnavdroplist').show();
            });	
					
			}
				
			


        }else{
			$(".wwnav ul li").unbind("mouseenter");
            $(".wwnavdrop").unbind("mouseenter");
            $(".wwnav ul li").unbind("mouseleave");
            $(".wwnavdrop").unbind("mouseleave");	
		}
	
})