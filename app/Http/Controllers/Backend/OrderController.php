<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 15;
        $request = $params;
        $results = $this->orderService->index($request);
        return view('backend.order.index', compact('results'));
    }

    public function create()
    {
        return view('backend.order.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        if ($this->orderService->store($data)) {
            return redirect()->route('backend.order.index')->with('success', 'Thêm mới thành công!');
        }
        return redirect()->back()->with('error', 'Thêm mới thất bại!');
    }

    public function edit($id)
    {
        $item = $this->orderService->detail($id);
        return view('backend.order.edit', compact('item'));
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        if ($this->orderService->update($id, $request->all())) {
            return response()->json(['code' => 200, 'message' => 'success']);
        }
        return response()->json(['code' => 500, 'message' => 'fail']);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back()->with('error', 'Không được thực hiện thao tác này!');
        if ($this->orderService->delete($id)) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        }
        return redirect()->back()->with('error', 'Xóa thất bại!');
    }
}
