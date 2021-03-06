<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ManagerAjaxController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::guard("user")->user()->can("manage managers")) {
            abort(403);
        }

        if ($request->ajax()) {
            $data = User::where("role", 'manager')->latest()->get();
            $data = UserResource::collection($data);
            $res = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" created-by="'.$row['created_by']['id'].'"  data-id="'.$row['id'].'" data-original-title="Edit" class="edit btn btn-primary btn-sm editManager actionBtn">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" created-by="'.$row['created_by']['id'].'"  data-id="'.$row['id'].'" data-original-title="Delete" class="btn btn-danger btn-sm deleteManager actionBtn">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $res;
        }

        return view('admin-views.managers');
    }

    public function edit($userID)
    {
        $user = User::where('id', $userID)->firstOrFail();
        return new UserResource($user);
    }

    public function update(StoreUserRequest $request, $userID)
    {
        $user = User::where('id', $userID)->firstOrFail();
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy($userID)
    {
        $user = User::where('id', $userID)->delete();
    }
}
