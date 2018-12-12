<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Country;
use App\Extensions\CustomRequest;
use App\Image;
use App\Post;
use App\Tag;
use App\User;
use App\UserProfile;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class QueryController extends Controller
{
    public function union()
    {
        $posts_a = DB::table('posts')->where('views', 0);
        $posts_b = DB::table('posts')->where('id', '<=', 10)->union($posts_a)->get();

        dd($posts_b);
    }

    public function unionAll()
    {
        $posts_a = DB::table('posts')->where('views', 0);
        $posts_b = DB::table('posts')->where('id', '<=', 10)->unionAll($posts_a)->get();

        dd($posts_b);
    }

    public function where()
    {
        //$posts = DB::table('posts')->where('id', '<', 10)->where('views', '>', 0)->get();
        /*$posts = DB::table('posts')->where([
            ['id', '<', 10],
            ['views', '>', 0]
        ])->get();*/
        //$posts = DB::table('posts')->where('id', '<', 10)->orWhere('views', '>', 0)->get();
        // $posts = DB::table('posts')->whereNotBetween('views', [10, 100])->get();
        // $posts = DB::table('posts')->whereNotIn('user_id', [1, 3, 5, 7, 9])->get();
        // $users = DB::table('users')->whereNull('email_verified_at')->get();
        // $posts = DB::table('posts')->whereColumn('updated_at', '>', 'created_at')->get();
        /*DB::table('posts')->where('id', '<=', 10)->orWhere(function ($query) {
            $query->where('views', '>', 0)
                ->whereDate('created_at', '<', '2018-11-28')
                ->whereTime('created_at', '<', '14:00');
        })->get();*/

        /*DB::table('users')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('posts')
                    ->whereRaw('posts.user_id = users.id');
            })
            ->get();*/

        //DB::table('posts')->orderBy('created_at', 'asc')->get();

        /*$posts = DB::table('posts')
            ->groupBy('user_id')
            ->selectRaw('user_id, sum(views) as total_views')
            ->having('total_views', '>=', 10)
            ->get();

        dd($posts);*/

        /*$posts = DB::table('posts')->orderBy('created_at', 'desc')
            ->where('views', '>', 0)
            ->offset(10)->limit(5)
            ->get();*/

        //dd($posts);

        /*$users = DB::table('users')->whereNotNull('email_verified_at')->select('id');
        $posts = DB::table('posts')->whereIn('user_id', $users)->get();*/

        $posts = DB::table('posts')
            ->groupBy('user_id')
            ->select(DB::raw('user_id, sum(views) as total_views'))
            ->having('total_views', '>=', 10)
            ->get();

        //dd($posts);

        $res = DB::select('select round(avg(views), 2) as views from posts');
        dd($res);

        return view('welcome');
    }

    public function eloquent(Request $request)
    {
        //$posts = Post::all();
        /*Post::chunk(10, function ($posts) {
            foreach ($posts as $post) {
                if ($post->views == 0) {
                    continue;
                } else {
                    dump($post->title . ':' . $post->views);
                }
            }
        });*/
        /*foreach (Post::cursor() as $post) {
            dump($post->title . ':' . $post->content);
        }*/
        //$posts = Post::where('views', '>', 0)->select('id', 'title', 'content')->get();

        // $posts = Post::where('views', '>', 0)->orderBy('id', 'desc')->offset(10)->limit(5)->get();

        // $user = User::where('name', '学院君1')->first();
        //$user = User::findOrFail(111);
        //dd($user);

        /*$post = new Post($request->all());
        $post->user_id = Auth::check() ? Auth::id() : 0;
        $post->save();

        dd($post);*/

//        $post = Post::findOrFail(32);
//        $post->delete();
//        if ($post->trashed()) {
//            dump('该记录已删除');
//        }

        $post = Post::onlyTrashed()->where('views', 0)->get();
        dd($post);

        exit();
    }

    public function model(Request $request)
    {
        /*$post = new Post($request->all());
        $post->user_id = 0;
        $post->save();*/

//        $post = Post::findOrFail(32);
//        $post->fill($request->all());
//        $post->save();
//
//        dd($post);

        //$user = User::find(1);
        //$user->card_no = '6222020903001483077';
        //$user->save();

        //dd($user->card_num);

//        $users = User::all();
//        return 'success';
//
//        $user = User::find(1);
//        $user->settings = ['city' => '杭州', 'hobby' => ['读书','撸码']];
//        $user->save();
//        dd($user->settings);

        /*$posts = Post::active()->popular()->get();
        return $posts;*/

//        $articles = Post::active()->ofType(Post::ARTICLE)->get();
//        return $articles;

//        $user = User::find(1);
//        $users = User::whereBetween('id', [1, 5])->get();

//        $user = User::findOrFail(10);
//        $user->delete();

        $user = User::findOrFail(15);
        $user->name = '学院君测试号15';
        $user->save();
        exit();
    }

    public function relationship()
    {
//        $user = User::findOrFail(1);
//        $profile = $user->profile;
//        dd($profile);

//        $profile = UserProfile::findOrFail(2);
//        $user = $profile->user;
//        dd($user);

//        $user = User::findOrFail(1);
//        $posts = $user->posts;
//        dd($posts);

//        $post = Post::findOrFail(29);
//        $author = $post->author;
//        dd($author);

//        $posts = Post::with('author')
//            ->where('views', '>', 0)
//            ->offset(0)->limit(10)
//            ->get();
//        return view('welcome');

//        $post = Post::with('tags')->find(1);
//        $tags = $post->tags;
//        exit();

//        $tag = Tag::with('posts')->where('name', 'ab')->first();
//        $posts = $tag->posts;
//        exit();

//        $country = Country::findOrFail(1);
//        $posts = $country->posts;
//        dd($posts);

//        $image = Image::findOrFail(1);
//        $item = $image->imageable;
//        dd($item);

//        $post = Post::findOrFail(1);
//        $image = $post->image;
//        return view('welcome');

//        $comment = Comment::findOrFail(1);
//        $item = $comment->commentable;
//        return view('welcome');

//        $post = Post::with('comments')->findOrFail(23);
//        $comments = $post->comments;
//        //dd($comments);
//        return view('welcome');

//        $tag = Tag::with('posts', 'pages')->findOrFail(53);
//        dd($tag;

//        $post = Post::with('tags')->findOrFail(6);
//        $tags = $post->tags;
//
//        return view('welcome');

//        $user = User::findOrFail(1);
//        $posts = $user->posts()->where('views', '>', 0)->get();
//        dd($posts);

//        $users = User::has('posts')->get();
//        $users = User::has('posts', '>', 1)->get();
//        $users = User::has('posts.comments')->get();
        /*$users = User::whereHas('posts', function ($query) {
            $query->where('title', 'like', 'Laravel%')
                ->whereExists(function ($query)  {
                    $query->from('comments')
                        ->whereRaw('`posts`.`id` = `comments`.`commentable_id`')
                        ->where('content', 'like', 'Laravel%')
                        ->where('commentable_type', Post::class)
                        ->whereNull('deleted_at');
                });
        })->get();
        dd($users);
        return view('welcome');
        $users = User::whereHas('posts', function ($query) {
            $query->where('title', 'like', 'Laravel学院%');
        })->orWhereHas('posts.comments', function ($query) {
            $query->where('content', 'like', 'Laravel学院%');
        })->get();
        dd($users);
        return view('welcome');
        dd($users);*/

//        $post = $posts = Post::with('author', 'comments', 'tags')->findOrFail(14);
//        $author = $post->author;
//        return $post;

//        $post = Post::with('author.profile')->findOrFail(32);
//        return $post;

//        $posts = Post::has('comments')->orHas('tags')->get();
//        dd($posts);

//        $users = User::doesntHave('posts')->get();
//        dd($users);

//        $posts = Post::doesntHave('comments')->orDoesntHave('tags')->get();
//        return $posts;

        /*$post = Post::withCount(['comments' => function ($query) {
            $query->where('content', 'like', 'Laravel学院')
                ->orderBy('created_at', 'desc');
        }])->findOrFail(32);
        $comments_count = $post->comments_count;*/

        /*$post = Post::withCount([
            'comments',
            'comments as pending_comments' => function($query) {
                $query->where('status', Comment::PENDING);
            }
        ])->findOrFail(32);*/

        /*$post = Post::with(['comments' => function ($query) {
            $query->where('content', 'like', 'Laravel学院%')
                ->orderBy('created_at', 'desc');
        }])->where('id', '<', 5)->get();*/

        /*$users = User::all();
        $condition = true;

        if ($condition) {
            $users->load('posts');
        }
        return $users;*/

        /*$posts = Post::where('id', '<', 3)->get();
        $posts->load(['comments' => function ($query) {
            $query->where('content', 'like', 'Laravel学院%')
                ->orderBy('created_at', 'desc');
        }]);*/

        // $post = Post::findOrFail(1);
        // $faker = \Faker\Factory::create();
        /*$post->comments()->saveMany([
            new Comment(['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)]),
            new Comment(['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)]),
            new Comment(['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)]),
            new Comment(['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)]),
            new Comment(['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)])
        ]);*/

        /*$comment = new Comment();
        $comment->content = $faker->paragraph;
        $comment->user_id = mt_rand(1, 15);
        $post->comments()->save($comment);*/

        /*$post->comments()->create([
            'content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)
        ]);

        $post->comments()->createMany([
            ['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)],
            ['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)],
            ['content' => $faker->paragraph, 'user_id' => mt_rand(1, 15)]
        ]);*/

        /*$post->tags()->save(
            new Tag(['name' => $faker->word])
        );*/

        /*$user = User::findOrFail(1);
        $post->author()->associate($user);
        $post->save();*/

        /*$post->tags()->saveMany([
            new Tag(['name' => $faker->unique()->word]),
            new Tag(['name' => $faker->unique()->word]),
            new Tag(['name' => $faker->unique()->word])
        ]);*/

        //$post = Post::findOrFail(1);
        //$tag = Tag::findOrFail(1);
        //$post->tags()->attach($tag->id);
//        $post->tags()->attach([1, 2]);
//        $post->tags()->attach([
//            1 => ['user_id' => 1],
//            2 => ['user_id' => 2]
//        ]);

        //$post->tags()->detach($tag->id);

//        $comment = Comment::with('commentable')->findOrFail(31);
//        $comment->content = 'Laravel学院致力于提供优质Laravel中文学习资源';
//        $comment->save();

        //return $comment;
        $posts = Post::all();
        $faker = \Faker\Factory::create();
        foreach ($posts as $post) {
            $title = $faker->sentence;
            $post->title = trim($title, '.');
            $post->save();
        }

        return 'success';
    }
}
