<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Assistants;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AssistantsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$assistants = Assistants::latest()->get();
		return view('assistants.index', compact('assistants'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('assistants.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Assistants::create($request->all());
		return redirect('assistants');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $assistant=DB::select('select ass.id as id,ta.id as taid,ta.taName as taname ,ass.courseid as courseid,ass.sectionid as sectionid
                                from assistants ass
                                left join tas ta on ass.taid=ta.id
                                 where ass.id=?',array($id));
		//$assistant = Assistants::findOrFail($id);
		return view('assistants.show')->with('assistant',$assistant);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$assistant = Assistants::findOrFail($id);
		return view('assistants.edit', compact('assistant'));
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
		$assistant = Assistants::findOrFail($id);
		$assistant->update($request->all());
		return redirect('assistants');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Assistants::destroy($id);
		return redirect('assistants');
	}
    public function showlist()
    {
        $course = $_POST['ddlCourse'];
        $sec = $_POST['ddlSection'];
        $cours=array('co'=>$course,'sec'=>$sec);
        //return $cours;
        return view('assistants.showlist')->with('course',$cours);
    }
}