<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user;
class LoginController extends Controller
{
    // 视图 页面
    public function reg()
    {   
        // echo 1;die;
        // echo phpinfo();die;

        $name=request()->input('name');
        $pwdone=request()->input('pwdone');
        $pwdtwo=request()->input('pwdtwo');
        // return $pwdtwo;
        if ($pwdone != $pwdtwo) {
            return json_encode('两次密码不一样啊');
        }
        $time=time();
        $ip = $_SERVER['REMOTE_ADDR'];
        $pwd=password_hash($pwdtwo, PASSWORD_DEFAULT);
        // dd($ip);
        //添加入
        $data=[
            'u_name'=>$name,
            'u_pwd'=>$pwd,
            'u_ip'=>$ip,
            'u_time'=>$time
        ];
        // dd($data);
        $res=user::create($data);
        if ($res) {
            return json_encode('1添加成功1');
        }
        
    }

    //登录
    public function login()
    {   

        

    	$name=request()->input('name');
        $pwd=request()->input('pwd');
        

        //根据姓名查询 
        $data= user::where('u_name',$name)->first();
        if ($data) {
            $res=password_verify($pwd,$data->u_pwd);
            if ($res) {
                $token=md5(rand(1000,9999));
               return json_encode(['code'=>1,'msg'=>'登录成功','token'=>$token]);
            }else{
               return json_encode(['code'=>444,'msg'=>'密码错误']);
            }        
        }else{
            return json_encode('用户不存在');
        }



    }

     public function info()
    {   
        echo "this is a test";

        // $user_token = $_SERVER['HTTP_TOKEN'];
        // echo 'user_token: '.$user_token;echo '</br>';
        // $current_url = $_SERVER['REQUEST_URI'];
        // echo "当前URL: ".$current_url;echo '<hr>';
        // //echo '<pre>';print_r($_SERVER);echo '</pre>';
        // //$url = $_SERVER[''] . $_SERVER[''];
        // $redis_key = 'str:count:u:'.$user_token.':url:'.md5($current_url);
        // echo 'redis key: '.$redis_key;echo '</br>';
        // $count = Redis::get($redis_key);        //获取接口的访问次数
        // echo "接口的访问次数： ".$count;echo '</br>';
        // if($count >= 5){
        //     echo "请不要频繁访问此接口，访问次数已到上限，请稍后再试";
        //     Redis::expire($redis_key,3600);
        //     die;
        // }
        // $count = Redis::incr($redis_key);
        // echo 'count: '.$count;
    }


}

