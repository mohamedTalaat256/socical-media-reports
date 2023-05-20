<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Source;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $last_seven_days = Carbon::today()->subDays(7);

        $users = User::select('users.name as name', 'users.id as id', 'users.image as image','users.job as job')
            ->selectRaw('(SELECT COUNT(*)  FROM `posts` WHERE posts.date >= current_date - 7 AND posts.user = users.id ) AS `post_count` ')
            ->orderBy('post_count', 'DESC')
            ->latest()->take(4)->get();



        $tags = Post::where('date', '>=', $last_seven_days)
            ->select('keyword')
            ->groupBy('keyword')
            ->distinct()
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->get();


        $posts_count = Post::count();


        return view('admin.dashboard.index', compact('users', 'posts_count',));
    }


}
