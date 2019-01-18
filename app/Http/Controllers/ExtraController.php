<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Extra;
class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extras = Extra::latest()->paginate(5);
        return view('extra.index', compact('extras'))
                  ->with('i', (request()->input('page',1) -1)*5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extra.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required',
        ]);
        extra::create($request->all());
        return redirect()->route('extra.index')
                        ->with('success', 'Created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $extra = extra::find($id);
        return view('extra.detail', compact('extra'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extra = Extra::find($id);
        return view('extra.edit', compact('extra'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'name' => 'required',
      ]);
      $extra = Extra::find($id);
      $extra->name = $request->get('name');
      $extra->save();
      return redirect()->route('extra.index')
                      ->with('success', 'Updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $extra = extra::find($id);
        $extra->delete();
        return redirect()->route('extra.index')
                        ->with('success', 'Deleted successfully');
    }
}