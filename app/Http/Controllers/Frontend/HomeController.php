<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\FeedBack;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\Product;
use App\Services\CampaignService;
use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\OrderDetailService;
use App\Services\PostService;
use App\Services\ProductService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;
use App\Mail\SentEmailShoppingCart;
use App\Mail\SentEmailContact;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected $productService;
    protected $postService;
    protected $customerService;
    protected $campaignService;
    protected $categoryService;

    function __construct(
        ProductService $productService,
        PostService $postService,
        CustomerService $customerService,
        CampaignService $campaignService,
        CategoryService $categoryService
    )
    {
        $this->productService = $productService;
        $this->postService = $postService;
        $this->customerService = $customerService;
        $this->campaignService = $campaignService;
        $this->categoryService = $categoryService;
    }

    public function index(FeedBack $feedBack)
    {
        $products = $this->productService->newQuery()
            ->select('id', 'name', 'slug', 'image', 'sale_price', 'price', 'status', 'is_stock')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(20)
            ->get();
        $campaignBody = $this->campaignService->newQuery()
            ->where('type', 2)
            ->where('status', 1)
            ->take(3)
            ->get();
        $feedbacks = $feedBack->query()->where('status', 1)
            ->where('type', 'feedback')
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();
        $promotions = $feedBack->query()->where('status', 1)
            ->where('type', 'promotion')
            ->orderBy('id', 'DESC')
            ->get();
        return view('frontend.app.app', compact('products', 'campaignBody', 'feedbacks', 'promotions'));
    }

    public function pageSearch()
    {
        return view('frontend.search.index');
    }

    public function getSearch(Request $request)
    {
        $params = $request->all();
        $params['per_page'] = 16;
        $request = $params;
        $search = $params['search'] ?? '';
        $results = $this->productService->index($request);
        return view('frontend.search.list', compact('results', 'search'));
    }

    public function pageAboutUs()
    {
        $post = $this->postService->newQuery()
            ->where('post_type', Post::POST_TYPE_ABOUT_US)
            ->orderBy('id', 'DESC')
            ->first();
        return view('frontend.about.index', compact('post'));
    }

    public function pageShipping()
    {
        $post = $this->postService->newQuery()
            ->where('post_type', Post::POST_TYPE_SHIPPING)
            ->orderBy('id', 'DESC')
            ->first();
        return view('frontend.shipping.index', compact('post'));
    }

    public function pageRefundPolicy()
    {
        $post = $this->postService->newQuery()
            ->where('post_type', Post::POST_TYPE_REFUND_POLICY)
            ->orderBy('id', 'DESC')
            ->first();
        return view('frontend.refund_policy.index', compact('post'));
    }

    public function pagePrivacy()
    {
        $post = $this->postService->newQuery()
            ->where('post_type', Post::POST_TYPE_PRIVACY)
            ->orderBy('id', 'DESC')
            ->first();
        return view('frontend.privacy.index', compact('post'));
    }

    public function pageContact()
    {
        return view('frontend.contact.index');
    }

    /**
     * @throws ValidationException
     */
    public function createContact(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $params = $request->all();
        unset($params['_token']);
        $this->customerService->store($params);
         Mail::to('Linhaichii@gmail.com')->send(new SentEmailContact($params));
        return redirect()->back()->with('success', 'Success!');
    }

    public function campaign(Request $request, $slug){
        $campaign = $this->campaignService->newQuery()->where('slug', $slug)->first();
        $products = [];
        if (!empty($campaign)) {
            $params = $request->all();
            $params['per_page'] = 16;
            $params['campaign_id'] = $campaign->id;
            $products = $this->productService->index($params);
        }
        return view('frontend.campaign.index', compact('products', 'campaign'));
    }

    public function category(Request $request, $slug){
        $category = $this->categoryService->newQuery()->where('slug', $slug)->first();
        $products = [];
        if (!empty($category)) {
            $params = $request->all();
            $params['per_page'] = 16;
            $params['category_id'] = $category->id;
            $products = $this->productService->index($params);
        }
        return view('frontend.category.index', compact('products', 'category'));
    }

    public function detailProduct($slug){
        $product = $this->productService->newQuery()->where('slug', $slug)->with('productDetail')->first();
        $productSameCategory = $this->productService->newQuery()
            ->where('campaign_id', $product->campaign_id)
            ->where('id','!=', $product->id)
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();
        return view('frontend.product.index', compact('product', 'productSameCategory'));
    }

    public function addToCart($id): \Illuminate\Http\JsonResponse
    {
        $product = $this->productService->detail($id);
        if ($product) {
            $carts = Session::get('cart', []);
            if (isset($carts[$id])) {
                $carts[$id]['qty'] += 1;
            } else {
                $price = $product->sale_price > 0
                    ? $product->sale_price
                    : $product->price;
                $carts[$id]['qty'] = 1;
                $carts[$id]['id'] = (int)$id;
                $carts[$id]['name'] = $product->name;
                $carts[$id]['slug'] = $product->slug;
                $carts[$id]['image'] = $product->image;
                $carts[$id]['price'] = ($price);
                $carts[$id]['price_format'] = number_format($price);
            }
            $total = $carts[$id]['price'] * $carts[$id]['qty'];
            $carts[$id]['total'] = $total;
            $carts[$id]['total_format'] = number_format($total);
            Session::put('cart', $carts);
        }

        $carts = Session::get('cart', []);
        $total_price_all = 0;
        $count = sizeof($carts);
        if (!empty($carts)) {
            foreach ($carts as $value) {
                $total_price_all += $value['total'];
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'carts' => $carts,
                'total_price_all' => number_format($total_price_all),
                'count' => $count
            ]
        ]);
    }

    public function listCart(){
        $carts = Session::get('cart', []);
        $total_price_all = 0;
        if (!empty($carts)) {
            foreach ($carts as $cart) {
                $total_price_all += $cart['total'];
            }
        }
        $total_price_all = number_format($total_price_all);
        return view('frontend.cart.index', compact('carts', 'total_price_all'));
    }

    public function updateCart(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $quantity = $request->quantity ?? 0;
        $quantity = (int) $quantity;
        $carts = Session::get('cart', []);
        if (isset($carts[$id])) {
            $carts[$id]['qty'] = $quantity;
            $carts[$id]['total'] = $quantity * $carts[$id]['price'];
            $carts[$id]['total_format'] = number_format($quantity * $carts[$id]['price']);
        }
        Session::put('cart', $carts);
        $carts = Session::get('cart', []);
        $total_price_all = 0;
        if (!empty($carts)) {
            foreach ($carts as $value) {
                $total_price_all += $value['total'];
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'cart' => [
                    'qty' => $carts[$id]['qty'],
                    'total_format' => $carts[$id]['total_format'],
                ],
                'total_price_all' => number_format($total_price_all),
            ]
        ]);
    }

    /**
     * @throws BindingResolutionException
     */
    public function createOrder(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            unset($params['_token']);
            $first_name = $params['first_name'] ?? '';
            $last_name = $params['last_name'] ?? '';
            $params['full_name'] = $first_name . ' ' . $last_name;
            $carts = Session::get('cart', []);
            if (sizeof($carts) == 0) {
                return redirect()->back()->with('error', 'Cart is empty!');
            }
            if (empty($request['email'])) {
                return redirect()->back()->with('error', 'Email is required!');
            }
            if (!$customer = $this->customerService->newQuery()->where('email', $params['email'])->first()) {
                $customer = $this->customerService->store($params);
            }
            $customer = $this->customerService->store($params);
            $total_quantity = 0;
            $total_amount = 0;
            foreach ($carts as $cart) {
                $total_quantity += $cart['qty'];
                $total_amount += $cart['total'];
            }
            $order = Order::query()->create([
                'customer_id' => $customer->id,
                'total_amount' => $total_amount,
                'total_quantity' => $total_quantity,
                'status' => 0
            ]);
            $storeOrderDetail = [];
            foreach ($carts as $cart) {
                $storeOrderDetail[] = [
                    'order_id' => $order->id,
                    'product_id' => $cart['id'],
                    'amount' => $cart['price'],
                    'quantity' => $cart['qty'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                Product::query()->where('id', $cart['id'])->update(['is_stock' => 0]);
            }
            $orderDetailService = app()->make(OrderDetailService::class);
            $orderDetailService->storeMany($storeOrderDetail);
            if(!empty(env('MAIL_FROM_ADDRESS'))) {
                $orderSentEmail = Order::query()->where('id', $order->id)->first();
                $orderDetail = OrderDetail::query()->where('order_id', $order->id)->with('product')->get();
                Mail::to($params['email'])->send(new SentEmailShoppingCart($orderSentEmail, $orderDetail, $customer));
            }
            DB::commit();
            Session::forget('cart');
            return redirect()->back()->with('success', 'Success!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    public function productAll(Request $request){
        $params = $request->all();
        $params['per_page'] = 12;
        $request = $params;
        $results = $this->productService->index($request);
        return view('frontend.list_product.index', compact('results'));
    }
}
