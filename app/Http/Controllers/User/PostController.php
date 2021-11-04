<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\SomeonePostedEvent;
use App\Http\Controllers\Controller;
use App\Notifications\SomeonePosted;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
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
     * @param Carbon\Carbon $time
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request){
        $data = $request->only([
            'body', 'user_id', 'parent_id', 
        ]);
        if((auth()->user()->id != $data['user_id']) && (!auth()->user()->is_friends_with($request->user_id))) {
            return back()->withErrors(['message' => 'Bạn hãy kết bạn trước đã !']);
        }
        if((auth()->user()->id != $data['user_id']) && (auth()->user()->is_friends_with($data['user_id']))) {
            Post::create([
                'body' => $data['body'],
                'parent_id' => $data['user_id'],
                'user_id' => auth()->user()->id
            ]);
            $user = User::where('id', $data['user_id'])->first();
            // event(new SomeonePostedEvent($user, auth()->user()));
            $user->notify(new SomeonePosted($user, auth()->user()));
            return back();
        }
        if((auth()->user()->id = $data['user_id'])) {
            auth()->user()->posts()->create([
                'body' => $data['body'],
            ]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post){
        if((auth()->user()->id != $post->user_id) && (!auth()->user()->is_friends_with($post->user_id))){
            return back()->withErrors(['message' => 'Bạn không được quyền xóa bài viết này !']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id != $post->parent_id)){
            return back()->withErrors(['message' => 'Bạn không được quyền xóa bài viết này !']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id == $post->parent_id)){
            $post->delete();
            return back();
        }
        if(auth()->user()->id = $post->user_id){
            $post->delete();
            return back();
        }
        
    }
}
