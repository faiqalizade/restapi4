<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Repository\Product\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductController extends ApiController
{

    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }


    public function index(ProductFilterRequest $request): array
    {
        $data = $this->repository->getProductsByRequest($request, $request->get('not_deleted'));

        return [
            'error' => false,
            'message' => 'Successfully',
            'data' => new ProductCollection($data),
        ];
    }

    public function show($id): array
    {
        $product = $this->repository->getProduct($id);

        $product->load('categories');

        return [
            'error' => false,
            'message' => 'Successfully',
            'data' => new ProductResource($product),
        ];
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $action = $this->repository->create($request);

        return $this->getResponse($action);
    }


    public function update(ProductRequest $request, $id): JsonResponse
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
