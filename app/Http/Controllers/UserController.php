<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;
use App\Models\Source;
use App\Models\User;
use App\Traits\MyTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use MyTrait;

    public function users()
    {

        $users = User::select('users.name as name', 'users.id as id', 'users.image as image')
            ->selectRaw('(SELECT COUNT(*)  FROM `posts` WHERE posts.user = users.id ) AS `post_count` ')
            ->orderBy('post_count', 'DESC')
            ->get();

        $admins = Admin::get();

        return view('admin.users.all_users', compact('users','admins'));
    }

    public function searchUsersFromTo(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $users = User::select('users.name as name', 'users.id as id', 'users.image as image')
        ->selectRaw('(SELECT COUNT(*)  FROM `posts` WHERE posts.date BETWEEN "' . $start_date . '" AND "' . $end_date . '" AND posts.user = users.id ) AS `post_count` ')
        ->orderBy('post_count', 'DESC')
        ->get();

        $admins = Admin::get();

        return view('admin.users.all_users', compact('users','admins'));
    }


    /* start reports */

    public function getPostsOfUser($user_id)
    {
        $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
            ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE posts.user = ' . $user_id . ' AND posts.source = sources.id ) AS `post_count`')
            ->orderBy('post_count', 'DESC')
            ->get();

        $user = User::where('id', $user_id)->first();


        return json_encode([
            'posts' => $sources,
            'user' => $user,
        ]);
    }

    public function searchPostsOfUserFromToDate(Request $request)
    {
        $user_id = $request->user_id;
        $start_date = $request->posts_start_date;
        $end_date = $request->posts_end_date;

        $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
            ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE posts.date BETWEEN "' . $start_date . '" AND "' . $end_date . '" AND posts.user = ' . $user_id . ' AND posts.source = sources.id ) AS `post_count`')
            ->orderBy('post_count', 'DESC')
            ->latest()->take(5)->get();

        $user = User::where('id', $user_id)->first();


        return json_encode([
            'posts' => $sources,
            'user' => $user,
        ]);
    }


    public function filtterPostsDateRelatedToUser(Request $request)
    {
        $value = $request->date_value;
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        if ($value == 1) {
            //tody
            $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
                ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE posts.date = CURDATE() AND posts.user = ' . $user_id . ' AND  posts.source = sources.id ) AS `post_count`')
                ->orderBy('post_count', 'DESC')
                ->get();

            return json_encode([
                'posts' => $sources,
                'user' => $user,
            ]);
        } elseif ($value == 2) {
            //yesterday
            $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
                ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE DATE( posts.date)= CURRENT_DATE()-1 AND posts.user = ' . $user_id . ' AND posts.source = sources.id ) AS `post_count`')
                ->orderBy('post_count', 'DESC')
                ->get();

            return json_encode([
                'posts' => $sources,
                'user' => $user,
            ]);
        } elseif ($value == 3) {
            //last 7 days

            $last_seven_days = Carbon::today()->subDays(7);

            $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
                ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE posts.date >=' . '"' . $last_seven_days . '"' . ' AND posts.user = ' . $user_id . ' AND posts.source = sources.id ) AS `post_count`')
                ->orderBy('post_count', 'DESC')
                ->get();



            return json_encode([
                'posts' => $sources,
                'user' => $user,
            ]);
        } elseif ($value == 4) {
            //last month

            $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
                ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE DATE( posts.date) > NOW() - INTERVAL 30 DAY AND posts.user = ' . $user_id . ' AND posts.source = sources.id ) AS `post_count`')
                ->orderBy('post_count', 'DESC')
                ->get();

            return json_encode([
                'posts' => $sources,
                'user' => $user,
            ]);
        } else {
            $sources = Source::select('sources.name as name', 'sources.image as image', 'sources.id as s_id')
                ->selectRaw('( SELECT COUNT(*) FROM `posts` WHERE posts.user = ' . $user_id . ' AND posts.source = sources.id ) AS `post_count`')


                ->orderBy('post_count', 'DESC')
                ->get();

            return json_encode([
                'posts' => $sources,
                'user' => $user,
            ]);
        }
    }

    public function getUserPostesInSelectDate($user_id, $date_value, $source_id)
    {
        $value = $date_value;
        $sources = Source::latest()->get();

        if ($value == 1) {
            //tody
            $posts = Post::where('date', '=', Carbon::today())
                ->where('user', $user_id)
                ->where('source', $source_id)
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } elseif ($value == 2) {
            //yester day
            $yesterday = date("Y-m-d", strtotime('-1 days'));
            $posts = Post::where('date', $yesterday)
                ->where('user', $user_id)
                ->where('source', $source_id)

                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } elseif ($value == 3) {
            //last 7 days
            $last_seven_days = Carbon::today()->subDays(7);
            $posts = Post::where('date', '>=', $last_seven_days)
                ->where('user', $user_id)
                ->where('source', $source_id)
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } elseif ($value == 4) {
            //last month
            $posts = Post::where('date', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->where('user', $user_id)
                ->where('source', $source_id)
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } else {
            $posts = Post::where('user', $user_id)
                ->where('source', $source_id)
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        }
    }

    public function getUserPostesInFromTo($user_id, $start_date, $end_date, $source_id)
    {

        $sources = Source::latest()->get();

        $posts = Post::whereBetween('date', [$start_date, $end_date])
            ->where('user', $user_id)
            ->where('source', $source_id)
            ->join('sources', 'sources.id', '=', 'posts.source')
            ->join('users', 'users.id', '=', 'posts.user')
            ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);


        return view('admin.posts.all_posts', compact('posts', 'sources'));
    }


    /* end reports */

    public function newUser()
    {
        return view('admin.users.add_user');
    }

    public function newAdmin()
    {
        return view('admin.users.add_admin');
    }

    public function add(Request $request)
    {

        // return $request;

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]
        );

        $file = $request->file('image');
        $image_name = $file->getClientOriginalName();
        $file->move('assets/images', $image_name);
        $image = $image_name;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $image,
            'password' => Hash::make($request->password),
            'add_permission' => $request->add_permission,
            'read_permission' => $request->read_permission,
            'edit_permission' => $request->edit_permission,
            'delete_permission' => $request->delete_permission,
            'job' => 'ok',
            'progress' => 0,
        ]);

        return redirect()->route('all_users')->with('success', 'user added successfully');
    }

    public function addAdmin(Request $request)
    {

        // return $request;

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]
        );

        $file = $request->file('image');
        $image_name = $file->getClientOriginalName();
        $file->move('assets/images', $image_name);
        $image = $image_name;

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $image,
            'password' => Hash::make($request->password),
            'job' => $request->job,
            'is_super' => $request->is_super,
            'posts_permission' =>  $request->posts_permission,
            'complaints_permission' =>  $request->complaints_permission,
            'sources_permission' =>  $request->sources_permission,
            'users_permission' =>  $request->users_permission,
            'dept_permission' =>  $request->dept_permission,
            'reports_permission' =>  $request->reports_permission,
            'advanced_permission' =>  $request->advanced_permission,
            'related_permission' =>  $request->related_permission,
            'posts_report_permission' =>  $request->posts_report_permission,
            'types_permission' =>  $request->types_permission,
            'dept_report_permission' =>  $request->dept_report_permission,
        ]);

        return redirect()->route('all_users')->with('success', 'admin added successfully');
    }

    public function viewUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.users.view_user', compact('user'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $file = $request->file('image');
        $data = array();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['add_permission'] = $request->add_permission;
        $data['read_permission'] = $request->read_permission;
        $data['edit_permission'] = $request->edit_permission;
        $data['delete_permission'] = $request->delete_permission;

        if ($file) {
            $image_name = $file->getClientOriginalName();
            $file->move('assets/images', Carbon::now()->timestamp . $image_name);
            $image = Carbon::now()->timestamp . $image_name;
            $data['image'] = $image;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect()->route('all_users')->with('success', 'user updated successfully');
    }



    public function deleteAdmin($id)
    {
        if (Auth::guard('admin')->user()->is_super == 1) {
            Admin::where('id', $id)->delete();
            return redirect()->route('all_users')->with('success', 'admin deleted successfully');
        }

        return redirect()->route('all_users')->with('danger', 'you must be super admin to perform this action');
    }
}
