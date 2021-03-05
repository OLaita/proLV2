<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'min:3|max:32',
            'email' => 'min:10|max:32',
        ]);

        $vid = Video::where('user',Auth::user()->name)->get();
        foreach($vid as $video){
            $video->user = $request->name;
            $video->save();
        }

        $com = Comments::where('user',Auth::user()->name)->get();
        foreach($com as $comments){
            $comments->user = $request->name;
            $comments->save();
        }

        $user = Auth::user();

        $user->name = $request->name;
        $user->name = $request->email;
        $user->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $videos = Video::where('user',$user->name)->get();
        return view('user.profile',compact('user','videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:3|max:32',
        ]);

        $user = Auth::user();
        $password = bcrypt($request->password);

        $user->password = $password;
        $user->save();

        return redirect()->back()->withSuccess('Password actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
