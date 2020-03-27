<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiddleController extends Controller
{
    public function eninfo()
    {	

    	$data ='我是猪';	
    	$priv =file_get_contents(storage_path('keys/priv.key'));
      	//数据通过私钥加密
    	openssl_private_encrypt($data,$en_data,$priv);
    	echo base64_encode($en_data);

        
    	// $pub=file_get_contents(storage_path('keys/pub.key'));
    	// openssl_public_decrypt($en_data,$de_data,$pub);
    	// return $de_data; 
    }


    public function sign1()
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
        
        //使用私钥进行签名
        $priv_key = file_get_contents(storage_path('keys/priv.key'));
        openssl_sign($str,$signature,$priv_key,OPENSSL_ALGO_SHA256);

        //验证签名
        $pub_key = file_get_contents(storage_path('keys/pub.key'));
        $status = openssl_verify($str,$signature,$pub_key,OPENSSL_ALGO_SHA256);

        // base64编码签名
        $sign = base64_encode($signature);
       
       
    }

}
