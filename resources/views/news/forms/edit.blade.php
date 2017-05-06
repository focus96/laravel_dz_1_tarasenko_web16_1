@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <div class="panel-heading"><strong>Редактирование товара</strong></div> 
                <div class="panel-body"> 
                    <form class="form-horizontal" method="POST" action="{{url('news/update')}}"> 
                        {{--{{method_field('PUT')}}--}} 
                        {{csrf_field()}} 
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
                            <label for="name" class="col-md-4 control-label">Заголовок</label> 

                            <div class="col-md-6"> 
                                <input id="name" type="text" class="form-control" name="title" value="{{$news->title}}" required autofocus> 
                                @if ($errors->has('title')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('title') }}</strong> 
                                </span> 
                                @endif 
                            </div> 
                        </div> 
                        <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}"> 
                            <label for="cost" class="col-md-4 control-label">Текст</label> 
                            <div class="col-md-6"> 
                                <textarea class="form-control" required name="content"> {{$news->content}} {{ old('content') }}</textarea> 
                                @if ($errors->has('content')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('content') }}</strong> 
                                </span> 
                                @endif 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4"> 
                                <button type="submit" class="btn btn-primary"> 
                                    Добавить 
                                </button> 
                            </div> 
                        </div> 
                        <input type="hidden" name="id" value="{{$news->id}}">
                    </form> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>
@endsection