<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\StoreRequest;
use App\Http\Requests\Config\UpdateRequest;
use App\Services\ConfigService;
use App\Services\FeedBackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    protected $configService;

    function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $request = $params;
        $results = $this->configService->index($request);
        return view('backend.config.index', compact('results'));
    }

    public function create()
    {
        return view('backend.config.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        if (!$this->configService->newQuery()->first()) {
            $data = $request->all();
            unset($data['_token']);
            $data['logo'] = $this->configService->handleUploadedImage(
                $request,
                'title_config',
                'logo'
            );
            unset($data['title_config']);
            if ($this->configService->store($data)) {
                return redirect()->route('backend.config.index')->with('success', 'Thêm mới thành công!');
            }
            return redirect()->back()->with('error', 'Thêm mới thất bại!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại! Hiện đã có config!');
    }

    public function edit($id)
    {
        $config = $this->configService->detail($id);
        return view('backend.config.edit', compact('config'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $image = $this->configService->handleUploadedImage(
            $request,
            'title_config',
            'logo'
        );
        if (!empty($image)) {
            $data['logo'] = $image;
            $item = $this->configService->detail($id);
            if ($item->logo != $image) {
                $this->configService->deleteImage('public/'.$item->logo);
            }
        }
        unset($data['title_config']);
        if ($this->configService->update($id, $data)) {
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): RedirectResponse
    {
        $item = $this->configService->detail($id);
        $this->configService->deleteImage('public/'.$item->image);
        $item->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
