<?php

namespace App\Http\Services\User;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\ProductReviewRepository;

class HomeService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductReviewRepository
     */
    private $productReviewRepository;

    /**
     * ProductService constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository, ProductReviewRepository $productReviewRepository)
    {
        $this->productRepository = $productRepository;
        $this->productReviewRepository = $productReviewRepository;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lấy sản phẩm bán chạy nhất
        $sellingProducts = $this->productRepository->getBestSellingProduct();
        foreach($sellingProducts as $key => $sellingProduct) {
            $sellingProducts[$key]->avg_rating = $this->productReviewRepository->avgRatingProduct($sellingProduct->id)->avg_rating ?? 0;
        }

        // lấy sản phẩm mới nhất
        $newProducts = $this->productRepository->getNewProducts();
        foreach($newProducts as $key => $newProduct) {
            $newProducts[$key]->avg_rating = $this->productReviewRepository->avgRatingProduct($newProduct->id)->avg_rating ?? 0;
            $newProducts[$key]->sum = $this->productRepository->getQuantityBuyProduct($newProduct->id);
        }

        // lấy thông tin sản phẩm

        //lấy danh mục
        $categories = Category::where('parent_id', 0)->with('children')->get();
        // $category = Category::where('parent_id', )

        //lấy brand tag
        $brands = Brand::all();
        // trả dữ liệu cho controller
        return [
            'title' => TextLayoutTitle("payment_method"),
            'sellingProducts' => $sellingProducts,
            'newProducts' => $newProducts,
            'categories' => $categories,
            'brands' => $brands,

        ];
    }
}
?>
