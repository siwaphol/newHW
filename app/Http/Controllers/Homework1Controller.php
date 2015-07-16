<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Homework1s;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

class Homework1Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $course=$_GET['course'];
        $sec=$_GET['sec'];
        $homework1s=DB::select('select * from homework where course_id=? and section=? and semester=? and year=? ',array($course,$sec,Session::get('semester'),Session::get('year')));
		//$homework1s = Homework1s::latest()->get();
		return view('homework1.index', compact('homework1s'))->with('course',array('course'=>$course,'sec'=>$sec));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $course=$_GET['course'];
        $sec=$_GET['sec'];
		return view('homework1.create')->with('course',array('course'=>$course,'sec'=>$sec));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Homework1s::create($request->all());
		return redirect('homework1');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$homework1 = Homework1s::findOrFail($id);
		return view('homework1.show', compact('homework1'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$homework1 = Homework1s::findOrFail($id);
		return view('homework1.edit', compact('homework1'));
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
		$homework1 = Homework1s::findOrFail($id);
		$homework1->update($request->all());
		return redirect('homework1');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Homework1s::destroy($id);
		return redirect('homework1');
	}

}