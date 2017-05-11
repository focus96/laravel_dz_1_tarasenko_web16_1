<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use Auth;
use Illuminate\Support\Facades\Cache;

<<<<<<< HEAD
class NewsController extends Controller {

    public function __construct() {
        $this->middleware('gate:moderator', [
            'only' => ['create', 'edit', 'store', 'update']
        ]);
        $this->middleware('gate:admin', [
            'only' => ['destroy']
        ]);
    }

=======
class NewsController extends Controller
{
>>>>>>> 9f3bbbc04b77e4380ebfc1a8e34c48941eccd494
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$news = Cache::remember('news', 60, function () {
        //            return News::all();
        //        });

<<<<<<< HEAD
        $news = News::partialContent()->paginate(10);
=======
        $news = News::select(
                        DB::raw('substr(content, 1, 300) as content, '
                                .'id, title, slug, created_at, updated_at'))
                ->orderBy('created_at', 'desk')
                ->paginate(10);

>>>>>>> 9f3bbbc04b77e4380ebfc1a8e34c48941eccd494
        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $user = Auth::user();
        $user->news()->create($request->all());

        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\News $news
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);

        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $news
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        return view('news.forms.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News         $news
     *
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        // Old variant
        $news = News::find($request->id); //Уже существует!
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->update();
        // END old variant
        // New variant - не записывает обновления
//        dd($request);
//        $news->update($request->all());

        return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\News $news
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy(News $news) {
        News::destroy($news->id);

        return redirect('news');
    }
}
