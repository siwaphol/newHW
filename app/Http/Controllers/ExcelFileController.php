<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Excel;

class ExcelFileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $simpleexcel = Excel::load('uploads/excel.xls', function($reader) {

        // reader methods

        });

		dd($simpleexcel);
	}

}
