<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalPictureRequest;
use App\Http\Requests\UpdateAnimalPictureRequest;
use App\Models\AnimalPicture;
use Illuminate\Support\Facades\Http;

class AnimalPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function random()
    {
        // APIs : https://random-d.uk/api/random
        //        https://random.dog/woof.json
        //        https://randomfox.ca/floof/

        if (request()->input('animal')) {
            switch (request()->input('animal')) {
                case 'duck':
                    $response = Http::get('https://random-d.uk/api/random');
                    $url = $response->object()->url;
                    break;
                case 'dog':
                    $response = Http::get('https://random.dog/woof.json');
                    $url  = $response->object()->url;
                    break;
                case 'fox':
                    $response = Http::get('https://randomfox.ca/floof/');
                    $url  = $response->object()->image;
                    break;
                default:
                    abort(404);
                    break;
            }

            $animalPicture = AnimalPicture::updateOrCreate([
                'animal' => request()->input('animal'),
                'url' => $url,
            ]);

            return view('animals.random', ['animalPicture' => $animalPicture]);

        }


        return view('animals.random');
    }
}
