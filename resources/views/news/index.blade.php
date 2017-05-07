@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <div class="panel-heading"><h1>Новости</h1>  <a href="{{url("news/create")}}">Добавить новость</a></div> 
                <div class="panel-body"> 
                    @foreach($news as $n)
                    <h1><a href="{{url("news/show/".$n->id)}}">{!! $n->title !!}</a></h1>
                    <p>{!! $n->markdownContent !!}</p>
                    
                    <div>
                        <p>{{$n->created_at}}</p>
                    </div>
                    <hr>
                    @endforeach
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection