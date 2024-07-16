<?php

namespace App\Http\Services\User;

use App\Helpers\admin\TextSystemConst;
use App\Repository\Eloquent\ProductSizeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart as CartModel;
use App\Models\Product;
use App\Models\Color;
use App\Models\ProductSize;
use App\Repository\Eloquent\CartRepository;
use Illuminate\Support\Facades\Redirect;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartService
{
    /**
     * @var ProductSizeRepository
     */
    private $productSizeRepository;

    /**
     * @var CartRepository
     */
    private $cartRepository;


    /**
     * CartService constructor.
     *
     * @param ProductSizeRepository $categoryRepository
     */
    public function __construct(ProductSizeRepository $productSizeRepository, CartRepository $cartRepository)
    {
        $this->productSizeRepository = $productSizeRepository;
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        // $userId = Auth::id();

        // $cartProducts = $this->cartRepository->getCart();


        return ['carts' => Cart::getContent()];
    }

    //thêm sản phẩm vào giỏ hàng
    public function store(Request $request)
    {
        // lấy thông tin sản phẩm
        $product = $this->productSizeRepository->getProductSize($request->id);
        // kiểm tra xem sản phẩm được thêm vào giỏ hàng có tồn tại không
        if (!$product) {
            return redirect()->route('user.home');
        }
        // lấy toàn bộ sản phẩm có trong giỏ hàng
        $carts = Cart::getContent()->toArray();

        //Nếu giỏ hàng không rỗng và kiểm tra xem sản phẩm được thêm có tồn tại trong giỏ hàng chưa
        if (!empty($carts) && array_key_exists($request->id, $carts)) {
            // khi thêm vào nếu số lượng vượt quá trong kho thì sẽ báo lỗi
            if ($carts[$request->id]['quantity'] + $request->quantity > $product->products_size_quantity) {
                return back()->with('error', TextSystemConst::ADD_CART_ERROR_QUANTITY);
            }
        }

        //nếu người dùng thêm sản phẩm lớn hơn với số lượng kho thì báo lỗi
        if ($request->quantity > $product->products_size_quantity) {
            return back()->with('error', TextSystemConst::ADD_CART_ERROR_QUANTITY);
        }
        // thêm sản phẩm vào giỏ hàng hoặc cập số lượng nếu như sản phảm đó đã tồn trong giỏ hàng
        Cart::add([
            'id' => $request->id,
            'name' => $product->product_name,
            'price' => $product->product_price_sell,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $product->product_img,
                'size' => $product->size_name,
                'color' => $product->color_name,
            )
        ]);

        // chuyển hướng người dùng đến trang giỏ hàng
        return redirect()->route('cart.index');

        // lấy thông tin sản phẩm
        // $product = $this->productSizeRepository->getProductSize($request->id);
        // if (! $product) {
        //     return redirect()->route('user.home');
        // }

        // $userId = Auth::id();
        // $productId = $request->input('product_id');
        // $existingCartItem = Cart::where('user_id', $userId)
        //     ->where('product_id', $productId)
        //     ->where('product_color_id', $request->product_color_id)
        //     ->where('product_size_id', $request->product_size_id)
        //     ->first();

        //     if ($existingCartItem) {
        //         // Update quantity if the item already exists in the cart
        //         $existingCartItem->update([
        //             'quantity' => $existingCartItem->quantity + $request->quantity,
        //         ]);}
        //     else {
        //         Cart::create([
        //             'user_id' => $userId,
        //             'product_id' => $productId,
        //             'product_color_id' => $request->product_color_id,
        //             'product_size_id' => $request->product_size_id,
        //             'quantity' => $request->quantity,
        //         ]);
        //         return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
        //     }

    }



    // cập nhật giỏ hàng
    public function update(Request $request)
    {
        $request->validate([
            'quantity.*' => 'required|integer|min:1|max:100',
        ]);

        foreach ($request->id as $index => $id) {
            $quantity = $request->quantity[$index];
            $product = $this->productSizeRepository->getProductSize($id);

            if ($quantity > $product->products_size_quantity) {
                return back()->with('error', TextSystemConst::ADD_CART_ERROR_QUANTITY);
            }

            Cart::update(
                $id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quantity
                    ],
                ]
            );
        }

        return redirect()->route('cart.index');

        // Lấy danh sách các sản phẩm và số lượng từ request
        // $quantities = $request->input('quantities', []);
        // $productIds = $request->input('ids', []);

        // // Lặp qua từng sản phẩm để kiểm tra và cập nhật
        // foreach ($quantities as $productId => $quantity) {
        //     $product = $this->productSizeRepository->getProductSize($productId);

        //     // Nếu số lượng yêu cầu lớn hơn số lượng có sẵn trong kho, trả về lỗi
        //     if ($quantity > $product->products_size_quantity) {
        //         return back()->with('error', TextSystemConst::ADD_CART_ERROR_QUANTITY);
        //     }

        //     // Cập nhật số lượng trong bảng carts
        //     $userId = Auth::id();
        //     Cart::where('user_id', $userId)
        //         ->where('product_id', $productId)
        //         ->update(['quantity' => $quantity]);
        // }

        // return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }


    public function delete($id)
    {
        Cart::remove($id);

        return redirect()->route('cart.index');

        // $userId = Auth::id();

        // // Find the cart item for the authenticated user
        // $cartItem = Cart::where('id', $id)
        //     ->where('user_id', $userId)
        //     ->first();

        // if ($cartItem) {
        //     $cartItem->delete();
        //     return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully.');
        // } else {
        //     return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
        // }
    }

    public function clearAllCart()
    {
        return redirect()->route('cart.index');
    }
}
