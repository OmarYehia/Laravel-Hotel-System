<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Resources\FloorResource;
use App\Models\Floor;

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

    public function index()
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
}
