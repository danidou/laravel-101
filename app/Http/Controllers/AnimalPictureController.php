<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalPictureRequest;
use App\Http\Requests\UpdateAnimalPictureRequest;
use App\Models\AnimalPicture;
use Illuminate\Support\Facades\Http;

class AnimalPictureController extends Controller
{
    /**
     * Display a random animal picture, and save it to the database.
     */
    public function random()
    {
        $apis = $this->getAnimalApisArray();
        $animal = request()->input('animal');
        if ($animal && isset($apis[$animal])) {
            $response = Http::get($apis[$animal]['url']);
            $url = $response->object()->{$apis[$animal]['imageField']};

            $animalPicture = AnimalPicture::updateOrCreate([
                'animal' => request()->input('animal'),
                'url' => $url,
            ]);

            return view('animals.random', ['animalPicture' => $animalPicture]);
        }

        return view('animals.random');
    }

    /**
     * Returns an array of APIs used to get animal pictures.
     * @return array[]
     */
    private function getAnimalApisArray()
    {
        return [
            'duck' => [ 'url' => 'https://random-d.uk/api/random',
                'imageField' => 'url',
            ],
            'dog'  => [ 'url' => 'https://random.dog/woof.json',
                'imageField' => 'url',
            ],
            'fox'  => [ 'url' => 'https://randomfox.ca/floof/',
                'imageField' => 'image',
            ],
        ];
    }
}
