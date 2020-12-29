<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Serials;
use App\User;
use App\Report;
class serialController extends Controller
{
   

    public function sendSerial(Request $request, Category $category){
        /* $this->validate(request(),[
            'number'=>'required|min:10'
        ]); */

        $codeobject = $category->serials->first();

        if(!empty($codeobject) & auth()->user()->balance>=$category->title) { 
            $code = decrypt($codeobject->serial);
                    
        $message = 'تمتع بحزمة انترنت : '.$category->description.' ، رمز الدخول '.$code.'';

        $url = 'http://int.mtcsms.com/sendsms.aspx';
        
        $fields = array(
            'username'      => "adminihab",
            'password'      => "630672",
            'from'    => "GazaNet",
            'to'      => $request->number,
            'msg'     => $message,
            'type'    => '0'
        );
        
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        
        //execute post
        $result = curl_exec($ch);
        
        //close connection
        curl_close($ch);
        
        
        var_dump($result);
        //dd($result);

        if($result){
       
        /*   $report = Report::create([
                'user'=>auth()->user()->name,
                
                'category'=>$category->title,
                'serial'=>$code,
                'moblie'=>$request->number,
            ]); */

            $report = new Report;
                $report->user = auth()->user()->name;
                $report->category = $category->title;
                $report->serial = $code;
                $report->mobile = $request->number;
                $report->save();

            
            $user = User::find(auth()->user()->id);
            $user->balance = $user->balance - $category->title;
            $user->save();
            
            $codeobject->delete(); 
        }
            
        return back()->with('status', '1')->with('category', $category->title)->with('num', $request->number);

        }else{
            if(auth()->user()->balance>=$category->title){
                return back()->with('status','-1')->with('category', $category->title); 
            }else{
                return back()->with('status','-2')->with('category', $category->title);            
            }
        }
    
    }
    
}
