<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

//test 登录注册
Route::prefix('test/login')->group(function(){//前台登录页
    Route::any('reg','test\LoginController@reg');//后台列表页
    Route::any('login','test\LoginController@login');//后台列表页
    Route::any('info','test\LoginController@info');//后台列表页
});
//凯撒密码
Route::prefix('test/caesar')->group(function(){//前台登录页
    Route::any('geta','test\CaesarController@geta');//后台列表页
    Route::any('seta','test\CaesarController@seta');//后台列表页
});
//对称加密
Route::prefix('test/cipher')->group(function(){//前台登录页
    Route::any('geturl','test\CipherController@geturl');//后台列表页
    Route::any('getcipher','test\CipherController@getcipher');//后台列表页
    Route::any('setsignal','test\CipherController@setsignal');//后台列表页mdfiveinfo
    Route::any('mdfiveinfo','test\CipherController@mdfiveinfo');//后台列表页mdfiveinfomdfivegetinfo
    Route::any('mdfivegetinfo','test\CipherController@mdfivegetinfo');//后台列表页mdfiveinfomdfivegetinfo
});
//非对称加密
Route::prefix('test/riddle')->group(function(){//前台登录页
    Route::any('eninfo','test\RiddleController@eninfo');//后台列表页deinfo
    Route::any('deinfo','test\RiddleController@deinfo');//后台列表页deinfo

});
//框架 添加pub and 解密
Route::prefix('test/user')->group(function(){//前台登录页
    Route::any('addkey','test\UserController@addkey');//后台列表页deinfo
    Route::any('dokey','test\UserController@dokey');//后台列表页deinfo
    Route::any('eninfo','test\UserController@eninfo');//后台列表页deinfo
    Route::any('getpub','test\UserController@getpub');//后台列表页deinfo endata
    Route::any('endata','test\UserController@endata');//后台列表页deinfo endata
});

//验证签名
Route::prefix('test/sign')->group(function(){//前台登录页
    Route::any('list','test\SignController@list');//后台列表页deinfo
});

//2020.1.9 登录注册
Route::prefix('test/belief')->group(function(){//前台登录页
    Route::any('reg','test\BeliefController@reg');//后台列表页deinfo
    Route::any('login','test\BeliefController@login');//后台列表页deinfo
});
//新的项目 开始
//登录oauth
Route::prefix('book/login')->group(function(){//前台登录页
    Route::any('login','book\LoginController@login');//登录页面
    Route::any('qrcode','book\LoginController@qrcode');//二维码
    Route::any('oauth','book\LoginController@oauth');//二维码
    Route::any('loginin','book\LoginController@loginin');//二维码
    Route::any('getstatus','book\LoginController@getstatus');//查看是否需要跳转
    Route::any('code','book\LoginController@code');//微信平台
});



