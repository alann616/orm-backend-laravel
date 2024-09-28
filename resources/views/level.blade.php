<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Usuarios de nivel {{ $level->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="h-screen flex-row items-start mx-16 mt-2">
<div class="bg-gray-100 p-6 rounded-lg drop-shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">
        Contenido de usuarios nivel {{ $level->name }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($posts as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="flex">
                    <div class="flex">
                        <div class="w-1/3">
                            <img src="{{ $post->image->url }}" alt="" class="size-fit">
                        </div>
                        <div class="w-2/3 p-4">
                            <h5 class="text-lg font-bold mb-1">{{ $post->name }}</h5>
                            <h6 class="text-gray-500 text-sm mb-2">
                                {{ $post->category->name }} |
                                {{ $post->comments_count }}
                                {{ Str::plural('comentario', $post->comments_count) }}
                            </h6>
                            <p>
                                @foreach($post->tags as $tag)
                                    <span class="bg-slate-200 text-sm">
                                            #{{ $tag->name }}
                                        </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h3 class="text-2xl font-semibold mb-4">Videos</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($videos as $video)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="flex">
                    <div class="flex">
                        <div class="w-1/3">
                            <img src="{{ $video->image->url }}" alt="" class="size-fit">
                        </div>
                        <div class="w-2/3 p-4">
                            <h5 class="text-lg font-bold mb-1">{{ $video->name }}</h5>
                            <h6 class="text-gray-500 text-sm mb-2">
                                {{ $video->category->name }} |
                                {{ $video->comments_count }}
                                {{ Str::plural('comentario', $video->comments_count) }}
                            </h6>
                            <p>
                                @foreach($video->tags as $tag)
                                    <span class="bg-slate-200 text-sm">
                                            #{{ $tag->name }}
                                        </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



</div>
</body>
</html>
