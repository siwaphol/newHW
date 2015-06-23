<?php namespace App\Http\Controllers;

use App\Http\Requests\Formtas;
use App\Http\Controllers\Controller;

use App\Tas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tas = Tas::latest()->get();
		return view('tas.index', compact('tas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Formtas $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Tas::create($request->all());
		return redirect('ta');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ta = Tas::findOrFail($id);
		return view('tas.show', compact('ta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ta = Tas::findOrFail($id);
		return view('tas.edit', compact('ta'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Formtas $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$ta = Tas::findOrFail($id);
		$ta->update($request->all());
		return redirect('ta');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Tas::destroy($id);
		return redirect('ta');
	}

}