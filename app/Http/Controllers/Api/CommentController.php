<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function get_comments($article_id)
    {
        try {
            $comments = Comment::where('article_id', $article_id)->get();
            return response()->json($comments);
        } catch (Exception $ex) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
    public function create_comment(Request $request, $article_id)
    {
        $user_id = auth()->user()->id;
        $article = Article::find($article_id);
        try {
            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->article_id = $article->id;
            $comment->content = $request->content;
            $comment->save();
            return response()->json(['message' => 'Comment added'], 201);
        } catch (Exception $ex) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    public function update_comment(Request $request, $comment_id)
    {
        try {
            $comment = Comment::find($comment_id);
            $comment->content = $request->content;
            $comment->update();
            return response()->json(['message' => 'Comment updated'], 204);
        } catch (Exception $ex) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    public function delete_comment($comment_id)
    {
        try {
            $comment = Comment::find($comment_id);
            $comment->delete();
            return response()->json(['message' => 'Comment deleted'], 204);
        } catch (Exception $ex) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
}
