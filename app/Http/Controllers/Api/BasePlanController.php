<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasePlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BasePlanController extends Controller
{
    public function index(): JsonResponse
    {
        $basePlans = BasePlan::all();
        // dd($basePlans):
        return response()->json($basePlans);
    }

    public function show(BasePlan $basePlan): JsonResponse
    {
        return response()->json($basePlan);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_standard' => 'required|integer',
            'comment' => 'nullable|string',
            'floor_area_1f' => 'required|numeric',
            'floor_area_2f' => 'nullable|numeric',
            'image_url_1f' => 'nullable|string|max:255',
            'image_url_2f' => 'nullable|string|max:255',
        ]);

        $basePlan = BasePlan::create($validated);
        return response()->json($basePlan, Response::HTTP_CREATED);
    }

    public function update(Request $request, BasePlan $basePlan): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price_standard' => 'sometimes|required|integer',
            'comment' => 'nullable|string',
            'floor_area_1f' => 'sometimes|required|numeric',
            'floor_area_2f' => 'nullable|numeric',
            'image_url_1f' => 'nullable|string|max:255',
            'image_url_2f' => 'nullable|string|max:255',
        ]);

        $basePlan->update($validated);
        return response()->json($basePlan);
    }

    public function destroy(BasePlan $basePlan): JsonResponse
    {
        $basePlan->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
