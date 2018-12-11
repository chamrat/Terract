<?php

use Illuminate\Database\Seeder;

class ChatterTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

                // CREATE THE CATEGORIES

        \DB::table('chatter_categories')->delete();

        \DB::table('chatter_categories')->insert([
            0 => [
                'id'         => 1,
                'parent_id'  => null,
                'order'      => 1,
                'name'       => 'Introductions',
                'color'      => '#E67E22',
                'slug'       => 'introductions',
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id'         => 2,
                'parent_id'  => null,
                'order'      => 2,
                'name'       => 'Find a Roommate',
                'color'      => '#ffce00',
                'slug'       => 'general',
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id'         => 3,
                'parent_id'  => null,
                'order'      => 3,
                'name'       => 'Random',
                'color'      => '#f0e6e3',
                'slug'       => 'other',
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id'         => 4,
                'parent_id'  => null,
                'order'      => 4,
                'name'       => 'About Terract',
                'color'      => '#6a74b7',
                'slug'       => 'random',
                'created_at' => null,
                'updated_at' => null,
            ],
            4 => [
                'id'         => 5,
                'parent_id'  => 4,
                'order'      => 1,
                'name'       => 'Rules',
                'color'      => '#6a74b7',
                'slug'       => 'rules',
                'created_at' => null,
                'updated_at' => null,
            ],
            5 => [
                'id'         => 6,
                'parent_id'  => 4,
                'order'      => 2,
                'name'       => 'Terract FAQ',
                'color'      => '#6a74b7',
                'slug'       => 'basics',
                'created_at' => null,
                'updated_at' => null,
            ],
            6 => [
                'id'         => 7,
                'parent_id'  => 4,
                'order'      => 3,
                'name'       => 'Using Terract',
                'color'      => '#6a74b7',
                'slug'       => 'contribution',
                'created_at' => null,
                'updated_at' => null,
            ],
            7 => [
                'id'         => 8,
                'parent_id'  => null,
                'order'      => 5,
                'name'       => 'General Discussion',
                'color'      => '#e99d56',
                'slug'       => 'about',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);

        // CREATE THE DISCUSSIONS

        \DB::table('chatter_discussion')->delete();

        \DB::table('chatter_discussion')->insert([
            0 => [
                'id'                  => 3,
                'chatter_category_id' => 2,
                'title'               => "Hello Everyone, I'm looking for a roommate",
                'user_id'             => 6,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2018-08-18 14:27:56',
                'updated_at'          => '2018-08-18 14:27:56',
                'slug'                => 'hello-everyone-this-is-my-introduction',
                'color'               => '#239900',
            ],
            1 => [
                'id'                  => 6,
                'chatter_category_id' => 2,
                'title'               => 'Just Checking Out the Forums',
                'user_id'             => 5,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:39:36',
                'updated_at'          => '2016-08-18 14:39:36',
                'slug'                => 'login-information-for-chatter',
                'color'               => '#1a1067',
            ],
            2 => [
                'id'                  => 7,
                'chatter_category_id' => 3,
                'title'               => 'About 555 Park Avenue Apartments',
                'user_id'             => 3,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2018-08-18 14:42:29',
                'updated_at'          => '2018-08-18 14:42:29',
                'slug'                => 'leaving-feedback',
                'color'               => '#8e1869',
            ],
            3 => [
                'id'                  => 8,
                'chatter_category_id' => 2,
                'title'               => 'Trying to find a cat friendly roommmate',
                'user_id'             => 7,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:46:38',
                'updated_at'          => '2016-08-18 14:46:38',
                'slug'                => 'just-a-random-post',
                'color'               => '',
            ],
            4 => [
                'id'                  => 9,
                'chatter_category_id' => 6,
                'title'               => 'Welcome to Terract',
                'user_id'             => 8,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2018-11-18 14:59:37',
                'updated_at'          => '2018-11-18 14:59:37',
                'slug'                => 'welcome-to-terract',
                'color'               => '',
            ],
        ]);

        // CREATE THE POSTS

        \DB::table('chatter_post')->delete();

        \DB::table('chatter_post')->insert([
                    0 => [
                        'id'                    => 1,
                        'chatter_discussion_id' => 3,
                        'user_id'               => 6,
                        'body'                  => '<p>My name is Jack Ma and I own Ali Baba. I live at 555 park avenue. Looking for a roommate so hit me up</p>',
                        'created_at' => '2018-09-18 14:27:56',
                        'updated_at' => '2018-09-18 14:27:56',
                    ],
                    1 => [
                        'id'                    => 5,
                        'chatter_discussion_id' => 6,
                        'user_id'               => 5,
                        'body'                  => '<p>Hey!</p>
        <p>What\'s up folks</p>',
                    'created_at' => '2018-09-18 14:39:36',
                    'updated_at' => '2018-09-18 14:39:36',
                ],
                2 => [
                    'id'                    => 6,
                    'chatter_discussion_id' => 7,
                    'user_id'               => 1,
                    'body'                  => '<p>I saw some strange guy hanging around this area. A guy named Chamal.</p>',
                'created_at' => '2018-08-18 14:42:29',
                'updated_at' => '2018-08-18 14:42:29',
            ],
            3 => [
                'id'                    => 7,
                'chatter_discussion_id' => 3,
                'user_id'               => 4,
                'body'                  => '<p>Hola! I\'m interested. Let me know</p>',
                'created_at' => '2018-08-18 14:46:38',
                'updated_at' => '2018-08-18 14:46:38',
            ],
            4 => [
                'id'                    => 2,
                'chatter_discussion_id' => 8,
                'user_id'               => 7,
            'body'                      => '<p>I need to find a cat friendly roommate</p>
        <p><img src="https://media.giphy.com/media/5Vy3WpDbXXMze/giphy.gif" alt="" width="250" height="141" /></p>
        <p><img src="https://media.giphy.com/media/XNdoIMwndQfqE/200.gif" alt="" width="200" height="200" /></p>',
            'created_at' => '2018-08-18 14:55:42',
            'updated_at' => '2018-08-18 15:45:13',
        ],
        5 => [
            'id'                    => 9,
            'chatter_discussion_id' => 9,
            'user_id'               => 8,
            'body'                  => '<p>Hey There!</p>
        <p>This app will help you manage your tenants in a much more efficient manner if you know what I mean.</p>',
            'created_at' => '2016-08-18 14:59:37',
            'updated_at' => '2016-08-18 14:59:37',
        ],
        6 => [
            'id'                    => 10,
            'chatter_discussion_id' => 9,
            'user_id'               => 6,
            'body'                  => '<p>Hell yeah Bro Sauce!</p>
        <p><img src="https://media.giphy.com/media/j5QcmXoFWl4Q0/giphy.gif" alt="" width="366" height="229" /></p>',
            'created_at' => '2016-08-18 15:01:25',
            'updated_at' => '2016-08-18 15:01:25',
        ],
        ]);
    }
}
