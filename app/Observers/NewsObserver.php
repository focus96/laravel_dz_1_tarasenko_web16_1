<?php

namespace App\Observers;

use App\Models\News;
use Illuminate\Support\Facades\Cache;

class NewsObserver
{
    /**
     * Listen to the News created event.
     *
     * @param News $news
     *
     * @return void
     */
    public function created(News $news)
    {
        $this->refreshNewsCache();
    }

    /**
     * Listen to the News updated event.
     *
     * @param News $news
     *
     * @return void
     */
    public function updated(News $news)
    {
        $this->refreshNewsCache();
    }

    /**
     * Listen to the News deleted event.
     *
     * @param News $news
     *
     * @return void
     */
    public function deleted(News $news)
    {
        $this->refreshNewsCache();
    }

    /**
     * Refresh cache for News on 60 minutes.
     *
     * @return void
     */
    public function refreshNewsCache()
    {
        Cache::forget('news');
        Cache::put('news', News::all(), 60);
    }
}
