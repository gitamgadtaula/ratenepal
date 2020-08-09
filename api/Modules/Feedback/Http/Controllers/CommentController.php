<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Feedback\Entities\Comment;
use Modules\User\Entities\User;

class CommentController extends Controller
{


    public function postComment(Request $req, $shop_id)
    {
        $comment = $req->comment;
        $user_id = auth()->user()->id;
        $result = Comment::create([
            'shop_id' => $shop_id,
            'user_id' => $user_id,
            'comment' => $comment
        ]);
        if (!$result) {
            return response()->json(['msg' => 'failed posting the comment']);
        }
        return response()->json(['msg' => 'successfully posted comment']);
    }
    public function getAllCommentsOnShop($shop_id)
    {
        $result = Comment::select('comment', 'created_at', 'user_id')->with('users')->where([
            ['shop_id', '=', $shop_id]
        ])->get();
        // $result = Comment::where('id',1)->users->get();

        //     if (sizeOf($result) === 0) {
        //         return response()->json('No comments yet');
        // }
        return response()->json(['comments' => $result]);
    }
}
