<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFloorRequest;
use App\Models\Floor;

class FloorController extends Controller
{
    public function store(StoreFloorRequest $request)
    {
        try {
            $floor = Floor::create($request->all());
            return $floor;
        } catch (Exception $e) {
            return false;
        }
    }

    public function index()
    {
        $allFloors = Floor::with(['manager', 'creator'])->get();
    }

    public function show(Floor $floor)
    {
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
    }

    public function update(StoreFloorRequest $request, Floor $floor)
    {
        $floor->update($request->all());
    }
}
