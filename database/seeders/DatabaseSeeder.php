<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Level;
use App\Models\User;
use App\Models\Profile;
use App\Models\Location;
use App\Models\Image;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Video;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 3 grupos automáticamente
        Group::factory(3)->create();

        // Crear niveles Oro, Plata, Bronce
        Level::factory()->create(['name' => 'Oro']);
        Level::factory()->create(['name' => 'Plata']);
        Level::factory()->create(['name' => 'Bronce']);

        // Crear 5 usuarios y vincular perfiles, ubicaciones, grupos e imágenes
        User::factory(5)->create()->each(function($user) {
            // Crear un perfil asociado al usuario
            $profile = $user->profile()->save(Profile::factory()->make());

            // Crear una ubicación asociada al perfil
            $profile->location()->save(Location::factory()->make());

            // Asociar el usuario con uno o más grupos
            $user->groups()->attach($this->array(rand(1, 3)));

            // Asociar una imagen al usuario
            $user->image()->save(Image::factory()->make(['url' => 'https://lorempixel.com/90/90']));
        });

        // Crear 4 categorías
        Category::factory(4)->create();

        // Crear 12 tags
        Tag::factory(12)->create();

        // Crear 40 posts y vincular imágenes, tags y comentarios
        Post::factory(40)->create()->each(function($post) {
            // Asociar una imagen al post
            $post->image()->save(Image::factory()->make());

            // Asociar tags al post
            $post->tags()->attach($this->array(rand(1, 12)));

            // Crear un número aleatorio de comentarios
            $number_comments = rand(1, 6);
            for ($i = 0; $i < $number_comments; $i++) {
                $post->comments()->save(\App\Models\Comment::factory()->make());
            }
        });

        // Crear 40 videos y vincular imágenes, tags y comentarios
        Video::factory(40)->create()->each(function($video) {
            // Asociar una imagen al video
            $video->image()->save(Image::factory()->make());

            // Asociar tags al video
            $video->tags()->attach($this->array(rand(1, 12)));

            // Crear un número aleatorio de comentarios
            $number_comments = rand(1, 6);
            for ($i = 0; $i < $number_comments; $i++) {
                $video->comments()->save(\App\Models\Comment::factory()->make());
            }
        });
    }

    /**
     * Función auxiliar para generar un array de valores.
     */
    public function array($max)
    {
        $values = [];
        for ($i = 1; $i <= $max; $i++) {
            $values[] = $i;
        }
        return $values;
    }
}
