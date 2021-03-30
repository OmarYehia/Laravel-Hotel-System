<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Resources\FloorResource;
use App\Models\Floor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FloorController extends Controller
{
    public function store(StoreFloorRequest $request)
    {
        try {
            $floor = Floor::create($request->all());
            return new FloorResource($floor);
        } catch (Exception $e) {
            return false;
        }
    }

    public function index(Request $request)
    {
        $allFloors = Floor::with(['manager', 'creator'])->get();
        return FloorResource::collection($allFloors);
    }

    public function show(Floor $floor)
    {
        return new FloorResource($floor);
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response()->json(['message' => 'Deleted successfully!']);
    }

    public function update(StoreFloorRequest $request, Floor $floor)
    {
        $floor->update($request->all());
        return response()->json(['message' => 'Updated successfully!']);
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Floor::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="/api/floors/'.$row->id.'" class="edit btn btn-primary btn-sm">View</a>';
                        $btn = $btn.'<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn = $btn.'<a href="/api/floors/'.$row->id.'/delete" class="edit btn btn-primary btn-sm">Delete</a>';
     
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
      
        return view('client-views.reservations');
    }
}