<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Http\Requests\ArticleValidate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(10);

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleValidate $request)
    {
            $data = $request->validated();

            $article = new Article();
            // Заполнение статьи данными из формы
            $article->fill($data);
            // При ошибках сохранения возникнет исключение
            $article->save();

            $request->session()->flash('flash_message', 'Статья СОЗДАНА, беач!');
            // Редирект на указанный маршрут
            return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleValidate $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validated();

        /*
        $data = $this->validate($request, [
            'name' => 'required|unique:articles,name,' . $article->id,
            'body' => 'required|min:100',
        ]);
        */
        $article->fill($data);
        $article->save();
        $request->session()->flash('flash_message', 'Статья ОБНОВЛЕНА, беач!');
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleValidate $request, $id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }
        $request->session()->flash('flash_message', 'Статья УДАЛЕНА, беач!');
        return redirect()->route('articles.index');
    }
}
