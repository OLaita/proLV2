<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Route;
use App\Models\Comments;
use App\Models\VideoView;
use App\Models\CommentView;

class VideoController extends Controller
{



    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }

    public function newVideo()
    {
        return view('videos.new');
    }

    public function create()
    {
        /*$video = Video::create([
            'title' => $data['name'],
            'desc' => $data['email']."@correo.com"
        ]);
        $video->save();
        return $video;*/
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
            'title'=>'required|unique:videos',
            'desc'=>'required',
            'video'=>'required',
        ]);

        $pathV=$request->file('video')->store('videos','public');
        $pathI=$request->file('image')->store('mini','public');
        $user = Auth::user()->id;
        Video::create(['title'=>$request->title,
                        'cont'=>$pathV,
                        'desc'=>$request->desc,
                        'mini'=>$pathI,
                        'user'=>$user
            ]);
        $videos=Video::all();
        return view('videos.all',compact('videos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videos=VideoView::find($id);
        $allVid=VideoView::whereNotIn('id', [$id])->get();
        $comments = CommentView::where('idVideo',$id)->orderBy('created_at','DESC');
        return view('videos.show',compact('videos','allVid','comments'));
    }

    public function allVideos()
    {
        $videos=VideoView::all();
        return view('videos.all',compact('videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos=Video::find($id);
        $users=User::all();
        return view('videos.edit',compact('videos','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $videos=Video::find($id);
        $videos->update(['title'=>$request->description,
        'desc'=>$request->price
        ]);
        $videos = Video::all();

        return view('videos.index',compact('videos'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('videos.index');
    }
}
