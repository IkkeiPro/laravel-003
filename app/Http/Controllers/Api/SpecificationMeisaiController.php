<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use App\Models\SpecificationMeisai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecificationMeisaiController extends Controller
{
    public function index(Specification $specification): JsonResponse
    {
        $meisai = $specification->specificationsMeisai;
        return response()->json($meisai);
    }

    public function store(Request $request, Specification $specification): JsonResponse
    {
        $validated = $request->validate([
            'line_no' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'is_enabled' => 'required|boolean',
            'is_default' => 'required|boolean',
        ]);

        $meisai = $specification->specificationsMeisai()->create($validated);
        return response()->json($meisai, Response::HTTP_CREATED);
    }

    public function update(Request $request, SpecificationMeisai $meisai): JsonResponse
    {
        $validated = $request->validate([
            'line_no' => 'sometimes|required|integer',
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|integer',
            'is_enabled' => 'sometimes|required|boolean',
            'is_default' => 'sometimes|required|boolean',
        ]);

        $meisai->update($validated);
        return response()->json($meisai);
    }

    public function destroy(SpecificationMeisai $meisai): JsonResponse
    {
        $meisai->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
