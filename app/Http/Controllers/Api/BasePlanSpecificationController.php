<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasePlan;
use App\Models\BasePlanSpecification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BasePlanSpecificationController extends Controller
{
    public function index(BasePlan $basePlan): JsonResponse
    {
        $specifications = $basePlan->basePlanSpecifications()
            ->with('specification.specificationsMeisai')
            ->get();
        return response()->json($specifications);
    }

    public function store(Request $request, BasePlan $basePlan): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'required|in:exterior,interior,equipment',
            'specification_id' => 'required|exists:specifications,id',
        ]);

        $specification = $basePlan->basePlanSpecifications()->create($validated);
        return response()->json($specification, Response::HTTP_CREATED);
    }

    public function destroy(BasePlanSpecification $basePlanSpecification): JsonResponse
    {
        $basePlanSpecification->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
