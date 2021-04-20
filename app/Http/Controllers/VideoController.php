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
use App\Models\Puntuaciones;

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

        $vid=Video::find($id);
        $visi=Video::find($id)->visitas;
        $vid->update(['visitas'=>$visi+1
        ]);

        if(Auth::user()){

            $user = Auth::user()->id;
            $punt = Puntuaciones::where("video_id",$id)->where("user",$user)->get();

            if(count($punt) == 0){

                $p = "fa";
                $videos=VideoView::find($id);
                $allVid=VideoView::whereNotIn('id', [$id])->get();
                $comments = CommentView::where('idVideo',$id)->orderBy('created_at','DESC');
                return view('videos.show',compact('videos','allVid','comments','p'));
            }

            if($punt[0]->voto == 1){
                $p = "tr";
            }else{
                $p = "fa";
            }

        }else{
            $p = "fa";
        }

        $videos=VideoView::find($id);
        $allVid=VideoView::whereNotIn('id', [$id])->get();
        $comments = CommentView::where('idVideo',$id)->orderBy('created_at','DESC');
        return view('videos.show',compact('videos','allVid','comments','p'));
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

    public function vote($id)
    {

        if(Auth::user() == null){
            return redirect()->route('login');
        }

        $user = Auth::user()->id;

        $punt = Puntuaciones::where("video_id",$id)->where("user",$user)->get();

        if(count($punt) <= 0){
            Puntuaciones::create(['video_id'=>$id,'user'=>$user,'voto'=>true]);
        }elseif($punt[0]->voto == 1){
            $videos=Video::find($id);
            $pun=Video::find($id)->puntos;
            $vis=Video::find($id)->visitas;
            $videos->update(['puntos'=>$pun-1,'visitas'=>$vis-1]);
            $punt[0]->update(['voto'=>false]);
            return redirect()->route("vid.show",$id);
        }else{
            $punt[0]->update(['voto'=>true]);
        }

        $videos=Video::find($id);
        $pun=Video::find($id)->puntos;
        $vis=Video::find($id)->visitas;
        $videos->update(['puntos'=>$pun+1,'visitas'=>$vis-1]);
        return redirect()->route("vid.show",$id);
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
