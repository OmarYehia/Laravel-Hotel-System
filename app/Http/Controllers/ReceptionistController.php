<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;
use Yajra\DataTables\Facades\DataTables;
use DB;  

class ReceptionistController extends Controller
{
    public function index(Request $request)
    {
        dd(DB::table('users')->where(['id'=>DB::table('model_has_roles')->where(['role_id'=>'3'])->first()->model_id])->latest()->get());
        if ($request->ajax()) {
            $data = DB::table('users')->where(['id'=>DB::table('model_has_roles')->where(['role_id'=>'3'])->latest()->get()->model_id])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="/api/users/'.$row->id.'" class="edit btn btn-primary btn-sm">View</a>';
                        $btn = $btn.'<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn = $btn.'<a href="/api/users/'.$row->id.'/delete" class="edit btn btn-primary btn-sm">Delete</a>';
     
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
      
        return view('client-views.reservations');
    }
}
