<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsultationUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsultationUserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = ConsultationUser::with('selectedPlan')->get();
        return response()->json($users);
    }

    public function show(ConsultationUser $consultationUser): JsonResponse
    {
        $consultationUser->load('selectedPlan');
        return response()->json($consultationUser);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name_kana' => 'required|string|max:255',
            'first_name_kana' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'zip_code' => 'required|string|max:8',
            'address1' => 'required|string|max:255',
            'address2' => 'required|string|max:255',
            'address3' => 'nullable|string|max:255',
            'contact_method' => 'required|in:email,phone',
            'build_schedule' => 'required|in:within_1_year,after_1_year',
            'has_build_location' => 'required|boolean',
            'selected_plan_id' => 'required|exists:base_plans,id',
            'total_price' => 'required|integer',
        ]);

        $user = ConsultationUser::create($validated);
        return response()->json($user, Response::HTTP_CREATED);
    }
}
