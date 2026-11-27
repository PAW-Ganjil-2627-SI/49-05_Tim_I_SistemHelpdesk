<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartemenRequest;
use App\Http\Resources\DepartemenResource;
use App\Models\Departemen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartemenApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $departemen = Departemen::withCount('asetPc')->orderBy('id')->get();

        return DepartemenResource::collection($departemen);
    }

    public function show(Departemen $departemen): DepartemenResource
    {
        $departemen->loadCount('asetPc');

        return new DepartemenResource($departemen);
    }

    public function store(DepartemenRequest $request): JsonResponse
    {
        $departemen = Departemen::create($request->validated());

        return (new DepartemenResource($departemen))
            ->response()
            ->setStatusCode(201);
    }

    public function update(DepartemenRequest $request, Departemen $departemen): DepartemenResource
    {
        $departemen->update($request->validated());

        return new DepartemenResource($departemen);
    }

    public function destroy(Departemen $departemen): JsonResponse
    {
        $jumlahAset = $departemen->asetPc()->count();

        if ($jumlahAset > 0) {
            return response()->json([
                'message' => "Departemen \"{$departemen->nama}\" tidak dapat dihapus karena masih memiliki {$jumlahAset} aset PC.",
            ], 422);
        }

        $departemen->delete();

        return response()->json([
            'message' => 'Departemen berhasil dihapus.',
        ]);
    }
}
