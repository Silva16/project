<?php namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\File;
use Illuminate\Support\Facades\Response;

class MediaController extends Controller {

    private $disk;


    public function __construct()
    {
        $this->middleware('guest');
    }

    public static function getImages(){

        /*$imgs = [Storage::get('/imgs/FindMyBurger.png')];

        return $imgs;*/

        $path = storage_path() . '/app/imgs/FindMyBurger.png';//, "imgs/FindMyBurger.png", "imgs/GuideTour.jpeg", "imgs/SeriesTime.png", "imgs/SimpleExpensesMananger.png

        $file = new File\File($path);

        $response = Response::make($file);

        $type = $file->getMimeType();

        $response->header('Content-type', $type);

        return $response->he;
    }

}