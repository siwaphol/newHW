<?php
/**
 * Created by PhpStorm.
 * User: boonchuay
 * Date: 22/6/2558
 * Time: 15:16
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class Formadmin extends FormRequest{
    public function rules()
    {
        return [
            'id' => 'required',
            'adminName' => 'required'
        ];
    }

    public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        return true;
    }

} 