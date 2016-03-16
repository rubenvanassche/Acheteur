<?php namespace App\Http\Controllers;

use App\Http\Requests\Page\CreateSectionRequest;
use App\Page;
use App\Providers\SectionTypes;
use App\Section;
use App\SectionTypes\TrevorJS;
use Caouecs\Sirtrevorjs\Controller\TraitSirTrevorJsController;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class SectionController extends AppController {

    public function __construct(){
        Parent::__construct();
        $this->middleware('isAdmin');
    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index($pageId){
    $page = Page::findOrFail($pageId);
    $sections = $page->sections;

    return view('page/section/index', compact('page', 'sections'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($pageId){
      $page = Page::findOrFail($pageId);
      $sectionTypes = SectionTypes::getAll();

      return view('page/section/create', compact('page', 'sectionTypes'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateSectionRequest $request, $pageId){
      $page = Page::findOrFail($pageId);

      if(!SectionTypes::validType($request->type)){
          Flash::error('Not an valid section type');
      }

      $section = new Section();
      $section->name = $request->name;
      $section->type = $request->type;
      $section->page_id = $page->id;
      $section->save();

      $page->sections()->save($section);

      return redirect(action('SectionController@edit', [$page->id, $section->id]));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($pageId, $id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($pageId, $id){
      $page = Page::findOrFail($pageId);
      $section = Section::findOrFail($id);


      $editor = SectionTypes::createInstance($section->type);


      return view('page/section/edit', compact('page', 'section', 'editor'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $pageId, $id){
      $section = Section::findOrFail($id);

      $editor = SectionTypes::createInstance($section->type);

      $this->validate($request, $editor->validationRules());

      $editor->save($request, $section);

      $section->save();

      return redirect(action('SectionController@index', $pageId));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($pageId, $id)
  {
      $section = Section::findOrFail($id);

      $editor = SectionTypes::createInstance($section->type);

      $editor->delete($section->content);

      $section->delete();

      return redirect(action('SectionController@index', $pageId));
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($pageId, $id)
    {
        return view('page/section/delete', compact('id', 'pageId'));
    }

}

?>
