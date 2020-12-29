<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Category;
use App\Serials;
use App\User;
use App\Role;
use App\Report;
use App\Http\Requests;
use Input;
use DB;
use Session;
use Excel;

class pagesController extends Controller
{
    public function home(){
        $categories = Category::all();
        return view('pages.home', compact('categories'));
    }

    public function getUsers(){
        $users = User::all();
        return view('pages.users', compact('users'));
    }

    public function getCategories(){
        $categories = Category::all();
        return view('pages.categories', compact('categories'));
    }
    public function getSerials(Request $request){
        
        if($request['select_cat'] == -1 || $request['select_cat'] == null){
            $serials = Serials::all();
        }else{
            $serials = Serials::where('category_id',$request['select_cat'])->get();  
        }
        
        $categories = Category::all();
        return view('pages.serials', compact('serials','categories'));
    }

    public function editecategory($id){
        $category = Category::find($id);
        return view('pages.editecategory', compact('category'));
    }

    public function updatecategory(Request $request,$id){
        $category = Category::find($id);
        $category->title = $request['title'];
        $category->description = $request['description'];
        $category->save();
        return redirect('home/categories');
    }
    public function deletecategory($id){
        $serial = Serials::find($id);
        $serial->delete();
        return back();
    }

    public function editeSerial($id){
        $serial = Serials::find($id);
        return view('pages.editeserial', compact('serial'));
    }

    public function updateSerial(Request $request,$id){
        $serial = Serials::find($id);
        $serial->serial = $request['serial'];
        $serial->category_id = $request['category_id'];
        $serial->save();
        return redirect('home/serials');
    }
    public function deleteSerial($id){
        if($id == -1){
            Serials::truncate();;
        }else{
            $serial = Serials::find($id);
            $serial->delete();
        } 
        return back();
    }

    public function addRole(Request $request){
        $user = User::where('email',$request['email'])->first();
        $user->roles()->detach();
        if($request['role_user']){
            $user->roles()->attach(Role::where('name','user')->first());
        }
        if($request['role_admin']){
            $user->roles()->attach(Role::where('name','admin')->first());
        }
        return back();
    }

    public function showcategory($id){
        $category = Category::find($id);
        return view('pages.categoryDetails', compact('category'));
    }

    public function createCategory(){
       
        return view('pages.createcategory');
    }

    public function storeCategory(){
        $this->validate(request(),[
            'title'=>'required',
            'description'=>'required'
        ]);
         $category = new Category;

         $category->title = request('title');
         $category->description = request('description');

         $category->save();

         return back();
     }

     public function createSerials(){
        
         return view('pages.createserials');
     }

     public function storeSerials(Request $request){
        $this->validate(request(),[
            'url'=>'required'
        ]);

      /*   $path = $request->file('url')->storeAs('upload','serials.json');         
        
        $path2 = '../storage/app/upload/serials.json';
        $contents = json_decode(file_get_contents($path2), true);

        foreach($contents as $content){
            $serial = new Serials;

            $serial->serial = $content['serial'];
            $serial->category_id = $content['category'];

            $serial->save();
        }
        
            return redirect('/home/createserials')->with('status', 'تم رفع البيانات مشفرة بنجاح (:'); */

            if($request->hasFile('url')){
                Excel::load($request->file('url')->getRealPath(), function ($reader) {
                    foreach ($reader->toArray() as $key => $row) {
                        $data['serial'] = $row['serial'];
                        $data['category'] = $row['category'];
    
                        if(!empty($data)) {
                            //DB::table('serials')->insert($data);
                            $serial = new Serials;
                            
                            $serial->serial = encrypt($data['serial']);
                            $serial->category_id = $data['category'];
                
                            $serial->save();
                        }
                    }
                });
            }
    
/*             Session::put('success', 'Youe file successfully import in database!!!');
    
            return back(); */
            return redirect('/home/createserials')->with('status', 'تم رفع البيانات مشفرة بنجاح (:');
        
     }

     
    public function getReport($sort){
        if(auth()->user()->hasRole('admin')){
            if($sort =='date'){
                $reports = Report::latest()->get();
                return view('pages.report', compact('reports'));
            }else{
                $reports = Report::orderBy('category', 'desc')->get();
                return view('pages.report', compact('reports'));
            }
        }else{
            if($sort =='date'){
                $reports = Report::where('user',auth()->user()->name)->latest()->get();
                return view('pages.report', compact('reports'));
            }else{
                $reports = Report::where('user',auth()->user()->name)->orderBy('category', 'desc')->get();
                return view('pages.report', compact('reports'));
            }
        }

        
    }



}
