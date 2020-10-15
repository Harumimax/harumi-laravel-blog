<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleValidate;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10);

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function create()
    {
        // Передаём в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
        $article = new Article();
        return view('article.create', compact('article'));
    }

    public function store(ArticleValidate $request)
    {
        // Проверка введённых данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        /*
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:1000',
        ]);
        */
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

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

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
