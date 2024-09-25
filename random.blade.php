<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen">
<div class="p-12">
    <form class="w-full max-w-lg">
        <select name="animal" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 m-2 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="">Sélectionnez un animal</option>
            <option value="dog" @if(request()->input('animal') === 'dog')selected @endif>Chien</option>
            <option value="fox" @if(request()->input('animal') === 'fox')selected @endif>Renard</option>
            <option value="duck" @if(request()->input('animal') === 'duck')selected @endif>Canard</option>
        </select>
        <button class="m-2 bg-blue-500 hover:bg-blue-700 text-white font-bold p-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Générer
        </button>
    </form>
    <div>
        @if($animalPicture)
            @if(Str::endsWith(Str::lower($animalPicture->url), ['jpg','png','gif']))
                <img alt="{{ $animalPicture->animal }}" src="{{ $animalPicture->url }}" class="max-h-80">
            @elseif(Str::endsWith(Str::lower($animalPicture->url), ['mp4']))
                <video class="max-h-80" autoplay loop muted>
                    <source src="{{ $animalPicture->url }}" type="video/mp4">
                </video>
            @endif
        @endif
    </div>
</div>
</body>
</html>
