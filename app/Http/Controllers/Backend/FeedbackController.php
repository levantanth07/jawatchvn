<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\StoreRequest;
use App\Http\Requests\Feedback\UpdateRequest;
use App\Services\FeedBackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    protected $feedbackService;

    function __construct(FeedBackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $params['type'] = 'feedback';
        $results = $this->feedbackService->index($params);
        return view('backend.feedback.index', compact('results'));
    }

    public function create()
    {
        return view('backend.feedback.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = Str::slug($data['title'] ?? '');
        $data['image'] = $this->feedbackService->handleUploadedImage(
            $request,
            'title',
            'image'
        );
        $data['type'] = 'feedback';
        if ($this->feedbackService->store($data)) {
            return redirect()->route('backend.feedback.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id)
    {
        $item = $this->feedbackService->detail($id);
        return view('backend.feedback.edit', compact('item'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = Str::slug($data['title'] ?? '');
        $image = $this->feedbackService->handleUploadedImage(
            $request,
            'title',
            'image'
        );
        if (!empty($image)) {
            $data['image'] = $image;
            $item = $this->feedbackService->detail($id);
            if ($item->image != $image) {
                $this->feedbackService->deleteImage('public/'.$item->image);
            }
        }
        if ($this->feedbackService->update($id, $data)) {
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): RedirectResponse
    {
        $item = $this->feedbackService->detail($id);
        $this->feedbackService->deleteImage('public/'.$item->image);
        $item->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
