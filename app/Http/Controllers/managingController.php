<?php

namespace App\Http\Controllers;

use App\Http\Resources\FloorResource;
use App\Http\Resources\RoomResource;
use App\Models\Floor;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class managingController extends Controller
{
    public function floors(Request $request)
    {
        
        if (!Auth::guard("user")->user()->can("manage rooms")) {
            abort(403);
        }


        if ($request->ajax()) {
            $data = Floor::with(['manager', 'creator'])->get();
            $data = FloorResource::collection($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('creator', function ($row) {
                    return $row['created_by']->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" created-by="'.$row['created_by']['id'].'" data-id="'.$row['id'].'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct actionBtn">Edit</a>';
                    $btn = $btn.'<a href="javascript:void(0)" created-by="'.$row['created_by']['id'].'" data-id="'.$row['id'].'" data-original-title="Delete" class="edit btn btn-danger btn-sm deleteProduct actionBtn">Delete</a>';
     
                    return $btn;
                })
                ->addColumn('Manager Name', function ($row) {
                    return $row['floor_manager']->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin-views.floors',[
            'users'=> User::where('role','manager')->get()
        ]);
    }

    public function rooms(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Room::with(['manager', 'floor'])->get();
            $data = RoomResource::collection($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('creator', function ($row) {
                    return $row['created_by']->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" created-by="'.$row['created_by']['id'].'" data-id="'.$row['id'].'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct actionBtn">Edit</a>';
                    $btn = $btn.'<a href="javascript:void(0)'.$row['id'].'/delete" created-by="'.$row['created_by']['id'].'" data-id="'.$row['id'].'" data-original-title="Delete" class="edit btn btn-danger btn-sm deleteProduct actionBtn">Delete</a>';
     
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin-views.rooms',[
            'users'=> User::where('role','manager')->get(),
            'floors' => Floor::all(),
        ]);
    }
}
