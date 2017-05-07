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
                    <a href="{{url("news/destroy/".$news->id)}}">Delete</a>
                    <a href="{{url("news/edit/".$news->id)}}">Edit</a>
                    <hr>
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection