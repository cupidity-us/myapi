<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\qrcode;

class LoginController extends Controller
{
    public function login()
    {
        return view('book.login.login');
    }

    public function code()
    {
        $data=$_GET['echostr'];
        echo $data;
    }



    public function qrcode()
    {

        $u_id=uniqid();
        $url='http://lyx.wdx0218.com/book/login/oauth?u_id='.$u_id;

        $filename='/data/wwwroot/default/myapi/public/qrcode.png';
        qrcode::png($url,$filename);
        return json_encode(['res'=>$filename]);

    }


    public function oauth()
    {
        $u_id=$_GET['u_id'];
        $id="wx898c3eb05f1812c9";
        $uri=urlencode('http://lyx.wdx0218.com/book/login/loginin');
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$id."&redirect_uri=".$uri."&response_type=code&scope=snsapi_userinfo&state=".$u_id."#wechat_redirect";
        header("location:$url");
    }

    public function loginin()
    {
        $code=$_GET['code'];
        $id="wx898c3eb05f1812c9";
        $secret='59d94a2c064b6b291f74d4858d82531c';
        $tokenurl="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$id."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
        $res=file_get_contents($tokenurl);
        $token =json_decode($res,true)['access_token'];
        $openid=json_decode($res,true)['openid'];

        $userurl="https://api.weixin.qq.com/sns/userinfo?access_token=".$token."&openid=".$openid."&lang=zh_CN";
        $userinfo=file_get_contents($userurl);
        //用户数据
        $user=json_decode($userinfo,true);
        //把数据存在sesion


    }

    public function getstatus()
    {
        $a=1;
        if ($a){
            return json_encode(['code'=>1]);
        }else{
            return json_encode(['code'=>2]);
        }

    }
}
