<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Source;
use App\Traits\MyTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeRequestController extends Controller
{
    use MyTrait;

    public function index()
    {
        $posts = Post::join('sources', 'sources.id', '=', 'posts.source')
            ->join('users', 'users.id', '=', 'posts.user')
            ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('admin.income_requests.index', compact('posts'));
    }

    public function add(Request $request)
    {

      //  return $request;

        if(Auth::user()->add_permission != 1){
            return redirect()->route('all_posts_of_user')->with('danger', 'you are not allowed to add posts');
        }

        if (Post::where('link', '=', $request->link)->exists()) {
            return redirect()->route('all_posts_of_user')->with('danger', 'Post Already Exists!');
        }

        $data = array();
        $data['date'] = $request->date;
        $data['link'] = $request->link;
        $data['source'] = $request->source;
        $data['complain_status'] = 123;


        if ($request->status == 0) {
            $data['status'] = 'Positive';
        } elseif ($request->status == 1) {
            $data['status'] = 'Negative';
        }else{
            $data['status'] = 'N/A';
        }
        $data['user'] = Auth::user()->id;

        if($request->short_desc){
            $data['short_desc'] = $request->short_desc;
        }else{
            $data['short_desc'] = '';
        }
        if($request->long_desc){
            $data['long_desc'] = $request->long_desc;
        }else{
            $data['long_desc'] = '';
        }

        if($request->keyword){
            $data['keyword'] = $request->keyword;
        }else{
            $data['keyword'] = '';
        }

        if($request->type){
            $data['type'] = $request->type;
        }else{
            $data['type'] = 6;
        }

        if($request->creator_name){
            $data['creator_name'] = $request->creator_name;
        }else{
            $data['creator_name'] = '';
        }
        $current_timestamp = Carbon::now()->timestamp;
        $creator_image_file = $request->file('creator_image');
        if ($creator_image_file) {
            $name = $creator_image_file->getClientOriginalName();
            $creator_image_file->move('assets/images/creators', Carbon::now()->timestamp.$name);
            $image = Carbon::now()->timestamp.$name;
            $data['creator_image'] = $image;
        }
        else{
            $data['creator_image'] = '';
        }

        if($request->creator_link){
            $data['creator_link'] = $request->creator_link;
        }else{
            $data['creator_link'] = '';
        }


        $relateds = array();
        if($request->related_to){
            foreach ($request->related_to as $related) {

                $relateds[] = $related;
            }
            $data['related_to'] =  implode(",", $relateds);
        }else{
            $data['related_to'] = '';
        }


        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('assets/images', Carbon::now()->timestamp.$name);
                $images[] = Carbon::now()->timestamp.$name;
            }
            $data['images'] = implode("|", $images);
        }else{
            $data['images'] = '';
        }

        $screenshots = array();
        if ($files = $request->file('screenshots')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('assets/images', Carbon::now()->timestamp.$name);
                $screenshots[] = Carbon::now()->timestamp.$name;
            }
            $data['screenshots'] = implode("|", $screenshots);
        }else{
            $data['screenshots'] = '';
        }

      // return $request;

        Post::create($data);

        return redirect()->route('all_posts_of_user')->with('success', 'Post Added Successfully!');
    }

    public function show($id)
    {

        $post = Post::where('posts.id', $id)
            ->join('sources', 'sources.id', '=', 'posts.source')
            ->join('users', 'users.id', '=', 'posts.user')
            ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'sources.id as s_id', 'users.id as user_id','users.name as username', 'users.image as user_image')->first();

        return view('admin.income_requests.show', compact('post',));
    }

    public function editPostAdmin($id)
    {
        $sources = Source::get();
        $post = Post::where('posts.id', $id)
            ->join('sources', 'sources.id', '=', 'posts.source')
            ->join('users', 'users.id', '=', 'posts.user')
            ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'sources.id as s_id', 'users.name as username', 'users.image as user_image')->first();

        return view('admin.posts.edit_post', compact('post', 'sources'));
    }

    public function UpdateAdmin(Request $request)
    {
        $data = array();
        $data['date'] = $request->date;
        $data['link'] = $request->link;
        $data['source'] = $request->source;


        if ($request->status == 0) {
            $data['status'] = 'Positive';
        } elseif ($request->status == 1) {
            $data['status'] = 'Negative';
        }else{
            $data['status'] = 'N/A';
        }

        if($request->short_desc){
            $data['short_desc'] = $request->short_desc;
        }else{
            $data['short_desc'] = '';
        }
        if($request->long_desc){
            $data['long_desc'] = $request->long_desc;
        }else{
            $data['long_desc'] = '';
        }

        if($request->keyword){
            $data['keyword'] = $request->keyword;
        }else{
            $data['keyword'] = '';
        }

        if($request->related_to){
            $data['related_to'] = $request->related_to;
        }else{
            $data['related_to'] = '';
        }


        $images = array();
        if($request->file('images') != ''){
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('assets/images', Carbon::now()->timestamp.$name);
                    $images[] = Carbon::now()->timestamp.$name;
                }
                $data['images'] = implode("|", $images);
            }
        }


        $screenshots = array();
        if($request->file('screenshots') != ''){
            if ($files = $request->file('screenshots')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('assets/images', Carbon::now()->timestamp.$name);
                    $screenshots[] = Carbon::now()->timestamp.$name;
                }
            $data['screenshots'] = implode("|", $screenshots);
        }
        }

      // return $data;

        Post::where('id', $request->id)->update($data);
        return redirect()->route('admin_all_posts')->with('success', 'post updated successfully');
    }

    public function deletePostAdmin($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('admin_all_posts')->with('success', 'post deleted successfully');
    }



    public function delete($id)
    {
        if (Auth::user()->delete_permission == 1) {
            Post::where('id', $id)->delete();
            return redirect()->route('posts_user')->with('success', 'post deleted successfully');
        } else {
            return redirect()->route('posts_user')->with('danger', 'not allowed to you');
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {

            $posts = [];

            $posts = Post::where('keyword', 'LIKE', '%' . $request->search_value . "%")
                ->orWhere('short_desc', 'LIKE', '%' . $request->search_value . "%")
                ->orWhere('long_desc', 'LIKE', '%' . $request->search_value . "%")
                ->orWhere('related_to', 'LIKE', '%' . $request->search_value . "%")
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->orderBy('date', 'DESC')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->get();

            if ($posts) {
                return json_encode($posts);
            } else {
                $posts = [];
                return json_encode($posts);
            }
        }
    }

    public function filtterPostsDate(Request $request)
    {
        $value = $request->value;
        $sources = Source::latest()->get();

        if ($value == 1) {
            //tody
            $posts = Post::where('date', '=', Carbon::today())
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } elseif ($value == 2) {
            //yester day
            $yesterday = date("Y-m-d", strtotime('-1 days'));
            $posts = Post::where('date', $yesterday)
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } elseif ($value == 3) {
            //last 7 days
            $last_seven_days = Carbon::today()->subDays(7);
            $posts = Post::where('date', '>=', $last_seven_days)
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } elseif ($value == 4) {
            //last month
            $posts = Post::where('date', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        } else {
            $posts = Post::join('sources', 'sources.id', '=', 'posts.source')
                ->join('users', 'users.id', '=', 'posts.user')
                ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);

            return view('admin.posts.all_posts', compact('posts', 'sources'));
        }
    }
    public function searchPostsDateRange(Request $request)
    {
        $sources = Source::get();

        $start_date = $request->start_date;
        $end_date = Carbon::parse($request->end_date)->addDay();



        if($request->source == 0){
            $posts = Post::whereBetween('date', [$start_date, $end_date])
            ->join('sources', 'sources.id', '=', 'posts.source')
            ->join('users', 'users.id', '=', 'posts.user')
            ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);
        }else{
            $posts = Post::where('source', $request->source)
            ->whereBetween('date', [$start_date, $end_date])
            ->join('sources', 'sources.id', '=', 'posts.source')
            ->join('users', 'users.id', '=', 'posts.user')
            ->select('posts.*', 'sources.name as s_name', 'sources.image as s_image', 'users.name as username')->paginate(10);
        }


          //  return $posts;
        return view('admin.posts.all_posts', compact('posts', 'sources'));
    }
}
