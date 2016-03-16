<?php namespace App\Http\Controllers;

use App\Order;

class OrderlistController extends AppController {

    public function __construct(){
        Parent::__construct();
        $this->middleware('isAdmin');
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index($orderId){
      $order = Order::findOrFail($orderId);
      $orderlists = $order->orderlists->all();

      return view('order/orderlist/index', compact('order', 'orderlists'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($orderId)
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store($orderId)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($orderId, $id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($orderId, $id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($orderId, $id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($orderId, $id)
  {
    
  }
  
}

?>