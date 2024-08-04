<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $request = $params;
        $results = $this->postService->index($request);
        $postTypes = $this->postService->getPostType();
        return view('backend.post.index', compact('results', 'postTypes'));
    }

    public function create()
    {
        $postTypes = $this->postService->getPostType();
        return view('backend.post.create', compact('postTypes'));
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        if ($this->postService->store($data)) {
            return redirect()->route('backend.post.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id)
    {
        $item = $this->postService->detail($id);
        $postTypes = $this->postService->getPostType();
        return view('backend.post.edit', compact('item', 'postTypes'));
    }

    public function update(UpdateRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($this->postService->update($id, $request->all())) {
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        if ($this->postService->delete($id)) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        }
        return redirect()->back()->with('error', 'Xóa thất bại!');
    }
}
