<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryService;
    function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $request = $params;
        $results = $this->categoryService->index($request);
        return view('backend.category.index', compact('results'));
    }

    public function create()
    {
        $parents = $this->categoryService->getCategoryParent();
        return view('backend.category.create', compact('parents'));
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        if ($this->categoryService->store($data)) {
            return redirect()->route('backend.category.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id)
    {
        $item = $this->categoryService->detail($id);
        $params['id'] = $id;
        $parents = $this->categoryService->getCategoryParent($params);
        return view('backend.category.edit', compact('item', 'parents'));
    }

    public function update(UpdateRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($this->categoryService->update($id, $request->all())) {
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        if ($this->categoryService->delete($id)) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        }
        return redirect()->back()->with('error', 'Xóa thất bại!');
    }
}
