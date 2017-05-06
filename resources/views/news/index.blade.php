@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <div class="panel-heading"><strong>Добавление товара</strong></div> 
                <div class="panel-body"> 
                    @foreach($news as $n)
                    <p>{!! $n->title !!}</p>
                    <p>{!! $n->markdownContent !!}</p>
                    
                    <a href="news/destroy/{{$n->id}}">X</a>
                    <a href="news/edit/{{$n->id}}">Edit</a>
                    <hr>
                    @endforeach
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection