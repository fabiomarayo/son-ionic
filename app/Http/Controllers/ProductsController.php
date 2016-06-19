<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProductRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Http\Requests;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->paginate();
        return view('admin.products.index', compact(['products']));
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists();

        return view('admin.products.create', compact(['categories']));
    }

    public function store(AdminProductRequest $request)
    {
        $data = $request->all();
        $this->productRepository->create($data);
        return redirect()->route('admin.products');
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->lists();

        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(AdminProductRequest $request, $id)
    {
        $data = $request->all();
        $this->productRepository->update($data, $id);
        return redirect()->route('admin.products');
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect()->route('admin.products');
    }
}
