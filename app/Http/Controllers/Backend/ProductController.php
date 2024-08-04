<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Services\CampaignService;
use App\Services\CategoryService;
use App\Services\ImageDetailService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $campaignService;
    protected $imageDetailService;

    function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        CampaignService $campaignService,
        ImageDetailService $imageDetailService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->campaignService = $campaignService;
        $this->imageDetailService = $imageDetailService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 10;
        $request = $params;
        $results = $this->productService->index($request);
        return view('backend.product.index', compact('results'));
    }

    public function create()
    {
        $categories = $this->categoryService->getCategoryParent(['is_parent' => true]);
        $campaigns = $this->campaignService->index(['status' => 1]);
        $format[] = [
            'id' => 0,
            'name' => 'Lựa chọn chiến dịch',
        ];
        foreach ($campaigns as $value) {
            $type_name = $value->type == 1 ? 'Menu' : 'Body';
            $format[] = [
                'id' => $value->id,
                'name' => $value->name .'(' . $type_name . ')',
            ];
        }
        $campaigns = $format;
        return view('backend.product.create', compact('categories', 'campaigns'));
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $data['image'] = $this->productService->handleUploadedImage(
            $request,
            'name',
            'image'
        );
        if ($store = $this->productService->store($data)) {
            $images = $this->imageDetailService->handleUploadedMultiImage($request, '', 'filenames');
            $arrayStore = [];
            if (!empty($images)) {
                foreach ($images as $image) {
                    $time = date('Y-m-d H:i:s');
                    $arrayStore[] = [
                        'product_id' => $store->id,
                        'image' => $image,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                }
                if (!empty($arrayStore)) {
                    $this->imageDetailService->storeMany($arrayStore);
                }
            }
            return redirect()->route('backend.product.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id)
    {
        $item = $this->productService->detailWithRelation($id, ['productDetail']);
        $categories = $this->categoryService->getCategoryParent(['is_parent' => true]);
        $campaigns = $this->campaignService->index(['status' => 1]);
        $format[] = [
            'id' => 0,
            'name' => 'Lựa chọn chiến dịch',
        ];
        foreach ($campaigns as $value) {
            $type_name = $value->type == 1 ? 'Menu' : 'Body';
            $format[] = [
                'id' => $value->id,
                'name' => $value->name .'(' . $type_name . ')',
            ];
        }
        $campaigns = $format;
        return view('backend.product.edit', compact('item', 'categories', 'campaigns'));
    }

    /**
     * @throws ValidationException
     */
    public function update(UpdateRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $image = $this->productService->handleUploadedImage(
            $request,
            'name',
            'image'
        );
        if (!empty($image)) {
            $data['image'] = $image;
            $item = $this->productService->detail($id);
            if ($item->image != $image) {
                $this->productService->deleteImage('public/'.$item->image);
            }
        }
        if ($this->productService->update($id, $data)) {
            $images = $this->imageDetailService->handleUploadedMultiImage($request, '', 'filenames');
            $arrayStore = [];
            if (!empty($images)) {
                foreach ($images as $image) {
                    $time = date('Y-m-d H:i:s');
                    $arrayStore[] = [
                        'product_id' => $id,
                        'image' => $image,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                }
                if (!empty($arrayStore)) {
                    $this->imageDetailService->storeMany($arrayStore);
                }
            }
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $item = $this->productService->detail($id);
        $this->productService->deleteImage('public/'.$item->image);
        $item->delete();
        $details = $this->imageDetailService->newQuery()->where('product_id', $id)->get();
        foreach ($details as $detail) {
            $this->imageDetailService->deleteImage('public/'.$detail->image);
            $detail->delete();
        }
        return redirect()->back()->with('success', 'Xóa thành công!');
    }

    public function destroyProductDetailImage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!empty($request->id)) {
            $item = $this->imageDetailService->detail($request->id);
            $this->imageDetailService->deleteImage('public/'.$item->image);
            $item->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Xóa thành công!'
        ]);
    }
}
