<?php

namespace App\Http\Services\Admin;

use App\Helpers\admin\TextSystemConst;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use App\Repository\Eloquent\CategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get list category
        $list = Category::where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();
        $tableCrud = [
            'headers' => [
                [
                    'text' => 'ID',
                    'key' => 'id',
                ],
                [
                    'text' => 'Tên danh mục',
                    'key' => 'name',
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
                'create' => 'admin.category_create',
                'delete' => 'admin.category_delete',
                'edit' => 'admin.category_edit',
            ],
            'list' => $list,
        ];

        return [
            'title' => TextLayoutTitle("category"),
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
            $categoryParent = Category::select('id as value', 'name as text')->where('parent_id', 0)->get()->toArray();
            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Tên thương hiệu',
                    'type' => 'text',
                ],
                [
                    'attribute' => 'parent_id',
                    'label' => 'Thời trang',
                    'type' => 'select',
                    'list' => $categoryParent,
                ],
            ];

            //Rules form
            $rules = [
                'name' => [
                    'required' => true,
                    'minlength' => 1,
                    'maxlength' => 100,
                ],
            ];

            // Messages eror rules
            $messages = [
                'name' => [
                    'required' => "Vui lòng nhập tên thương hiệu",
                    'minlength' => "Tên thương hiệu có tối thiểu 1 ký tự",
                    'maxlength' => "Tên thương hiệu có tối đa 100 ký tự",
                ],
            ];

            return [
                'title' => TextLayoutTitle("create_category"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
            ];
        } catch (Exception) {
            return [];
        }

    }

    /**
     * store the admin in the database.
     * @param App\Http\Requests\Admin\StoreCategoryRequest $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $request->name;
            $this->categoryRepository->create($data);
            return redirect()->route('admin.category_index')->with('success', TextSystemConst::CREATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('admin.category_index')->with('error', TextSystemConst::CREATE_FAILED);
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return array
     */
    public function edit(Category $category)
    {
        try {
            $categoryParent = Category::select('id as value', 'name as text')->where('parent_id', 0)->get()->toArray();

            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Tên thương hiệu',
                    'type' => 'text',
                    'value' => $category->name,
                ],
                [
                    'attribute' => 'parent_id',
                    'label' => 'Thời trang',
                    'type' => 'select',
                    'list' => $categoryParent,
                ],
            ];

            //Rules form
            $rules = [
                'name' => [
                    'required' => true,
                    'minlength' => 1,
                    'maxlength' => 100,
                ],
            ];

            // Messages eror rules
            $messages = [
                'name' => [
                    'required' => "Vui lòng nhập tên thương hiệu",
                    'minlength' => "Tên thương hiệu có tối thiểu 1 ký tự",
                    'maxlength' => "Tên thương hiệu có tối đa 100 ký tự",
                ],
            ];

            return [
                'title' => TextLayoutTitle("edit_category"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
                'category' => $category,
            ];
        } catch (Exception) {
            return [];
        }

    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            $this->categoryRepository->update($category, $data);
            return redirect()->route('admin.category_index')->with('success', TextSystemConst::UPDATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('admin.category_index')->with('error', TextSystemConst::UPDATE_FAILED);
        }
    }

     /**
     * delete the user in the database.
     * @param Illuminate\Http\Request; $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try{
            if($this->categoryRepository->delete($this->categoryRepository->find($request->id))) {
                return response()->json(['status' => 'success', 'message' => TextSystemConst::DELETE_SUCCESS], 200);
            }

            return response()->json(['status' => 'failed', 'message' => TextSystemConst::DELETE_FAILED], 200);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['status' => 'error', 'message' => TextSystemConst::SYSTEM_ERROR], 200);
        }
    }
}
?>
