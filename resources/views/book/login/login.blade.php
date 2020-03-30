<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/form-elements.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="/js/jquery.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">

    <style type="text/css">
        <!--
        body {
            background-image: url(/assets/img/backgrounds/1.jpg);
        }
        -->
    </style>
</head>
<style type="text/css">
    .imgg
    {

        position:absolute;
        left:36%;
        top:40%;
        z-index:2;
    }
</style>
<body>

<!-- Top content -->
<div class="top-content">
    <img class="imgg" src="">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Bootstrap</strong> Login Form</h1>
                    <div class="description">
                        <p>
                            This is a free responsive login form made with Bootstrap.
                            Download it on <a href="#"><strong>AZMIND</strong></a>, customize and use it as you like!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Login to our site</h3>
                            <p>如果没有账号点击<a href="http://lyx.wdx0218.com/book/register/register">注册</a>或点击下方扫码登录</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <div role="form"  class="login-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-username">Username</label>
                                <input type="text" name="form-username" placeholder="手机号..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="form-password" placeholder="密码..." class="form-password form-control" id="form-password">
                            </div>
                            <button type="submit" class="btn">Sign in!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 social-login">
                    <h3>...or login with:</h3>
                    <div class="social-login-buttons">

                        <a class="btn btn-link-2" href="javascript:void(0)">
                            <i class="fa fa-twitter"></i> wechat
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="/assets/js/jquery-1.11.1.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.backstretch.min.js"></script>
<script src="/assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="/assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>
<script>
    //点击微信登录 图片
    $(document).on("click", ".btn-link-2",function(){
        $.ajax({
           url:'qrcode',
           type:'get',
           dataType:'json',
           success:function(img){
                if (img.res){
                    $('.imgg').attr("src",'/qrcode.png').show();
                }
           }
        });

        $(function(){
            setInterval(getstatus,5000);
        });
        function getstatus(){
            $.ajax({
                url:'getstatus',
                type:'get',
                dataType:'json',
                success:function(res){
                    if (res.code){
                        location.href='http://lyx.wdx0218.com/book/book/index';
                    }
                }
            });
        }

    });
    //点击隐藏图片
    $('.imgg').click(function(){
        _this=$(this);
        _this.hide();
    });

    //定时检测登录信息 判断 跳转

    //输入手机号密码登录跳转
    $('.btn').click(function(){
       var phone=$('#form-username').val();
       var password=$('#form-password').val();
       $.ajax({
          url:'dologin',
          data:{phone:phone,password:password},
          type:'post',
          dataType:'json',
          success:function(res){
              if (res.code==1){
                  alert(res.msg);
                  location.href='http://lyx.wdx0218.com/book/book/index';
              }else if(res.code==444){
                  alert(res.msg);
              }
          }

       });

    });



</script>

