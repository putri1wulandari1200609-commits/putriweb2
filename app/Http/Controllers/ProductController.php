<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index() {
        return response()->json($this->productService->getAll());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);

        try {
            $product = $this->productService->store($validated);
            return response()->json(['message' => 'Berhasil!', 'data' => $product], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal', 'error' => $e->getMessage()], 500);
        }
    }
    
}