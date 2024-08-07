<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Helpers\admin\TextSystemConst;
use Brian2694\Toastr\Toastr;
use App\Http\Services\User\WishlistService;

class WishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $wishlistItems = $this->wishlistService->getWishlistProducts();
        return view('user.wishlist', ['wishlistItems' => $wishlistItems]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $this->wishlistService->addToWishlist($productId);

        $wishlistItems = $this->wishlistService->getWishlistProducts();

        return view('user.wishlist', ['wishlistItems' => $wishlistItems])
            ->with('success', 'Product added to wishlist successfully.');
    }


    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $this->wishlistService->removeFromWishlist($productId);

        $wishlistItems = $this->wishlistService->getWishlistProducts();

        return view('user.wishlist', ['wishlistItems' => $wishlistItems])
            ->with('success', 'Product removed from wishlist successfully.');
    }

    public function toggle($productId)
    {
        $data = [
            'product_id' => $productId,
            'user_id' => auth()->id()
        ];
        $wishlist = Wishlist::where(['product_id' => $productId, 'user_id' => auth()->id()])->first();
        if ($wishlist) {
            $wishlist->delete();
            return back()->with('error', 'Đã xóa khỏi danh sách yêu thích');
        } else {
            Wishlist::create($data);
            return back()->with('success', 'Đã thêm vào danh sách yêu thích');
        }
    }
}
