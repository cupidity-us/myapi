<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlipayController extends Controller
{
   	public function pay()
   	{	
   		$ali_gateway = 'https://openapi.alipaydev.com/gateway.do';  //支付网关

   		$app_id='2016101100661060'; //支付宝分配给开发者的应用ID 
   		$method='alipay.trade.page.pay';//接口名称 
   		$harset='utf-8';//请求使用的编码格式，如utf-8,gbk,gb2312等
   		$sign_type='RSA2';//商户生成签名字符串所使用的签名算法类型，目前支持RSA2和RSA，推荐使用RSA2 
   		$sign='';//商户请求参数的签名串，详见签名
   		$timestamp = date('Y-m-d H:i:s');//发送请求的时间，
   		$version='1.0';//调用的接口版本，固定为：1.0 
   		$return_url ='http://www.myapi.com/test/alipay/return';
   		$notify_url='http://www.myapi.com/test/alipay/notify';////支付宝服务器主动通知商户服务器里指定的页面http/https路径。 
   		$biz_conten='';//请求参数的集合，最大长度不限，除公共参数外所有请求参数都必须放在这个参数中传递，具体参照各产品快速接入文档 	


   		//请求参数
   		$out_trade_no=uniqid();//商户订单号,64个字符以内、可包含字母、数字、下划线；需保证在商户端不重复 
   		$product_code='FAST_INSTANT_TRADE_PAY';//销售产品码，与支付宝签约的产品码名称。
   		$total_amount=99999;//订单总金额，单位为元，精确到小数点后两位，取值
   		$subject=' 宝贝袈裟';//订单标题 

   		$request_param = [
            'out_trade_no'=>$out_trade_no,
            'product_code'=>$product_code,
            'total_amount'=>$total_amount,
            'subject'     =>$subject
        ];

        $param=[
        	'app_id' =>$app_id,
        	'method' =>$method,
        	'harset' =>$harset,
        	'sign_type'=>$sign_type,
        	'timestamp'=>$timestamp,
        	'version'=>$version,
        	'notify_url'=>$notify_url,
        	'return_url'=>$return_url,
        	'biz_conten'=>json_encode($request_param)
        ];

        ksort($param);

        $str="";
        foreach ($param as $key => $value) {
        	$str .= $key . '=' . $value .'&';
        }

        $str=rtrim($str,'&');

        $key = storage_path('keys/app_priv');







   	}	

}
