<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store() {
        Post::create(array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post) {
        $post->update($this->validatePost($post));

        return redirect('/admin/posts/' . $post->slug . '/edit')->with('success', 'Post Updated!');
    }

    public function destroy(Post $post) {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array {
        $post ??= new Post();

        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $aux = Post::where('slug', '=', Str::replace(' ', '-', strtolower($attributes['title'])));

        if ($post->exists()) {
            $aux = $aux->where('title', '!=', $post->title);
        }

        if($aux->exists()) {
            throw ValidationException::withMessages([
                'title' => 'You can\'t provide this title.'
            ]);
        }

        if($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        if($attributes['title'] ?? false) {
            $attributes['slug'] = $attributes['title'];
        }

        return $attributes;
    }
}
