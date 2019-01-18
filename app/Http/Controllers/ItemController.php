<?php
namespace App\Http\Controllers;
use App\Item;
use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->id !=1 ){
            return back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
        $items = Item::latest()->paginate(5);
        return view('item.index', compact('items'))
                  ->with('i', (request()->input('page',1) -1)*5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }

        $extras = extra::all();
        $companies = company::all();
        return view('item.create')->with(['companies' => $companies, 'extras' => $extra]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }

        $request->validate([
          'name' => 'required',
          'des' => 'required'
        ]);
        Item::create($request->all());
        return redirect()->route('item.index')
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
        $item = Item::find($id);
        return view('item.detail', compact('item'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
        $item = Item::find($id);
        return view('item.edit', compact('item'));
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
        $request->validate([
            'name' => 'required',
            'des' => 'required'
        ]);
        $item = Item::find($id);
        $item->name = $request->get('name');
        $item->des = $request->get('des');
        $item->save();
        return redirect()->route('item.index')
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('item.index')
                        ->with('success', 'Deleted successfully');
    }
}