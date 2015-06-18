<?php
/**
 * Created by PhpStorm.
 * User: b
 * Date: 18-06-2015
 * Time: 15:47
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;

class FindRequest extends Request {

    public function authorize() {

        return true;
    }

    public function rules() {


        return [
            'name' => 'required|min:3'
        ];
    }

}