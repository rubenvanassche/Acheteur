<?php namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\Shift\CreateShiftRequest;
use App\Http\Requests\Shift\EditShiftRequest;
use App\Orderlist;
use App\Product;
use App\ProductAvailability;
use App\Shift;
use Illuminate\Http\Request;

class ShiftController extends AppController {

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
      $shifts = Shift::where('event_id', Configuration::eventId())->get();
      return view('shift/index', compact('shifts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(){
      $products = Product::where('event_id', Configuration::eventId())->get();

      return view('shift/create', compact('products'));
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateShiftRequest $request){
      $shift = new Shift();
      $shift->start = $request->start;
      $shift->end = $request->end;
      $shift->event_id = Configuration::eventId();
      $shift->save();

      foreach(Product::where('event_id', Configuration::eventId())->get() as $product){
          $availability = $product->availability()->create([
              'shift_id' => $shift->id,
              'available' => $request->input('available'.$product->id)
          ]);
      }

      return redirect(action('ShiftController@index'));
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
      $shift = Shift::findOrFail($id);
      return view('shift/edit', compact('shift'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(EditShiftRequest $request, $id){
      $shift = Shift::findOrFail($id);

      $shift->start = $request->start;
      $shift->end = $request->end;

      $shift->save();

      return redirect(action('ShiftController@index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, $id){
      $this->validate($request, [
          'shiftselect' => 'required|integer',
      ]);

      if($id == $request->id){
          return redirect(action('ShiftController@index'));
      }

      // Remove shift
      Shift::findOrFail($id)->delete();


      $products = Product::where('event_id', Configuration::eventId())->get();
      foreach($products as $product) {
          // Remove the productAvailability
          $availability = ProductAvailability::where('product_id', $product->id)->where('shift_id', $id)->first();
          $otherAvailability = ProductAvailability::where('product_id', $product->id)->where('shift_id', $request->shiftselect)->first();

          $otherAvailability->available = $otherAvailability->available + $availability->available;
          $otherAvailability->save();

          $availability->delete();

          // Change the orderlists
          $orderlists = Orderlist::where('product_id', $product->id)->where('shift_id', $id);
          foreach($orderlists as $orderlist){
              $orderlist->shift_id = $request->shiftselect;
              $orderlist->save();
          }
      }



      return redirect(action('ShiftController@index'));
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id){
        $shifts = Shift::where('event_id', Configuration::eventId())->where('id', '!=', $id)->get();
        return view('shift/delete', compact('shifts', 'id'));
    }

  
}

?>