<?php
namespace App\Http\Controllers;
use App\Extra;
use App\company;
use App\company_extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }

        $companies = company::all();
        return view('extra.create')->with(['companies' => $companies]);
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
          'company' => 'required',
          'price' => 'min:0|numeric|required'
        ]);
     
        $extra = extra::create($request->only('name'));

        $company_extra = company_extra::create([
            'company_id' => $request->input('company'),
            'extra_id' => $extra->id,
            'price' => $request->input('price')            
        ]);

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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
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
        if (Auth::user()->id != 1) {
            return redirect()->back()->withErrors(['Permission' => 'No tienes permis para esto']);
        }
        $extra = extra::find($id);
        $extra->delete();
        return redirect()->route('extra.index')
                        ->with('success', 'Deleted successfully');
    }
}