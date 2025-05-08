<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomValidationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomValidationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CustomValidationRequest $request): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'detail' => '支払いが完了しました。',
        ]);
    }
}
