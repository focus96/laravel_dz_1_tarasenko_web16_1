@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <div class="panel-heading">
                    <h1>Новости</h1>  

                    <!-- Link news/create -->
                    <a href="{{ route('news.create') }}"
                       onclick="event.preventDefault();
                               document.getElementById('create-form').submit();">
                        Добавить новость
                    </a>

                    <form id="create-form" action="{{ route('news.create') }}" method="GET" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <!-- END Link news/create -->

                </div> 
                <div class="panel-body"> 
                    @foreach($news as $item)
                    <h1>
                        <!-- Link news/show -->
                        <a href="{{ route('news.show', $item->id) }}"
                           onclick="event.preventDefault();
                                   document.getElementById('show-form<?php echo $item->id;?>').submit();">
                            {{ $item->title }}
                        </a>

                        <form id="show-form{{$item->id}}" action="{{ route('news.show', $item->id) }}" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <!-- END Link news/show -->
                    </h1>
                    <p>{!! $item->markdownContent !!}</p>

                    <div>
                        <p>{{$item->created_at}}</p>
                    </div>
                    <hr>
                    @endforeach
                    {{ $news->links() }}
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection