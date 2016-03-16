<?php namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\EditPageRequest;
use App\Http\Requests\Page\EditPageTemplateRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Page;
use App\Product;
use App\Section;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class PageController extends AppController {

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
        $pages = Page::where('event_id', Configuration::eventId())->get();
        return view('page/index', compact('pages'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(){
      return view('page/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreatePageRequest $request){
      if($request->home === '1'){
          // Check if there is already a home
          if(Page::where('event_id', \App\Configuration::eventId())->where('home', '1')->count() >= 1){
              Flash::error("There is already a homepage");
              return redirect(action('PageController@create'));
          }
      }

      $page = new Page();
      $page->title = $request->title;
      $page->event_id = Configuration::eventId();
      $page->home =  ($request->home === '1' ? 1 : 0);
      $page->save();

      // Create the template
      Storage::put($page->getFrontViewPath(), '');


      return redirect(action('PageController@index'));
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
      $page = Page::findOrFail($id);
      return view('page/edit', compact('page'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(EditPageRequest $request, $id){
      if($request->home === '1'){
          // Check if there is already a home
          $query = Page::where('event_id', \App\Configuration::eventId())->where('home', '1');
          if($query->count() >= 1){
              if($query->first()->id != $id) {
                  Flash::error("There is already a homepage");
                  return redirect(action('PageController@edit'));
              }
          }
      }

      $page = Page::findOrFail($id);
      $page->title = $request->title;
      $page->home =  ($request->home === '1' ? 1 : 0);
      $page->save();

      return redirect(action('PageController@index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      $page = Page::findOrFail($id);
      $page->delete();

      Flash::success("Page deleted!");

      return redirect(action('PageController@index'));
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        return view('page/delete', compact('id'));
    }

    public function editTemplate($id){
        $page = Page::findOrFail($id);
        $products = Product::where('event_id', Configuration::eventId())->get();
        $sections = Section::where('page_id', $id)->get();
        $code = Storage::get($page->getFrontViewPath());
        $hasShifts = Configuration::event()->hasShifts();
        return view('page/editTemplate', compact('page', 'code', 'products', 'sections', 'hasShifts'));
    }

    public function updateTemplate(EditPageTemplateRequest $request, $id){
        $page = Page::findOrFail($id);
        Storage::put($page->getFrontViewPath(), $request->code);

        return redirect(action('PageController@editTemplate', $id));
    }
  
}

?>