<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryFilterRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Repository\Category\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CategoryController extends ApiController
{

    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(CategoryFilterRequest $request): array
    {
        $categories = $this->repository->getCategoriesByRequest($request, $request->get('not_deleted'));

        return [
            'error' => false,
            'message' => 'Successfully',
            'data' => new CategoryCollection($categories),
        ];

    }

    public function show($id): array
    {
        $category = $this->repository->getCategory($id);

        return [
            'error' => false,
            'message' => 'Successfully',
            'data' => new CategoryResource($category),
        ];
    }


    public function store(CategoryRequest $request): JsonResponse
    {
        $action = $this->repository->create($request);

        return $this->getResponse($action);
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $action = $this->repository->update($request, $id);

        return $this->getResponse($action);
    }


    public function destroy($id): JsonResponse
    {
        $action = $this->repository->delete($id);
        return $this->getResponse($action);
    }
}
