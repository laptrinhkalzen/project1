<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class DepartmentController extends Controller
{
    public function AuthAdmin(){
        $admin_id = Session::get('e_id');
        $id=DB::table('tbl_e')->where('e_id',$admin_id)->first();
         $id1=$id->is_admin;

        if($admin_id && $id1==1){
            return Redirect::to('admin-dashboard');
        }else{
            return Redirect::to('/')->send();
        }
    }

    public function add_department()
    {
        $this->AuthAdmin();
        return view('add_department');     
    }

    public function all_department(){
        $this->AuthAdmin();
        $all_department= DB::table('tbl_department')->get();
        $manager_department = view('all_department')->with('all_department', $all_department);
        return view('admin_layout')->with('all_department', $manager_department);

        }

    public function save_department(Request $request){
        $this->AuthAdmin();
        $data = array();
        $data['department_name']= $request->department_name;
              $this->validate($request,
        [
                       
            'department_name' => 'bail|required|unique:tbl_department',
            
            
                
        ],

        [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
        ],

        [
            
            'department_name' => 'Tên phòng ban',
      ]

    );
        DB::table('tbl_department')->insert($data);
        Session::put('message', 'Thêm phòng ban thành công');
        return Redirect::to('add-department');
    }

 
    public function edit_department($department_id){
        $this->AuthAdmin();
        $edit_department= DB::table('tbl_department')->where('department_id', $department_id)->get();
        $manager_department = view('edit_department')->with('edit_department', $edit_department);
        return view('admin_layout')->with('edit_department', $manager_department);
    }

    public function update_department(Request $request, $department_id){
        $this->AuthAdmin();
        $data = array();
        $data['department_name']= $request->department_name;
        DB::table('tbl_department')->where('department_id', $department_id)->update($data);
        Session::put('message', 'Cập nhật phòng ban thành công');
        return Redirect::to('all-department');
    }

    public function delete_department($department_id){
        $this->AuthAdmin();
        DB::table('tbl_department')->where('department_id', $department_id)->delete();
        Session::put('message', 'Xóa phòng ban thành công');
        return Redirect::to('all-department');
    }

}
