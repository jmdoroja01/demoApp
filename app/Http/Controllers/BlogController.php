<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->route('login')->with('error', 'Please log in to access the blog page.');
        }
        $blogs = Blog::with('user', 'comments.user')->whereNot('user_id', session('user')->id)->get()->all();
        return view('blog', compact('blogs'));
    }
    public function showCreateForm()
    {
        $blogs = Blog::with('user', 'comments.user')->where('user_id', session('user')->id)->get()->all();
        return view('blogCreate', compact('blogs'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|',
        ], [
            'title.required' => 'Please enter a title for your blog post.',
            'content.required' => 'Please enter content for your blog post.',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');

        //dd($request->all());

        DB::beginTransaction();

        try {
            $blog = new Blog();
            $blog->title = $title;
            $blog->content = $content;
            $blog->user_id = session('user')->id;
            $blog->save();
            DB::commit();

            $blogs = Blog::with('user', 'comments.user')->get()->all();
            return back()->with('success', 'Blog post created successfully.')->with('blogs', $blogs);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to create blog post.']);
        }
    }
    public function showEditForm(Request $request)
    {
        $blogID = $request->input('id');
        $blogs = Blog::with('user', 'comments.user')->find($blogID);
        return view('blogEdit', compact('blogs'));
    }
    public function edit(Request $request)
    {
        $blogID = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');

        $blog = Blog::findOrFail($blogID);

        $blog->title = $title;
        $blog->content = $content;
        $blog->save();

        return redirect()->route('blog.create.show')->with('success', 'Blog post updated successfully.');
    }
    public function destroy(Request $request)
    {
        $blogID = $request->input('id');
        $blog = Blog::findOrFail($blogID);
        $blog->delete();

        return redirect()->route('blog.create.show')->with('success', 'Blog post deleted successfully.');
    }
    public function comment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'Please enter a comment.',
        ]);

        $comment = new Comment();
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = session('user')->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
