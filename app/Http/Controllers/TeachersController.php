<?php namespace App\Http\Controllers;

use App\Http\Requests\Formteachers;
use App\Http\Controllers\Controller;

use App\Teachers;
//use Illuminate\Http\Request;
use Carbon\Carbon;
use Response;
use View;


class TeachersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teachers = Teachers::latest()->get();
		return view('teachers.index', compact('teachers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('teachers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Formteachers $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Teachers::create($request->all());
		return redirect('teachers');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$teacher = Teachers::findOrFail($id);
		return view('teachers.show', compact('teacher'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$teacher = Teachers::findOrFail($id);
		return view('teachers.edit', compact('teacher'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Formteachers $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$teacher = Teachers::findOrFail($id);
		$teacher->update($request->all());
		return redirect('teachers');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		Teachers::destroy($id);
		return redirect('teachers');
	}

}