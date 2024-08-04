<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;
    function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $request = $params;
        $results = $this->customerService->index($request);
        return view('backend.customer.index', compact('results'));
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        if ($this->customerService->store($data)) {
            return redirect()->route('backend.customer.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back()->with('error', 'Không được thực hiện thao tác này!');
        $item = $this->customerService->detail($id);
        return view('backend.category.edit', compact('item'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($this->customerService->update($id, $request->all())) {
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back()->with('error', 'Không được thực hiện thao tác này!');
        if ($this->customerService->delete($id)) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        }
        return redirect()->back()->with('error', 'Xóa thất bại!');
    }
}
