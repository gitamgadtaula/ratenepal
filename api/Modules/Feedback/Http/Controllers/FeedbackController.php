<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Feedback\Entities\Reply;

class FeedbackController extends Controller
{
    public function postReply(Request $req, $comment_id)
    {
        $data = Reply::create([
            'comment_id' => $comment_id,
            'user_id' => auth()->user()->id,
            'reply' => $req->reply
        ]);
        if ($data) {
            return response()->json(['msg' => 'Reply Posted']);
        }
        return response()->json(['msg' => 'failed']);
    }
    public function getAllReplies($comment_id)
    {
        $data = Reply::findOrFail($comment_id)->where('comment_id', $comment_id)->get();
        return response()->json(['data' => $data]);
    }
}
