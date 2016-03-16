<?php namespace App\Http\Controllers;

use App\Event;
use App\Shift;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\EditEventRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(){
      $events = Event::all();

      return view('acheteur/event/index', compact('events'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(){
    return view('acheteur/event/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateEventRequest $request){
      $event = new Event;
      $event->name = $request->name;
      $event->password = Hash::make($request->password);
      $event->shifts = ($request->shifts === '1' ? 1 : 0);
      $event->save();

      // if no shifts selected, create a default shift
      if($event->shifts == 0){
          $shift = new Shift();
          $shift->start = date('d-m-Y G:i:s');
          $shift->end = date('d-m-Y G:i:s');
          $shift->event_id = $event->id;
          $shift->save();
      }

      // Create the assets folder
      Storage::makeDirectory($event->getAssetsFolder());

      // Create the views - email folder
      Storage::makeDirectory($event->getViewsFolder().'/email');

      // Create the views - front folder
      Storage::makeDirectory($event->getViewsFolder().'/front');

      // Create the uploads folder
      Storage::makeDirectory($event->getUploadsFolder());

      return redirect(action('EventController@index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id){

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id){
      $event = Event::findOrFail($id);
      return view('acheteur/event/edit', compact('event'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(EditEventRequest $request, $id){
      $event = Event::findOrFail($id);
      $event->name = $request->name;
      if($request->password != ''){
          $event->password = Hash::make($request->password);
      }
      $event->shifts = ($request->shifts === '1' ? 1 : 0);
      $event->save();



      return redirect(action('EventController@index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id){
      $event = Event::findOrFail($id);

      // Delete the assets folder
      Storage::deleteDirectory($event->getAssetsFolder());

      // Delete the views folder
      Storage::deleteDirectory($event->getViewsFolder());

      // Delete the uploads folder
      Storage::deleteDirectory($event->getUploadsFolder());

      $event->delete();

      return redirect(action('EventController@index'));

  }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function delete($id){

        return view('acheteur/event/delete', compact('id'));
    }


}

?>
