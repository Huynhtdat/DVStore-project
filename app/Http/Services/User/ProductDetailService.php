<?php

namespace App\Http\Services\User;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\ProductReviewRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductDetailService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductReviewService
     */
    private $productReviewService;

    /**
     * @var ProductReviewRepository
     */
    private $productReviewReprository;

    /**
     * ProductService constructor.
     *
     * @param ProductRepository $productRepository
     */

    public function __construct(
        ProductRepository $productRepository,
        ProductReviewService $productReviewService,
        ProductReviewRepository $productReviewRepository,
    ) {
        $this->productRepository = $productRepository;
        $this->productReviewService = $productReviewService;
        $this->productReviewReprository = $productReviewRepository;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // lấy số lượng đã bán
        $productSold = $this->productRepository->getTotalProductSoldById($product->id);
        // lấy màu sản phẩm
        $productColor = DB::table('products_color')
            ->join('colors', 'colors.id', 'products_color.color_id')
            ->select('colors.name as color_name', 'products_color.*')
            ->where('products_color.product_id', $product->id)
            ->whereNull('products_color.deleted_at')
            ->get();
        // lấy kích thước của sản phẩm
        $productsize = DB::table('products_color')
            ->join('products_size', 'products_size.product_color_id', 'products_color.id')
            ->join('sizes', 'sizes.id', 'products_size.size_id')
            ->select('sizes.name as size_name', 'products_size.id as product_size_id', 'products_color.id as product_color_id', 'products_size.quantity')
            ->where('products_color.product_id', $product->id)
            ->whereNull('products_color.deleted_at')
            ->whereNull('products_size.deleted_at')
            ->get();
        $productSizeJson = json_encode($productsize);
        //lấy hình ảnh chi tiết sản phẩm
        $productImage = DB::table('products_image')
            ->where('product_id', $product->id)
            ->whereNull('deleted_at')
            ->get();
        // lấy tổng số lượng sao được đánh giá và thông tin
        $ratingsByProduct = $this->productReviewReprository->getRatingByProduct($product->id);

        // thống kê lượt đánh giá
        $ratingStatistics = [
            "1" => 0,
            "2" => 0,
            "3" => 0,
            "4" => 0,
            "5" => 0,
        ];

        //tính trung bình sao
        $totalRating = 0;
        $totalNumberReview = 0;
        foreach ($ratingsByProduct as $rating) {
            $ratingStatistics[$rating->rating] = $rating->sum;
            $totalRating += $rating->rating * $rating->sum;
            $totalNumberReview += $rating->sum;
        }
        $avgRating = count($ratingsByProduct) > 0 ? $totalRating / $totalNumberReview : 5;

        //kiểm tra xem người dùng có được phép đánh giá sản phẩm không
        $checkReviewProduct = false;
        if ($this->productReviewService->checkProductReview($product)) {
            $checkReviewProduct = true;
        }

        //lấy đánh giá sản phẩm theo sản phẩm
        $productReviews = $this->productReviewReprository->getProductReview($product->id);

        //lấy những sản phẩm liên quan
        $relatedProducts = $this->productRepository->getRelatedProducts($product);

        foreach ($relatedProducts as $key => $relatedProduct) {
            $relatedProducts[$key]->avg_rating = $this->productReviewReprository->avgRatingProduct($relatedProduct->id)->avg_rating ?? 0;
            $relatedProducts[$key]->sum = $this->productRepository->getQuantityBuyProduct($relatedProduct->id);
        }


        //trả dữ liệu cho controller
        return [
            'title' => TextLayoutTitle("payment_method"),
            'productSold' => $productSold,
            'productColor' => $productColor,
            'productSize' => $productsize,
            'productImage' => $productImage,
            'product' => $product,
            'checkReviewProduct' => $checkReviewProduct,
            'ratingStatistics' => $ratingStatistics,
            'avgRating' => $avgRating,
            'productReviews' => $productReviews,
            'relatedProducts' => $relatedProducts,
        ];
    }
}
