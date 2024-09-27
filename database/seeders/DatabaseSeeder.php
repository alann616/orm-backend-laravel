<?php

namespace Database\Seeders;

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
        // Creates 3 groups
        Group::factory(3)->create();

        // Creates levels: Gold, Silver and Bronze
        Level::factory()->create(['name' => 'Gold']);
        Level::factory()->create(['name' => 'Silver']);
        Level::factory()->create(['name' => 'Bronze']);

        // Creates 5 users and associates a profile, location, groups, image
        User::factory(5)->create()->each(function($user) {
            // Creates a profile associated with the user
            $profile = $user->profile()->save(Profile::factory()->make());

            // Creates a location associated with the profile
            $profile->location()->save(Location::factory()->make());

            // Associates the user with a group
            $user->groups()->attach($this->array(rand(1, 3)));

            // Associates an image with the user
            $user->image()->save(Image::factory()->make(['url' => 'https://lorempixel.com/90/90']));
        });

        // Creates 4 categories
        Category::factory(4)->create();

        // Creates 12 tags
        Tag::factory(12)->create();

        // Creates 40 posts and associates images, tags and comments
        Post::factory(40)->create()->each(function($post) {
            // Associates an image with the post
            $post->image()->save(Image::factory()->make());

            // Associates tags with the post
            $post->tags()->attach($this->array(rand(1, 12)));

            // Creates a random number of comments
            $number_comments = rand(1, 6);
            for ($i = 0; $i < $number_comments; $i++) {
                $post->comments()->save(\App\Models\Comment::factory()->make());
            }
        });

        // Creates 40 videos and associates images, tags and comments
        Video::factory(40)->create()->each(function($video) {
            // Associates an image with the video
            $video->image()->save(Image::factory()->make());

            // Associates tags with the video
            $video->tags()->attach($this->array(rand(1, 12)));

            // Creates a random number of comments
            $number_comments = rand(1, 6);
            for ($i = 0; $i < $number_comments; $i++) {
                $video->comments()->save(\App\Models\Comment::factory()->make());
            }
        });
    }

    /**
     * Returns an array of values from 1 to $max
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
