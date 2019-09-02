<?php

namespace App\Http\Controllers;

use App\Services\StickerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StickerController extends Controller
{
    /**
     * @param StickerService $stickerService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(StickerService $stickerService)
    {
        return response()->json(
            $stickerService->getStickerList()
        );
    }

    public function update(Request $request, StickerService $stickerService) {
        Log::info($request->all());
        return response()->json(
            $stickerService->updateSticker($request->input('type'), $request->input('name'))
        );
    }
}
