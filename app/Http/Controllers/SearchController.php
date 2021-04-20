<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoView;
use App\Models\Puntuaciones;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
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
            'search'=>'required',
        ]);
        $id = $request->search;
        $videos = VideoView::where('title', 'like', '%'.$id.'%')->get();

        //dd($videos);

        return view('videos.search',compact('videos','id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videos = VideoView::where('name',$id)->get();
        //dd($videos);
        return view('videos.search',compact('videos','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user() == null){
            return redirect()->route('login');
        }

        $user = Auth::user()->id;

        $punt = Puntuaciones::where("video_id",$id)->where("user",$user)->get();

        if(count($punt) <= 0){
            Puntuaciones::create(['video_id'=>$id,'user'=>$user,'voto'=>true]);
            $p = "tr";
        }elseif($punt[0]->voto == 1){
            $videos=Video::find($id);
            $pun=Video::find($id)->puntos;
            $vis=Video::find($id)->visitas;
            $videos->update(['puntos'=>$pun-1,'visitas'=>$vis-1]);
            $punt[0]->update(['voto'=>false]);
            $p = "fa";
            return redirect()->route("vid.show",[$id, $p]);

        }else{
            $punt[0]->update(['voto'=>true]);
            $p = "tr";
        }

        $videos=Video::find($id);
        $pun=Video::find($id)->puntos;
        $vis=Video::find($id)->visitas;
        $videos->update(['puntos'=>$pun+1,'visitas'=>$vis-1]);
        return redirect()->route("vid.show",[$id, $p]);
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
        //
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
