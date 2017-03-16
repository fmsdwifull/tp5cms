
$(function(){
             
    $('#username').blur(function(){
                  
                   var uname=$('#username').val();
                   
                   if(uname==''){

                   alert('请输入用户名！');

                   return false;

             }
            
                  if(uname.length<5 ||uname.length>=16){

                 $('.uname').html('用户名长度必须在5-16位之间');

                  $('.uname').css('color','red');

                 return flase;

            }


