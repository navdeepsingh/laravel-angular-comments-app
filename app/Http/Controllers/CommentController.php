<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{


    /**
     * Send back all comments as JSON
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::all();
        return Response::json($this->transformCollection($comments));
    }

    public function show($id){
        $comment = Comment::find($id);
        if (!$comment) {
            return Response::json([
                'error' => [
                    'message' => 'Comment does not exist'
                ]
            ], 404);
        }

        return Response::json($comment, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        Comment::create(array(
            'author' => Input::get('author'),
            'text' => Input::get('text')
        ));

        return Response::json(array('success' => true));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);

        return Response::json(array('success' => true));
    }

    private function transformCollection($comments){
       return array_map([$this, 'transform'], $comments->toArray());
    }

    private function transform($comment){
        return [
            'id' => $comment['id'],
            'author' => $comment['author'],
            'text' => $comment['text']
        ];
    }
}
