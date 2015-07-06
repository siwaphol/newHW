<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Semesteryears;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class SemesteryearController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$semesteryears =DB::select('select * from semester_year ORDER BY  year desc,semester desc ');
		return view('semesteryear.index', compact('semesteryears'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('semesteryear.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
        $semester=new Semesteryears();
        $semester->semester=$request->get('semester');
        $semester->year=$request->get('year');
        $semester->use=0;
        $semester->save();
		//Semesteryears::create($request->all());
		return redirect('semesteryear');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$semesteryear = Semesteryears::findOrFail($id);
		return view('semesteryear.show', compact('semesteryear'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$semesteryear = Semesteryears::findOrFail($id);
		return view('semesteryear.edit', compact('semesteryear'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
        $semester=Semesteryears::find($id);
        $semester->semester=$request->get('semester');
        $semester->year=$request->get('year');
        $semester->use=$request->get('use');
        $semester->save();
//        $semesteryear = Semesteryears::findOrFail($id);
//		$semesteryear->update($request->all());
		return redirect('semesteryear');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Semesteryears::destroy($id);
		return redirect('semesteryear');
	}

}