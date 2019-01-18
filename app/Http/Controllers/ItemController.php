<?php
namespace App\Http\Controllers;
use App\Item;
use App\extra;
use App\company;
use App\extra_item;
use App\company_item;
use App\company_extra;
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
        return view('item.create')->with(['companies' => $companies, 'extras' => $extras]);
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
            'des' => 'required',
            'price' => 'min:0|numeric|required'
        ]);
        $company_extra = [];
        if ($request->has('extras')) {
            

            $company_extra = company_extra::where('company_id', '=', $request->input('company'))->whereIn('extra_id', $request->input('extras'))->get();
            if (sizeof($company_extra)!=sizeof($request->input('extras'))) {
                return back()->withErrors(['Problem' => 'Un extra no pertenece a la empresa']);;
            }
            
        }
        
        $item = Item::create($request->all());

        $company_item = company_item::create([
            'company_id' => $request->input('company'),
            'item_id' => $item->id,
            'price' => $request->input('price')
        ]);


        foreach ($company_extra as $item) {
            extra_item::create([
                'coex_id' => $item->id,
                'coit_id' => $company_item->id
            ]);
        }

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