@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <a href="{{url('news')}}"><<Назад</a>
                <div class="panel-heading"><h1>{!! $news->title !!}</h1></div> 
                <div class="panel-body"> 
                    <p>{!! $news->markdownContent !!}</p>
                    
                    <div>
                        <p>{{$news->created_at}}</p>
                    </div>
                    <!--<a href="{{url("news/destroy/".$news->id)}}">Delete</a>-->
                    <!-- Link news/destroy -->
                    <a href="{{ route('news.destroy', $news->id) }}"
                       onclick="event.preventDefault();
                               document.getElementById('destroy-form').submit();">
                        Удалить новость
                    </a>

                    <form id="destroy-form" action="{{ route('news.destroy', $news->id) }}" 
                          method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    <!-- END Link news/destroy -->
                    
                    <span> || </span>
                    
                    <!--<a href="{{url("news/edit/".$news->id)}}">Edit</a>-->
                    <!-- Link news/edit -->
                    <a href="{{ route('news.edit', $news->id) }}"
                       onclick="event.preventDefault();
                               document.getElementById('edit-form').submit();">
                        Редактировать новость
                    </a>

                    <form id="edit-form" action="{{ route('news.edit', $news->id) }}" 
                          method="GET" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <!-- END Link news/edit -->
                    
                    
                    <hr>
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection