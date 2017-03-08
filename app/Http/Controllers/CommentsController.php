<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CommentFormRequest;

use App\Comment;

class CommentsController extends Controller
{
    function newComment(CommentFormRequest $request) {
        $comment = new Comment(
            array(
                'post_id'=>$request->get('post_id'),
                'content'=>$request->get('content'),
            )
        );
        $comment->save();

        return redirect()->back()->with(
            [
                'status' => 'Твой комментарий был добавлен.',
                'status_2' => 'А вообще можешь идти на хуй. Чмо.',
            ]
        );
    }
}
