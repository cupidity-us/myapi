<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CipherController extends Controller
{
    public function geturl()
    {

    }
    //对称加密
    public function getcipher()
    {	
    	
    	//接收信息
    	// $info=request()->get('info');
    	// echo $info;die;
        $info ='asdqwe';
        // $data = json_encode($data);
        // echo $info;die;
    	//加密方式
    	$method='AES-256-CBC';
    	//密钥
    	$key='iimapig';
    	//iv
    	$iv='WUSD8796IDjdxshd';


    	$n_data=openssl_encrypt($info,$method,$key,OPENSSL_RAW_DATA,$iv);
    	$n_data=base64_encode($n_data);
        $n_data=urlencode($n_data);
    	// $url="http://lyx.wdx0218.com/test/signal/setsignal?n_data=".$n_data;
    	// $res=file_get_contents($url);
    	return $n_data;
    }

    public function setsignal()
    {
        $data= request()->input('data');
        // echo $data;die;
       
        
        //加密方式
        $method='AES-256-CBC';
        //密钥
        $key='iimapig';
        //iv
        $iv='WUSD8796IDjdxshd';

        $info=openssl_decrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        $info=base64_decode($info);
        // $info =json_decode($info,true);
        return $info;

    }

    public function mdfiveinfo()
    {
        $params = [
            'user_name' => "zhangsan",
            'email'     => 'zhangsan@qq.com',
            'amount'    => 5000,
            'date'      => time()
        ];

        // 将参数字典序排序
        ksort($params);
        //  拼接  待签名 字符串
        $str = "";
        foreach ($params as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }

        $str = rtrim($str,'&');

        $key ='adcdefd';
        $info=md5($str.$key);
        return $str.'&'.'info'.'='.$info;
    }

    public function mdfivegetinfo()
    {
        $amount=request()->input('amount');
        $date=request()->input('date');
        $email=request()->input('email');
        $user_name=request()->input('user_name');
        $info=request()->input('info');
        // var_dump($amount.$date.$email.$user_name.$info);
        $key ='adcdefd';
        $arr=[
            'amount'=>$amount,
            'date'=>$date,
            'email'=>$email,
            'user_name'=>$user_name
        ];

        ksort($arr);
        // var_dump($arr);die;
        //  拼接  待签名 字符串
        $str = "";
        foreach ($arr as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }

        $str = rtrim($str,'&');
        $md5info=md5($str.$key);
        if ($md5info==$info) {
            return json_encode(['msg'=>'验证成功']);
        }else{
            return json_encode(['msg'=>'失败']);

        }

    }
}
