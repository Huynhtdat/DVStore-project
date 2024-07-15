<?php

namespace App\Http\Services\Admin;

use App\Helpers\admin\TextSystemConst;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Repository\Eloquent\BrandRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\ColorRepository;
use App\Repository\Eloquent\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Size;
use App\Http\Requests\Admin\StoreProductColorRequest;
use App\Http\Requests\Admin\StoreProductImageRequest;
use App\Http\Requests\Admin\StoreProductSizeRequest;
use App\Http\Requests\Admin\UpdateProductColorRequest;
use App\Http\Requests\Admin\UpdateProductImageRequest;
use App\Http\Requests\Admin\UpdateProductSizeRequest;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Session;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var BrandRepository
     */
    private $brandRepository;

    /**
     * @var ColorRepository
     */
    private $colorRepository;

    /**
     * ProductService constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository,
        ColorRepository $colorRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        // $this->colorRepository = $colorRepository;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->productRepository->all();

        $tableCrud = [
            'headers' => [
                [
                    'text' => 'ID',
                    'key' => 'id',
                ],
                [
                    'text' => 'Tên Sản phẩm',
                    'key' => 'name',
                ],
                [
                    'text' => 'Hình ảnh',
                    'key' => 'img',
                    'img' => [
                        'url' => 'asset/client/images/products/small/',
                        'style' => 'width: 100px;'
                    ],
                ],
                [
                    'text' => 'Danh mục',
                    'key' => 'category.name',
                ],
                [
                    'text' => 'Giá',
                    'key' => 'price_sell',
                    'format' => true,
                ],
            ],
            'actions' => [
                'text'          => "Chức năng",
                'create'        => true,
                'createExcel'   => false,
                'edit'          => true,
                'deleteAll'     => true,
                'delete'        => true,
                'viewDetail'    => false,
            ],
            'routes' => [
                'create' => 'admin.products_create',
                'delete' => 'admin.products_delete',
                'edit' => 'admin.products_edit',
            ],
            'list' => $list,
        ];

        return [
            'title' => TextLayoutTitle("product"),
            'tableCrud' => $tableCrud,
        ];
    }

    /**
     * Show the form for creating a new user.
     *
     * @return array
     */
    public function create()
    {
        try {
            $categoriesParent = category_header();
            $brands = $this->brandRepository->all();
            //Rules form
            $rules = [
                'name' => [
                    'required' => true,
                ],
                'price_import' => [
                    'required' => true,
                ],
                'price_sell' => [
                    'required' => true,
                ],
                'brand' => [
                    'required' => true,
                ],
                'origin' => [
                    'required' => true,
                ],
                'category_id' => [
                    'required' => true,
                ],
                'summernote' => [
                    'required' => true,
                ],
                'file-input' => [
                    'required' => true,
                ],
            ];

            // Messages eror rules
            $messages = [
                'name' => [
                    'required' => "Vui lòng nhập tên sản phẩm",
                ],
                'price_import' => [
                    'required' => "Vui lòng nhập giá nhập sản phẩm",
                ],
                'price_sell' => [
                    'required' => "Vui lòng nhập giá bán sản phẩm",
                ],
                'brand' => [
                    'required' => "Vui lòng chọn thương hiệu cho sản phẩm",
                ],
                'category_id' => [
                    'required' => "Vui lòng chọn danh mục cho sản phẩm",
                ],
                'summernote' => [
                    'required' => "Vui lòng nhập mô tả sản phẩm",
                ],
                'file-input' => [
                    'required' => "Vui lòng thêm ảnh đại diện cho sản phẩm",
                ],
            ];
            return [
                'title' => TextLayoutTitle("create_product"),
                'categoriesParent' => $categoriesParent,
                'messages' => $messages,
                'rules' => $rules,
                'brands' => $brands,
            ];
        } catch (Exception) {
            return [];
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();
            $imageName = time().'.'.request()->img->getClientOriginalExtension();

            request()->img->move(public_path('asset/client/images/products/small'), $imageName);
            $data['img'] = $imageName;
            $product = $this->productRepository->create($data);
            return redirect()->route('admin.products_color', $product->id)->with('success', TextSystemConst::CREATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('admin.product_index')->with('error', TextSystemConst::CREATE_FAILED);
        }
    }

    public function edit(Product $product)
    {
        $categoriesParent = category_header();
        $brands = $this->brandRepository->all();
        //Rules form
        $rules = [
            'name' => [
                'required' => true,
            ],
            'price_import' => [
                'required' => true,
            ],
            'price_sell' => [
                'required' => true,
            ],
            'branch' => [
                'required' => true,
            ],
            'origin' => [
                'required' => true,
            ],
            'category_id' => [
                'required' => true,
            ],
            'summernote' => [
                'required' => true,
            ],
            'file-input' => [
                'required' => true,
            ],
        ];

        // Messages eror rules
        $messages = [
            'name' => [
                'required' => "Vui lòng nhập tên sản phẩm",
            ],
            'price_import' => [
                'required' => "Vui lòng nhập giá nhập của sản phẩm",
            ],
            'price_sell' => [
                'required' => "Vui lòng nhập giá bán của sản phẩm",
            ],
            'brand' => [
                'required' => "Vui lòng chọn thương hiệu sản phẩm",
            ],
            'category_id' => [
                'required' => "Vui lòng chọn danh mục sản phẩm",
            ],
            'summernote' => [
                'required' => "Vui lòng nhập mô tả sản phẩm",
            ],
            'file-input' => [
                'required' => "Vui lòng thêm hình ảnh đại diện cho sản phẩm",
            ],
        ];
        return [
            'title' => TextLayoutTitle("edit_product"),
            'categoriesParent' => $categoriesParent,
            'messages' => $messages,
            'rules' => $rules,
            'brands' => $brands,
            'product' => $product,
            'routeSize' => route('admin.products_size', $product->id),
            'routeColor' => route('admin.products_color', $product->id),
            'routeImage' => route('admin.products_image', $product->id),
        ];
    }

    public function update(UpdateProductRequest $request ,Product $product)
    {
        try {
            $data = $request->validated();
            if ($request->img) {
                $imageName = time().'.'.request()->img->getClientOriginalExtension();
                request()->img->move(public_path('asset/client/images/products/small'), $imageName);
                $data['img'] = $imageName;
            }
            $product->update($data);
            return redirect()->route('admin.products_edit', $product->id)->with('success', TextSystemConst::UPDATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('admin.products_index')->with('error', TextSystemConst::UPDATE_FAILED);
        }
    }

    public function delete(Request $request)
    {
        try{
            if($this->productRepository->delete($this->productRepository->find($request->id))) {
                return response()->json(['status' => 'success', 'message' => TextSystemConst::DELETE_SUCCESS], 200);
            }

            return response()->json(['status' => 'failed', 'message' => TextSystemConst::DELETE_FAILED], 200);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['status' => 'error', 'message' => TextSystemConst::SYSTEM_ERROR], 200);
        }
    }

    public function getCategoryByParent(Request $request)
    {
        try {
            return $this->categoryRepository->where(['parent_id' => $request->parent_id]);
        } catch (Exception) {
            return null;
        }
    }

    public function createColor(Product $product)
    {
        $colors = Color::whereNotIn('id', function($query) use($product) {
            $query->select('color_id')
                  ->from('products_color')
                  ->where('product_id', '=', $product->id)
                  ->whereNull('deleted_at');
        })
        ->get();
        $productColors = ProductColor::where('product_id', $product->id)->get();

        return [
            'title' => 'Màu của ' . $product->name,
            'colors' => $colors,
            'product' => $product,
            'productColors' => $productColors,
            'routeSize' => route('admin.products_size', $product->id),
            'routeProduct' => route('admin.products_edit', $product->id),
            'routeImage' => route('admin.products_image', $product->id),
        ];
    }
    public function storeColor(StoreProductColorRequest $request, Product $product)
    {
        try {
            $colorId = $request->color_id;

            $checkColorExist = $this->productRepository->checkProductColorExist($product->id, $colorId);
            if ($checkColorExist > 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Mày này đã tồn tại'
                ], 200);
            }
            //thêm màu vào databse
            ProductColor::create([
                // 'img' => $imageName,
                'color_id' => $colorId,
                'product_id' => $product->id
            ]);
            Session::flash('success', 'Thêm màu thành công');
            // trả về kết quả
            return response()->json([
                'status' => true,
                'route' => route('admin.products_color', $product->id),
            ], 200);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
            ], 200);
        }
    }

    //lấy thông tin màu sản phẩm để chỉnh sửa
    public function editColor(ProductColor $productColor)
    {
        $colors = Color::whereNotIn('id', function($query) use($productColor) {
            $query->select('color_id')
                  ->from('products_color')
                  ->where('product_id', '=', $productColor->product_id)
                  ->where('color_id', '!=', $productColor->color_id)
                  ->whereNull('deleted_at');
        })
        ->get();
        // trả về kết quả
        return response()->json([
            'productColor' => $productColor,
            'colors' => $colors
        ], 200);
    }

    public function updateColor(UpdateProductColorRequest $request, ProductColor $productColor)
    {
        try {
            $data = $request->validated();
            if ($request->img) {
                $imageName = time().'.'.request()->img->getClientOriginalExtension();
                request()->img->move(public_path('asset/client/images/products/small'), $imageName);
                $data['img'] = $imageName;
            }
            $productColor->update($data);
            Session::flash('success', 'Chỉnh sửa màu sắc thành công');
            return response()->json([
                'status' => true,
                'route' => route('admin.products_color', $productColor->product_id),
            ], 200);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lỏng thử lại sau'
            ], 200);
        }
    }

    public function deleteColor(ProductColor $productColor)
    {
        if ($productColor->delete()) {
            $data = [
                'status' => true,
                'message' => 'Xóa màu sắc thành công'
            ];
        } else {
            $data = [
                'status' => false,
                'message' => 'Xóa thất bại, vui lòng thử lại sau'
            ];
        }
        return response()->json($data, 200);
    }

    public function createSize(Product $product)
    {
        $productSizes = ProductSize::select('products_size.id as id', 'sizes.name as size_name', 'colors.name as color_name', 'products_size.quantity as quanity')
        ->join('products_color', 'products_color.id', '=', 'products_size.product_color_id')
        ->join('sizes', 'sizes.id', '=', 'products_size.size_id')
        ->join('colors', 'colors.id', '=', 'products_color.color_id')
        ->where('products_color.product_id', '=', $product->id)
        ->whereNull('products_color.deleted_at')
        ->orderByDesc('id')
        ->get();

        $productColors = ProductColor::where('product_id', $product->id)->get();

        return [
            'title' => 'Kích thước của ' . $product->name,
            'routeColor' => route('admin.products_color', $product->id),
            'routeProduct' => route('admin.products_edit', $product->id),
            'routeImage' => route('admin.products_image', $product->id),
            'productSizes' => $productSizes,
            'productColors' => $productColors,
            'product' => $product,
        ];
    }

    public function getSizeByProductColor(Request $request)
    {
        $sizes = Size::whereNotIn('sizes.id', function ($query) use ($request) {
            $query->select('size_id')
                  ->from('products_size')
                  ->where('product_color_id', '=', $request->product_color_id)
                  ->whereNull('deleted_at')
                  ;
        })->get();

        return response()->json($sizes, 200);
    }

    public function getSizeByProductColorEdit(ProductSize $productSize)
    {
        $data = [
            'quantity' => $productSize->quantity,
            'size' => $productSize->size->name,
        ];
        return response()->json($data, 200);
    }

    public function storeSizeProduct(StoreProductSizeRequest $request, Product $product)
    {
        DB::table('products_size')->insert([
            'size_id' => $request->size_id,
            'product_color_id' => $request->product_color_id,
            'quantity' => $request->quantity,
        ]);
        Session::flash('success', 'Thêm kích thước sản phẩm thành công ');

        return response()->json([
            'status' => true,
            'route' => route('admin.products_size', $product->id),
        ], 200);
    }

    public function editSizeProduct(ProductSize $productSize, Product $product)
    {
        $colors = DB::table('products_color')
        ->join('colors', 'colors.id', '=', 'products_color.color_id')
        ->select('colors.name as color_name', 'products_color.*')
        ->where('products_color.product_id', '=', $product->id)
        ->whereNull('products_color.deleted_at')
        ->whereNull('colors.deleted_at')
        ->get();
        $data = [
            'colors' => $colors,
            'productColor' => $productSize->productColor->color_id,
        ];

        return response()->json($data);
    }

    public function updateSizeProduct(ProductSize $productSize, Product $product, UpdateProductSizeRequest $request)
    {
        try {
            $data = $request->validated();
            $productSize->update($data);
            Session::flash('success', 'Chỉnh sửa kích thước sản phẩm thành công');
            return response()->json([
                'status' => true,
                'route' => route('admin.products_size', $product->id),
            ], 200);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
            ], 200);
        }
    }

    // xóa kích thước của sản phẩm
    public function deleteSizeProduct(ProductSize $productSize)
    {
        if ($productSize->delete()) {
            $data = [
                'status' => true,
                'message' => 'Xóa kích thước sản phẩm thành công'
            ];
        } else {
            $data = [
                'status' => false,
                'message' => 'Xóa kích thước sản phẩm thất bại, vui lòng thử lại sau'
            ];
        }
        return response()->json($data, 200);
    }


    public function createImage(Product $product)
    {

        $productImages = ProductImage::where('product_id', $product->id)->whereNull('deleted_at')->get();

        return [
            'title' => 'Hình ảnh của ' . $product->name,
            'product' => $product,
            'productImages' => $productImages,
            'routeColor' => route('admin.products_color', $product->id),
            'routeSize' => route('admin.products_size', $product->id),
            'routeProduct' => route('admin.products_edit', $product->id),
        ];
    }
    public function storeImage(StoreProductImageRequest $request, Product $product)
    {
        try {
            $imageName = time().'.'.request()->img->getClientOriginalExtension();
            request()->img->move(public_path('asset/client/images/products/small'), $imageName);

            //thêm hình ảnh vào databse
            ProductImage::create([
                'img' => $imageName,
                'product_id' => $product->id
            ]);
            Session::flash('success', 'Thêm hình ảnh chi tiết sản phẩm thành công');
            // trả về kết quả
            return response()->json([
                'status' => true,
                'route' => route('admin.products_image', $product->id),
            ], 200);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
            ], 200);
        }
    }

    //lấy thông tin màu sản phẩm để chỉnh sửa
    public function editImage(ProductImage $productImage)
    {
        return response()->json([
            'productImage' => $productImage,
        ], 200);
    }

    public function updateImage(UpdateProductImageRequest $request, ProductImage $productImage)
    {
        try {
            $data = $request->validated();
            if ($request->img) {
                $imageName = time().'.'.request()->img->getClientOriginalExtension();
                request()->img->move(public_path('asset/client/images/products/small'), $imageName);
                $data['img'] = $imageName;
            }
            $productImage->update($data);
            Session::flash('success', 'Chỉnh sauwr hình ảnh chi tiết sản phẩm thành công');
            return response()->json([
                'status' => true,
                'route' => route('admin.products_image', $productImage->product_id),
            ], 200);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
            ], 200);
        }
    }

    public function deleteImage(ProductImage $productImage)
    {
        if ($productImage->delete()) {
            $data = [
                'status' => true,
                'message' => 'Xóa hình ảnh chi tiết sản phẩm thành công'
            ];
        } else {
            $data = [
                'status' => false,
                'message' => 'Xóa hỉnh ảnh chi tiết sản phẩm thất bại, vui lòng thửu lại saus'
            ];
        }
        return response()->json($data, 200);
    }
}
?>
