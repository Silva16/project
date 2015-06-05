<?php namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\File;
use Illuminate\Support\Facades\Response;

class MediaController extends Controller {

    private $disk;


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show($filename){

        /*$imgs = [Storage::get('/imgs/FindMyBurger.png')];

        return $imgs;*/

        $file = storage_path() . '/app/profiles/' . $filename;//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $headers = [
            'Content-Type' => 'image/jpg'
        ];

        return response()->download($file, $filename, $headers, 'inline');
    }


}