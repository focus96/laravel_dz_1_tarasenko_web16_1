@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <div class="panel-heading"><strong>Добавление товара</strong></div> 
                <div class="panel-body"> 
                    @foreach($news as $n)
                    <h1>{!! $n->title !!}</h1>
                    <p>{!! $n->markdownContent !!}</p>
                    
                    <div>
                        <p>{{$n->created_at}}</p>
                    </div>
                    <a href="news/destroy/{{$n->id}}">Delete</a>
                    <a href="news/edit/{{$n->id}}">Edit</a>
                    <hr>
                    @endforeach
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection