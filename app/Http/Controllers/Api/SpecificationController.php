<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Specification::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $specifications = $query->with('specificationsMeisai')->get();
        return response()->json($specifications);
    }

    public function show(Specification $specification): JsonResponse
    {
        $specification->load('specificationsMeisai');
        return response()->json($specification);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'required|in:exterior,interior,equipment',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $specification = Specification::create($validated);
        return response()->json($specification, Response::HTTP_CREATED);
    }

    public function update(Request $request, Specification $specification): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'sometimes|required|in:exterior,interior,equipment',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $specification->update($validated);
        return response()->json($specification);
    }

    public function destroy(Specification $specification): JsonResponse
    {
        $specification->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
