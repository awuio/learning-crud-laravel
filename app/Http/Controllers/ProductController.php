<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::getCachedAll();

        // Build the base query with eager-loaded category to avoid N+1
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Clone the builder before running aggregates so each call
        // gets a clean query without carrying over previous state.
        // withoutEagerLoads() prevents the cloned with('category') from firing
        // an unnecessary relationship query on a pure-aggregate result.
        $stats = (clone $query)->withoutEagerLoads()->selectRaw('count(*) as total_count, sum(quantity) as total_qty, sum(price * quantity) as total_value')->first();

        $totalProductsCount = $stats->total_count;
        $totalQuantitySum = $stats->total_qty;
        $totalStockValueSum = $stats->total_value;

        // Paginate and preserve the query string (e.g. category_id) in pagination links
        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact(
            'products',
            'categories',
            'totalProductsCount',
            'totalQuantitySum',
            'totalStockValueSum'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::getCachedAll();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $this->productService->createProduct($request->validated(), $request->file('image'));

            return redirect()->route('products.index')->with('success', __('messages.product_created'));
        } catch (\Exception $e) {
            Log::error('Product Creation Failed: '.$e->getMessage(), [
                'request_data' => $request->except('image'),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.product_error'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('shop.show', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::getCachedAll();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->productService->updateProduct($product, $request->validated(), $request->file('image'));

            return redirect()->route('products.index')->with('success', __('messages.product_updated'));
        } catch (\Exception $e) {
            Log::error('Product Update Failed: '.$e->getMessage(), [
                'product_id' => $product->id,
                'request_data' => $request->except('image'),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.product_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // For soft deletes, we DO NOT delete the image from disk.
        // It should remain accessible if the product is restored or for reporting purposes.
        $product->delete();

        return redirect()->route('products.index')->with('success', __('messages.product_deleted'));
    }
}
