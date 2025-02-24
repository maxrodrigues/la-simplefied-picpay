<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Client;
use App\Services\Auth\RegisterService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\{JsonResponse};
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
        //
    }
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->registerService->register($data);

            return new JsonResponse('created', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
