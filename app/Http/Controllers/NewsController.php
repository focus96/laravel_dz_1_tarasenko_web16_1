<?php

namespace App\Http\Controllers;

use App\Models\News;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Если кешировать запрoсы выборки новостей,
        //то при добавлении или удалении какой-то записи
        //придется перезаписывать кеш для всех страниц.
        //Ладно когда у меня 3 страницы, а когда их будет 100
        //или 1000, 10000...
        //На данный момент кеширование работает при выборке всех
        //новостей. Без пагинации все работало без сбоев.
        //
        //$news = Cache::remember('news', 1, function () {
        //            return News::all();
        //        });
        
        $news = News::paginate(5);
        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('news.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request) {
        $user = Auth::user();
        $user->news()->create($request->all());
        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $news = News::find($id);
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $news = News::find($id);
        return view('news.forms.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news) {
        // Old variant
        $news = News::find($request->id); //Уже существует!
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->update();
        // END old variant
        // New variant - не записывает обновления
        //$news->update($request->all());

        return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        News::destroy($id);
        return redirect('news');
    }

}
