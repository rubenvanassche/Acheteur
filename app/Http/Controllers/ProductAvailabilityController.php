<?php namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\Product\EditProductAvailabilityRequest;
use App\Product;

class ProductAvailabilityController extends AppController {

  public function __construct(){
    Parent::__construct();
    $this->middleware('isAdmin');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index($productId)
  {
    $product = Product::findOrFail($productId);
    $availability = $product->availability;
    $shifts = Configuration::event()->shifts()->get();


    return view('product/availability/index', compact('availability', 'product', 'shifts'));

  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($productId)
  {
    $product = Product::findOrFail($productId);
    $availability = $product->availability;

    return view('product/availability/edit', compact('availability', 'product'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(EditProductAvailabilityRequest $request, $productId){
    $product = Product::findOrFail($productId);

    foreach($this->event->shifts()->get() as $shift){
      $product->availability()->where('shift_id', $shift->id)->update(['available' => $request->input('available'.$shift->id)]);
    }

    return redirect(action('ProductAvailabilityController@index', $product->id));
  }

  
}

?>