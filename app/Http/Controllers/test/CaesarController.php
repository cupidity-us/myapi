<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaesarController extends Controller
{
    public function geta()
    {
    	$str=request()->input('str');
    	$lenth=strlen($str);
    	$newstr='';
    	for($i=0;$i<$lenth;$i++){
    		// echo  $str[$i].'-->'.(ord($str[$i])+3).'->'.chr((ord($str[$i])+3)).'<br>';
 			 $newstr.=chr((ord($str[$i])+3));
    	}
    	
    	echo $newstr;
    }

    public function seta()
    {	
    	
    	// $newstr=$this->geta();
        $str=request()->input('str'); 
    	$lenth=strlen($str);
    	$oldstr='';
    	for($i=0;$i<$lenth;$i++){
    		// echo  $str[$i].'-->'.(ord($str[$i])+3).'->'.chr((ord($str[$i])+3)).'<br>';
 			 $oldstr.=chr((ord($str[$i])-3));
    	}	
    	echo $oldstr;
    }


}
