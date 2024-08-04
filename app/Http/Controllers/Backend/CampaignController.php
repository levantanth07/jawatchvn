<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\StoreRequest;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected $campaignService;

    function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $request = $params;
        $results = $this->campaignService->index($request);
        return view('backend.campaign.index', compact('results'));
    }

    public function create()
    {
        return view('backend.campaign.create');
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $data['image'] = $this->campaignService->handleUploadedImage(
            $request,
            'name',
            'image'
        );
        if ($this->campaignService->store($data)) {
            return redirect()->route('backend.campaign.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id)
    {
        $item = $this->campaignService->detail($id);
        return view('backend.campaign.edit', compact('item'));
    }

    public function update(UpdateRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $image = $this->campaignService->handleUploadedImage(
            $request,
            'name',
            'image'
        );
        if (!empty($image)) {
            $data['image'] = $image;
            $item = $this->campaignService->detail($id);
            if ($item->image != $image) {
                $this->campaignService->deleteImage('public/'.$item->image);
            }
        }
        if ($this->campaignService->update($id, $data)) {
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $item = $this->campaignService->detail($id);
        $this->campaignService->deleteImage('public/'.$item->image);
        $item->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
