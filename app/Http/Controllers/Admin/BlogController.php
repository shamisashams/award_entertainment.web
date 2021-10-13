<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;

use App\Repositories\BlogRepositoryInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(Blogrequest $request)
    {
        return view('admin.pages.blog.index', [
            "blogs" => $this->blogRepository->getData($request, ["languages"]),
            'languages' => $this->activeLanguages()
        ]);
    }



    public function create()
    {
        $blog = $this->blogRepository->model;
//        dd($blog);
        $url = locale_route('blog.store', [], false);
        $method = 'POST';
        return view('admin.pages.blog.form', [
            'blog' => $blog,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()

        ]);
    }

    public function show(string $lang, int $id)
    {
        $blog = $this->blogRepository->findOrFail($id);

        return view("admin.pages.blog.show", [
            "blog" => $blog,
            "languages"=>$this->activeLanguages()
        ]);

    }

    public function edit(string $locale, int $id)
    {
        $blog = $this->blogRepository->findORFail($id);
        $url = locale_route('blog.update', $blog->id, false);
        $method = 'PUT';
        return view('admin.pages.blog.form', [
            'blog' => $blog,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()
        ]);
    }

    public function store(BlogRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
            'title' => $request['title'],
            'description' => $request['description'],
            'languages' => $this->activeLanguages(),
            "shortDescription" => $request["short-description"],
            "content" => $request["content"],
            "slug" => $request["slug"],
            "city" => $request["city"],
            "country" => $request["country"],
        ];
        $blog = $this->blogRepository->create($data);

        // Save Files
        if ($request->hasFile('images')) {
            $blog = $this->blogRepository->saveFile($blog->id, $request);
        }

        return redirect(locale_route('blog.show', $blog->id))->with('success', 'Slider created.');
    }

    public function update(string $lang, int $id, BlogRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
            'title' => $request['title'],
            'description' => $request['description'],
            'languages' => $this->activeLanguages(),
            "shortDescription" => $request["short-description"],
            "content" => $request["content"],
            "slug" => $request["slug"],
            "city" => $request["city"],
            "country" => $request["country"],
        ];
        $blog = $this->blogRepository->update($id, $data);

        // Update Files
        $this->blogRepository->saveFile($id, $request);

        return redirect(locale_route('blog.show', $blog->id))->with('success', 'Blog updated.');

    }

    public function destroy(string $lang, int $id)
    {
        if (!$this->blogRepository->delete($id)) {
            return redirect(locale_route('blog.show', $id))->with('danger', 'Blog not deleted.');
        }

        return redirect(locale_route('blog.index'))->with('success', 'Blog Deleted.');

    }

}
