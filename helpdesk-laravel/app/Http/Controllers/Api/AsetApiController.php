<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsetPcRequest;
use App\Http\Resources\AsetPcResource;
use App\Models\AsetPc;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AsetApiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $departemenId = $request->filled('departemen_id')
            ? (int) $request->input('departemen_id')
            : null;

        $aset = AsetPc::with('departemen')
            ->filter($departemenId, $request->input('q'))
            ->orderBy('id')
            ->get();

        return AsetPcResource::collection($aset);
    }

    public function show(AsetPc $aset): AsetPcResource
    {
        $aset->load('departemen');

        return new AsetPcResource($aset);
    }

    public function store(AsetPcRequest $request): JsonResponse
    {
        $aset = AsetPc::create($request->validated());
        $aset->load('departemen');

        return (new AsetPcResource($aset))
            ->response()
            ->setStatusCode(201);
    }

    public function update(AsetPcRequest $request, AsetPc $aset): AsetPcResource
    {
        $aset->update($request->validated());
        $aset->load('departemen');

        return new AsetPcResource($aset);
    }

    public function destroy(AsetPc $aset): JsonResponse
    {
        $aset->delete();

        return response()->json([
            'message' => 'Aset PC berhasil dihapus.',
        ]);
    }
}
