<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\models\belief;
class BeliefController extends Controller
{
    //zh
    public function reg()
    {	
    	echo phpinfo();die;
    	$name=request()->input('name');
    	$email=request()->input('email');
    	$pwd=request()->input('pwd');
    	$pwd=password_hash($pwd, PASSWORD_DEFAULT);
    	//验证姓名 
    	$bool=belief::where('name',$name)->first();
    	if ($bool) {
    		return json_encode(['msg'=>'姓名重复']);die;
    	}
    	$data=[
    		'name'=>$name,
    		'email'=>$email,
    		'pwd'=>$pwd
    	];

    	$res=belief::create($data);
    	if ($res) {
    		return json_encode(['code'=>1,'msg'=>'添加成功']);
    	}else{
    		return json_encode(['code'=>444,'msg'=>'注册失败']);

    	}
    }

    public function login()
    {
    	$code=request()->input('code');
    	$pwd=request()->input('pwd');
    	if (strpos($code, "@")) {
    		//按邮箱查
    		$bool=belief::where('email',$code)->first();
    		if ($bool) {
    			$res=password_verify($pwd,$bool->pwd);
    			if ($res) {
    				//把信息存在redis中
    				$token=md5(uniqid().rand(1000,9999)); 
    				Redis::set($bool->name,$token,7200); 
    				return json_encode(['code'=>1,'msg'=>'登录成功']);

    			}else{
    				return json_encode(['code'=>444,'msg'=>'登录失败']);
    			}
    		}else{
    			return json_encode(['code'=>444,'msg'=>'输入的信息错误']);
    		}
    	}else{
    		$bool=belief::where('name',$code)->first();
    		if ($bool) {
    			$res=password_verify($pwd,$bool->pwd);
    			if ($res) {
    				//把信息存在redis中
    				return json_encode(['code'=>1,'msg'=>'登录成功']);
    			}else{
    				return json_encode(['code'=>444,'msg'=>'登录失败']);
    			}
    		}else{
    			return json_encode(['code'=>444,'msg'=>'输入的信息错误']);
    		}
    		echo "名字";
    	}
    }

    public function getinfo()
    {
    	//根据传递过来的token 去redis里查询 
    	$name=request()->input('name');
    	$token=request()->input('token');
    	$rtoken=Redis::get($name);
    	if (!$rtoken) {
    		return json_encode(['code'=>444,'msg'=>'没有缓存信息请重新登录']);die;
    	}

    	if ($token==$rtoken) {
    		return json_encode(['code'=>1,'msg'=>'您请求的信息为....']);die;
    	}else{
    		return json_encode(['code'=>444,'msg'=>'查询不到您的信息请重新登录']);
    	}

    }

}
