<?php namespace App\Http\Controllers;

use App\Http\Requests\Formadmin;
use App\Http\Controllers\Controller;

use App\Admins;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$admins = Admins::latest()->get();
		return view('admin.index', compact('admins'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Formadmin $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Admins::create($request->all());
		return redirect('admin');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$admin = Admins::findOrFail($id);
		return view('admin.show', compact('admin'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$admin = Admins::findOrFail($id);
		return view('admin.edit', compact('admin'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Formadmin $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$admin = Admins::findOrFail($id);
		$admin->update($request->all());
		return redirect('admin');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Admins::destroy($id);
		return redirect('admin');
	}

}