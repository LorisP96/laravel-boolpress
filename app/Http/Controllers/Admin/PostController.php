<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNewEmailPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $form_data = $request->all();
        
        $new_post = new Post();

        $new_post->fill($form_data);
        if(isset($form_data['image'])) {
            $img_path = Storage::put('post-covers', $form_data['image']);
            $new_post['cover'] = $img_path;
        }
        $new_post->slug = $this->getSlugFromTitle($new_post->title);
        $new_post->save();
        if (isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }
        // email
        Mail::to('admin@boolpress.it')->send(new AdminNewEmailPost($new_post));

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $categories = Category::all();

        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.edit', $data);
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
        $request->validate($this->getValidationRules());
        $form_data = $request->all();
        $post_to_update = Post::findOrFail($id);
        if ($form_data['title'] !== $post_to_update->title) {
            $form_data['slug'] = $this->getSlugFromTitle($post_to_update->title);
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }
        if($form_data['image']) {
            if($post_to_update->cover) {
                Storage::delete($post_to_update->cover);
            }
            $img_path = Storage::put('post-covers', $form_data['image']);

            $post_to_update->cover = $img_path;
        }

        $post_to_update->update($form_data);
        if (isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }
        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_destroy = Post::findOrFail($id);
        $post_to_destroy->tags()->sync([]);
        if($post_to_destroy->cover) {
            Storage::delete($post_to_destroy->cover);
        }
        $post_to_destroy->delete();

        return redirect()->route('admin.posts.index');
    }

    protected function getSlugFromTitle($title) {
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        $existing_slug = Post::where('slug', '=', $slug_to_save)->first();
        $counter = 1;
        while($existing_slug) {
            $slug_to_save = $slug_base . '-' . $counter;

            $existing_slug = Post::where('slug', '=', $slug_to_save)->first();

            $counter++;
        }
        return $slug_to_save;
    }

    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'image' => 'nullable|file|mimes:jpeg,jpg,bmp,png'
        ];
    }
}
