<?php namespace App\Http\Controllers;

use App\Configuration;
use App\Email;
use App\Event;
use App\Exceptions\NotEnoughStockException;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Order;
use App\Product;
use App\Shift;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends AppController {

  public function __construct(){
    Parent::__construct();
    $this->middleware('isAdmin');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(){
      $orders = Order::where('event_id', Configuration::eventId())->get();
      return view('order/index', compact('orders'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $products = Product::where('event_id', Configuration::eventId())->get();
    $shifts = Shift::where('event_id', Configuration::eventId())->get();
    $hasShifts = Configuration::event()->hasShifts();
    return view('order/create', compact('products', 'shifts', 'hasShifts'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateOrderRequest $request){
    $products = Product::where('event_id', Configuration::eventId())->get();
    $hasShifts = Configuration::event()->hasShifts();

    // Check if available for all
    foreach($products as $product){
      if((($product->stock($request->shift) - intval($request->input('product'.$product->id))) < 0) == true){
        throw new NotEnoughStockException($product->name. " not enough in stock");
      }
    }

    // Create order
    $order = new Order();
    $order->name = $request->name;
    $order->event_id = Configuration::eventId();
    $order->email = $request->email;
    $order->comments = $request->comments;
    if($hasShifts == true){
      $order->shift_id = $request->shift;
    }else{
      $order->shift_id = 0;
    }
    $order->save();


    foreach($products as $product){
      $amount = $request->input('product'.$product->id);

      // Create orderlists
      $order->orderlists()->create([
          'product_id' => $product->id,
          'amount' => $amount
      ]);

      // Update availability of products
      $product->sell($amount, $request->shift);
    }



    // send email
    // send email
    Blade::directive('content', function($expression) use($order) {
        $expression = substr($expression,1,-1);
        if($expression == 'name'){
            return '<?php echo($order->name); ?>';
        }else if($expression == 'price'){
            return '<?php echo($order->cost()); ?>';
        }else if($expression == 'ordered'){
            return '<?php
            foreach($order->orderlists()->get() as $orderlist){
                $out = $orderlist->amount . " X " . $orderlist->product->name . "<br />";
            }
            ?>';
        }
    });



    $emailView = Email::view('orderconfirmation');
    $emailAddress = Configuration::event()->email;
    $emailName = Configuration::event()->name;

    Mail::send($emailView,['order' => $order], function ($message) use ($emailAddress, $emailName, $order){
        $message->from($emailAddress, $emailName);
        $message->to($order->email, $order->name)->subject('Order complete');
    });

    Flash::success('Order added');
    return redirect(action('OrderController@index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $order = Order::findOrFail($id);
    $orderlists = $order->orderlists()->lists('amount', 'product_id');
    $products = Product::where('event_id', Configuration::eventId())->get();
    $shifts = Shift::where('event_id', Configuration::eventId())->get();
    $hasShifts = Configuration::event()->hasShifts();

    return view('order/edit', compact('order', 'orderlists', 'products', 'shifts', 'hasShifts', 'id'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(UpdateOrderRequest $request, $id){
    $order = Order::findOrFail($id);
    $products = Product::where('event_id', Configuration::eventId())->get();
    $hasShifts = Configuration::event()->hasShifts();

    // Time to check if we have enough in stock
    if(intval($request->shift) == $order->shift_id){
      foreach($products as $product){
        $orderlist = $order->orderlists()->where('product_id', $product->id)->first();

        if(((($product->stock($request->shift) + $orderlist->amount) - intval($request->input('product'.$product->id))) < 0) == true){
          throw new NotEnoughStockException($product->name. " not enough in stock");
        }
      }
    }else{
      // Other shift so do not subtract to be deleted amounts
      foreach($products as $product){
        if((($product->stock($request->shift) - intval($request->input('product'.$product->id))) < 0) == true){
          throw new NotEnoughStockException($product->name. " not enough in stock");
        }
      }
    }

    // Remove the sold from products
    foreach($order->orderlists()->get() as $orderlist){
      $orderlist->product()->first()->refund($orderlist->amount, $order->shift_id);
      $orderlist->delete();
    }

    // Update the order
    $order->name = $request->name;
    $order->email = $request->email;
    $order->comments = $request->comments;
    if($hasShifts == true){
      $order->shift_id = $request->shift;
    }else{
      $order->shift_id = 0;
    }
    $order->save();

    foreach($products as $product){
      $amount = $request->input('product'.$product->id);

      // Create orderlists
      $order->orderlists()->create([
          'product_id' => $product->id,
          'amount' => $amount
      ]);

      // Update availability of products
      $product->sell($amount, $request->shift);
    }

    Flash::success('Order changed');
    return redirect(action('OrderController@index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id){
    $order = Order::findOrFail($id);

    // Remove the sold from products
    foreach($order->orderlists()->get() as $orderlist){
      $orderlist->product()->first()->refund($orderlist->amount, $order->shift_id);
      $orderlist->delete();
    }

    $order->delete();

    Flash::success("Order deleted!");

    return redirect(action('OrderController@index'));
  }

  public function delete($id){
    return view('order/delete', compact('id'));
  }

  public function printer(){
    $shifts = Shift::with('orders')->with('orders.orderlists')->with('orders.orderlists.product')->where('event_id', Configuration::eventId())->get();
    return view('order/printer', compact('shifts'));
  }

  public function excel(){
    Excel::create('Orders', function($excel) {

      $excel->sheet('Orders', function($sheet) {
        $shifts = Shift::where('event_id', Configuration::eventId())->get();
        $sheet->loadView(' order/printer', compact('shifts'));

      });

    });
  }

}

?>
