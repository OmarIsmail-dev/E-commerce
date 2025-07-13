<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Null_;

use function Laravel\Prompts\alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(middleware: 'auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      
        $product = Http::get('http://127.0.0.1:8001/api/product');
        $products = json_decode($product->body(), true);

        $carts = Cart::with("product", "user")->get();
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');
        return view('home', compact("products", "carts", "totalCount"));

    }


    //    http://127.0.0.1:8001/api/Category

    public function shop()
    {


        $product = Http::get("http://127.0.0.1:8001/api/product");
        $products = json_decode($product->body(), true);
        $products = $products['data'] ?? [];

        $Category = Http::get("http://127.0.0.1:8001/api/Category");
        $Categories = json_decode($Category->body(), true);
        $Categories = $Categories['data'] ?? [];


        $carts = Cart::with("product", "user")->get();
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        return view("auth.shop", compact("products", "carts", "totalCount", "Categories"));
    }

    public function ShopCategory($id)
    { 
        $CategoryId = Http::get("http://127.0.0.1:8001/api/Category/{$id}");
        $CategoriesID = json_decode($CategoryId->body(), true);
        $CategoriesID = $CategoriesID['data'] ?? [];


        $productId = Http::get("http://127.0.0.1:8001/api/product/{$id}");
        $productsID = json_decode($productId->body(), true);
        $productsID = $productsID['data'] ?? [];



        // if ($productsID['category_id'] !== $CategoriesID['id']) {
        //     return redirect()->route("shop")->with("alert", "Not found Category");
        // }

 
        

        $Category = Http::get("http://127.0.0.1:8001/api/Category");
        $Categories = json_decode($Category->body(), true);
        $Categories = $Categories['data'] ?? [];
        $carts = Cart::with("product", "user")->get();
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        $product = Http::get("http://127.0.0.1:8001/api/product");
        $products = json_decode($product->body(), true);
        $products = $products['data'] ?? [];









        return view("auth.ShopCategory", compact("Categories", "carts", "totalCount", "products", "CategoriesID"));
 
    }

    public function about()
    {

        $product = Product::find(auth()->user()->id);
        $carts = Cart::with("product", "user")->get();
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        return view("auth.About", compact("product", "carts", "totalCount"));
    }

    public function contact()
    {

        $product = Product::find(auth()->user()->id);
        $carts = Cart::with("product", "user")->get();
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        return view("auth.contact", compact("product", "carts", "totalCount"));
    }

    public function MyOrder()
    {

        $product = Product::find(auth()->user()->id);
        $carts = Cart::with("product", "user")->get();
        $orders = Order::orderBy('created_at', 'DESC')->with("product", "user")->get();

        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');



        return view("auth.MyOrder", compact("product", "carts", "orders", "totalCount"));
    }

    public function MyAccount()
    {
        $product = Product::find(auth()->user()->id);
        $carts = Cart::with("product", "user")->get();
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');


        return view("auth.MyAccount", compact("product", "carts", "totalCount"));
    }

    public function product($id)
    {
        $productId = Http::get("http://127.0.0.1:8001/api/product/{$id}");
        $products = json_decode($productId->body(), true);
        $carts = Cart::with("product", "user")->get();
        $products = $products['data'] ?? [];

        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        return view("auth.product", compact("products", "carts", "totalCount"));
    }


    public function CartProduct($id, Request $request)
    {  
        
        $productId = Http::get("http://127.0.0.1:8001/api/product/{$id}");
        $productsApi = json_decode($productId->body(), true);
        $productsApi = $productsApi['data'] ?? [];


        if (!$productsApi || !isset($productsApi['id'])) {
            return abort(404, "Product not found in Inventory API.");
        } 

        $productCheck = Product::where('id', $productsApi['id'])->first(); 


        if (!$productCheck) {
             $newProduct= Product::create([
                'id' => $productsApi['id'],
                'stock' => intval($productsApi['in_stock'] ?? 0),
                'name' => $productsApi['title'],
                'price' => $productsApi['SellingPrice'],
                'color' => $productsApi['color'],
                'description' => $productsApi['description'],
                'brand' => $productsApi['brand'],
                'size_shoes' => $productsApi['size_shoes'],
                'size_clothes' => $productsApi['size_clothes'],
                'image' => $productsApi['image'] ?? null,

 
            ]);
 
        }

        $products = Product::findOrFail($id);
        $existingCartItem = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $products->id)
            ->first();

        if ($existingCartItem) {
            // Product already exists in the cart, show an alert message
            session()->flash('alert', "{$products->name} is already in your cart");
            return redirect()->route("home"); // Redirect to home
        }



        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $productsApi['id'],
            'quantity' => $request->quantity,
            'price' => $productsApi['SellingPrice'],
            'totalPrice' => $productsApi['SellingPrice'] * $request->quantity,

        ]);

 
        return redirect()->route("cart");
    }


    public function AddToCart($id, Request $request)
{
         $response = Http::get("http://127.0.0.1:8001/api/product/{$id}");
        $productsApi = json_decode($response->body(), true)['data'];
         $productCheck = Product::where('id', $productsApi['id'])->first();

        if (!$productCheck) {
            $new = Product::create([
                'id' => $productsApi['id'],
                'stock' => intval($productsApi['in_stock'] ?? 0),
                'name' => $productsApi['title'],
                'price' => $productsApi['SellingPrice'],
                'color' => $productsApi['color'],
                'description' => $productsApi['description'],
                'brand' => $productsApi['brand'],
                'size_shoes' => $productsApi['size_shoes'],
                'size_clothes' => $productsApi['size_clothes'],
                'image' => $productsApi['image'] ?? null,
            ]);

            
        }

          $products = Product::findOrFail($productsApi['id']);

         $existingCartItem = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $products->id)
            ->first();

        if ($existingCartItem) {
            session()->flash('alert', "{$products->name} is already in your cart");
            return redirect()->route("home");
        }

         Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $productsApi['id'],
            'quantity' => 1,
            'price' => $productsApi['SellingPrice'],
            'totalPrice' => $productsApi['SellingPrice'],
        ]);

        return redirect()->route("cart");

 
}

      


    public function cart(Request $request)
    {

        $response = Http::get("http://127.0.0.1:8001/api/product");
        $productsApi = json_decode($response->body(), true)['data'];

  
        $products = Product::all();
        $id = auth()->user()->id;
        $user = User::find($id);
        $carts = Cart::with("product", "user")->get();
        $totalPrice = Cart::where('user_id', auth()->user()->id)->sum('totalPrice');
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        foreach ($carts as $cart) {

            if ($cart->user_id == auth()->user()->id) {
                $check = $cart->user_id;
            }
        }



        return view("auth.Cart", compact("products", "id", "user", "carts", "totalPrice", "request", "totalCount","productsApi"));
    }


    public function layout($id)
    {


        $products = Product::all();
        $product = Product::find($id);
        $user = User::find($id);
        $carts = Cart::with("product", "user")->get();
        $cart = Cart::find($id);
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');




        return view("layouts.app", compact("products", "check", "product", "user", "carts", "totalCount"));
    }

    public function removeCart($id)
    {
        $removeCart = Cart::find($id);
        $removeCart->delete();

        return redirect()->route("cart");
    }


    public function checkout($id)
    {
        $carts = Cart::with("product", "user")->get();
        $cart = Cart::find($id);
        $product = Product::find($id);
        $totalPrice = Cart::where('user_id', auth()->user()->id)->sum('totalPrice');
        $totalCount = Cart::where('user_id', auth()->user()->id)->count('user_id');

        $all = Cart::all();

        foreach ($carts as $cart) {

            if ($check = $cart->user_id == auth()->user()->id) {

                $check = $cart->user_id;
            }
        }


        return view("auth.checkout", compact("carts", "cart", "product", "totalPrice", "totalCount"));
    }


    public function UpdateCheckout($id, Request $request)
    {

        $carts = Cart::all();
        $request->validate([

            'fname' => 'required|string|max:255',  // First name, optional
            'lname' => 'required|string|max:255',  // Last name, optional
            'cname' => 'required|string|max:255',  // Company name, optional
            'country' => 'required|string|max:100',
            'cityy' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'mobile' => 'required|string|max:20',
            'note' => 'nullable|string|max:1000',



        ]);


        $user = User::find($id);
        $user->update(request()->all());

        $carts = Cart::where("user_id", auth()->id())->get();
        $cartItems = Cart::where('user_id', auth()->id())->get(); // Get cart items for the user



        foreach ($cartItems as $cartItem) {
            $AddOrder = Order::create([
                'user_id' => auth()->user()->id,   // User ID
                'product_id' => $cartItem->product_id, // Product ID from the cart
                'quantity' => $cartItem->quantity,   // Quantity from the cart item
                'price' => $cartItem->totalPrice // Price from the product related to cart item
            ]);
        }


        foreach ($carts as $cart) {




            if ($cart->user_id == auth()->user()->id) {

                $cart->delete();
            }
        }



        return redirect()->route("MyOrder");
    }


    public function Logout(Request $request)
    {
        auth()->logout();

        // Optional: Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }



    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::with('product')->findOrFail($id);

        if (!$order->product) {
            return response()->json(['message' => 'Product not found in order'], 404);
        }

        if (!$order->quantity) {
            return response()->json(['message' => 'Order quantity is missing'], 400);
        }


        $newStatus = $request->input('order_status'); 
        $newAction = $request->input('action');

        $order->update([

            "order_status" => $newStatus,
                "action" => $newAction

            ]);

        $product = $order->product;
        $quantity = $order->quantity; 

        if ($newStatus === "completed") { 
            $product = $order->product;
            $quantity = $order->quantity; 
            if ($product->stock >= $quantity){
                             $response = Http::post('http://127.0.0.1:8001/api/update-inventory', [
                                'product_id' => $product->id,
                                'quantity' => $quantity,
                                'action' => 'decrease' 
                            ]);

         
                if ($response->failed()) {
                    return redirect()->back()->with('alert', 'Failed to update stock for product ' . $product->name);
                }

            }
            
            else {
                return redirect()->back()->with('alert', 'Not enough stock for product ' . $product->name);
            }

            return redirect()->route("MyOrder")->with('alert', 'Order status completed.');
        }

        elseif ($newStatus === "refused") { 
            $product = $order->product;
            $quantity = $order->quantity; 
            if ($product->stock >= $quantity){
                             $response = Http::post('http://127.0.0.1:8001/api/update-inventory', [
                                'product_id' => $product->id,
                                'quantity' => $quantity,
                                'action' => 'increase'
                            ]);

         
                if ($response->failed()) {
                    return redirect()->back()->with('alert', 'Failed to update stock for product ' . $product->name);
                }

            }
            
            else {
                return redirect()->back()->with('alert', 'Not enough stock for product ' . $product->name);
            }
            return redirect()->route("MyOrder")->with('alert', 'Order status refused.');

        }


 
    } 


    }

 