@extends('layouts.app') 
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="panel panel-default"> 
                <div class="panel-heading"><strong>Добавление товара</strong></div> 
                <div class="panel-body"> 
                    <form class="form-horizontal" method="POST" action="{{url('news/store')}}"> 
                        {{csrf_field()}} 
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
                            <label for="name" class="col-md-4 control-label">Заголовок</label> 

                            <div class="col-md-6"> 
                                <input id="title" type="text" class="form-control" name="title" required autofocus> 
                                @if ($errors->has('name')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('name') }}</strong> 
                                </span> 
                                @endif 
                            </div> 
                        </div> 

                        <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}"> 
                            <label for="cost" class="col-md-4 control-label">Текст</label> 

                            <div class="col-md-6"> 
                                <textarea class="form-control" required name="content">{{ old('contrnt') }}</textarea>
                                @if ($errors->has('cost')) 
                                <span class="help-block"> 
                                    <strong>{{ $errors->first('contrnt') }}</strong> 
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



                    </form> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection