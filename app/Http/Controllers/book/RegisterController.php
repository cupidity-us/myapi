<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\bookuser;
class RegisterController extends Controller
{
    public function register()
    {
        return view('book.register.register');
    }

    public function doregister()
    {
        //接收数据
        $phone= request()->input('phone');
        $password=request()->input('password');
        $password=password_hash($password, PASSWORD_DEFAULT);
        $code=request()->input('code');
        $time=time();
        //数据入库
        $data=[
            'phone'=>$phone,
            'password'=>$password,
            'regtime'=>$time
        ];

        $res=bookuser::create($data);
        if ($res) {
            return json_encode(['code'=>1,'msg'=>'注册成功']);
        }else{
            return json_encode(['code'=>444,'msg'=>'注册失败']);

        }

    }
}
