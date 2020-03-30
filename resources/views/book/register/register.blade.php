<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="/assetstwo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assetstwo/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assetstwo/css/form-elements.css">
    <link rel="stylesheet" href="/assetstwo/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<style type="text/css">
    <!--
    body {
        background-image: url(/assetstwo/img/backgrounds/1.jpg);
    }
    -->
</style>
<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Register to our site</h3>
                            <p>输出手机号密码和验证码即可注册</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-key"></i>
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
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="form-code" placeholder="验证码..." class="form-password form-control" id="form-name">
                                <button id="getcode">获取验证码</button>
                            </div>

                            <button type="submit" class="btn">注册</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>


<!-- Javascript -->
<script src="/assetstwo/js/jquery-1.11.1.min.js"></script>
<script src="/assetstwo/bootstrap/js/bootstrap.min.js"></script>
<script src="/assetstwo/js/jquery.backstretch.min.js"></script>
<script src="/assetstwo/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="/assetstwo/js/placeholder.js"></script>
<![endif]-->

</body>

</html>
<script>
    //手机号验证
    $("#form-username").blur(function(){
        var phone = $('#form-username').val();
        if(phone == ''){
            alert('手机号不可以为空');
            return false;
        }
        if(!(/^1[3456789]\d{9}$/.test(phone))){
            alert("手机号码有误，请重填");
            $('#form-username').val('');
            return false;
        }
    });

    //密码验证
    $("#form-password").blur(function(){
        var password = $('#form-password').val();
        if(password == ''){
            alert('密码不可以为空');
            return false;
        }

    });
    //点击获取验证码 发送手机号到后台

    //点击提交发送手机号 和密码
    $('.btn').click(function(){
        var phone = $('#form-username').val();
        var password= $('#form-password').val();
        var code=$('#form-code').val();
        $.ajax({
           url:'doregister',
           data:{phone:phone,password:password,code:code},
           type:'post',
           dataType:'json',
           success:function(res){
                if (res.code==1){
                    alert(res.msg);
                    location.href='http://lyx.wdx0218.com/book/login/login';
                }else if (msg.code==444){
                    alert(res.msg);
                }
           }

        });
    });

</script>