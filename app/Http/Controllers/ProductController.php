<?php namespace App\Http\Controllers;

use App\Configuration;
use App\Event;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Product;
use App\ProductAvailability;

class ProductController extends AppController {

    public function __construct(){
        Parent::__construct();
        $this->middleware('isAdmin');
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $products = Product::where('event_id', Configuration::eventId())->get();
    return view('product/index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('product/create', compact('products'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateProductRequest $request){
      $product = new Product();
      $product->name = $request->name;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->event_id = $this->event->id;
      $product->save();

      // Add the availability
      if($this->event->hasShifts()){
        foreach($this->event->shifts()->get() as $shift){
            $availability = $product->availability()->create([
                'shift_id' => $shift->id,
                'available' => $request->input('available'.$shift->id)
            ]);
        }
      }else{
         $availability = $product->availability()->create([
             'shift_id' => 1,
             'available' => $request->available
         ]);
      }

    return redirect(action('ProductController@index'));
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
  public function edit($id){
      $product = Product::findOrFail($id);
      return view('product/edit', compact('product'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(EditProductRequest $request, $id){
      $product = Product::findOrFail($id);
      $product->update($request->all());

      if(!$this->event->hasShifts()){
          $product->availability()->first()->update(['available' => $request->available]);
      }

      return redirect(action('ProductController@index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      $product = Product::findOrFail($id);

      foreach($product->availability()->get() as $availability){
          $availability->delete();
      }

      $product->delete();

      return redirect(action('ProductController@index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function delete($id){
      return view('product/delete', compact('id'));
  }


}

?>