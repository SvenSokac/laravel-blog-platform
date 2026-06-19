<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $blogId)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|min:3|max:1000',
        ]);

        $blog = Blog::findOrFail($blogId);

        $comment = Comment::create([
            'blog_id' => $blogId,
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'comment' => $this->formatComment($comment),
        ]);
    }

    public function storeReply(Request $request, $blogId, $commentId)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|min:3|max:1000',
        ]);

        $blog = Blog::findOrFail($blogId);
        $parentComment = Comment::findOrFail($commentId);

        $reply = Comment::create([
            'blog_id' => $blogId,
            'parent_id' => $commentId,
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'reply' => $this->formatComment($reply),
        ]);
    }

    public function likeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->increment('likes');

        return response()->json([
            'success' => true,
            'likes' => $comment->likes,
        ]);
    }

    private function formatComment(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'author_name' => $comment->author_name,
            'content' => $comment->content,
            'likes' => $comment->likes,
            'date' => $comment->created_at->format('M d, Y'),
            'created_at' => $comment->created_at,
        ];
    }
}
