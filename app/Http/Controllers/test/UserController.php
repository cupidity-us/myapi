<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\users;
use App\models\userkey;
class UserController extends Controller
{
    public function addkey()
    {
    	return view('test/user/addkey');
    }

    public function dokey()
    {
    	$pub=request()->input('pub');
    	$name=request()->input('name');
    	if (!$pub) {
    	   return json_encode(['code'=>444,'res'=>'公钥为空']);die;
    	}
    	//根据名字查询users 表 
    	$u_id=users::where('name',$name)->first()->id;
    	$hname=userkey::where('name',$name)->first();
    	if ($hname) {
    		return json_encode(['code'=>444,'res'=>'这个人已经添加过了']);die;
    	}
    	//入库 
    	$data = [
    		'pubkey'=>$pub,
    		'uid'=>$u_id,
    		'name'=>$name,
    		'time'=>time()

    	];
    	$res=userkey::create($data);
    	if ($res) {
    		return json_encode(['code'=>1,'res'=>'添加成功']);die;
    	}
    }

    public function eninfo()
    {
    	return view('test/user/eninfo');
    }

    public function getpub()
    {
    	$name = request()->input('name');
    	//查询 这个名字的 公钥 
    	$pub=userkey::where('name',$name)->first()->pubkey;
    	//传到视图页面
    	if ($pub) {
    		return json_encode(['code'=>1,'info'=>$pub]);
    	}
    }

    public function endata()
    {
    	//接收 姓名 查公钥 解密 然后输出 
    	$name=request()->input('name');
    	//就是加密的数据
    	$info=request()->input('info');
    	//根据姓名查询
    	$pub=userkey::where('name',$name)->first()->pubkey;
    	if ($pub) {
    		$info=base64_decode($info);
    		openssl_public_decrypt($info,$de_data,$pub);
    		return json_encode(['code'=>1,'info'=>$de_data]); 
    	}
    	

    }
}
