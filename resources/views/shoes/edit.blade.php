@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edytuj {{ $shoe->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/shoes/' . $shoe->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="">Zdjęcie</label>
                                    <input type="file" name="image" class="form-control" value="{{ $shoe->image }}" placeholder="Wybierz plik">

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="">Nazwa Obuwia</label>
                                    <input type="text" name="name" class="form-control" value="{{ $shoe->name }}" placeholder="Nazwa obuwia">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label for="">Cena (zł)</label>
                                    <input type="number" name="price" class="form-control" value="{{ $shoe->price }}" placeholder="Cena">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="">Opis</label>
                                    <input type="text" name="description" class="form-control" value="{{ $shoe->description }}" placeholder="Opis">

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                                    <label for="">Wielkość</label>
                                    <input type="text" name="size" class="form-control" value="{{ $shoe->size }}" placeholder="Wielkość">

                                    @if ($errors->has('size'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('size') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="colour">Kolor</label>
                                    <select class="form-control" id="colour" type="text" class="form-control" name="colour">
                                        
                                        <option value="black" @if ($shoe->colour == 'black') Selected @endif>Czarne</option>
                                        <option value="white" @if ($shoe->colour == 'white') Selected @endif>Białe</option>
                                        <option value="red" @if ($shoe->colour == 'red') Selected @endif>Czerwone</option>
                                    </select>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                    <label for="">Ilość</label>
                                    <input type="number" name="quantity" class="form-control" value="{{ $shoe->quantity }}" placeholder="Ilość">

                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="target">Płeć</label>
                                    <select class="form-control" id="target" type="text" class="form-control" name="target">
                                        <option value="male" @if ($shoe->target == 'male') Selected @endif>Mężczyzna</option>
                                        <option value="female" @if ($shoe->target == 'female') Selected @endif>Kobieta</option>
                                        <option value="child" @if ($shoe->target == 'child') Selected @endif>Dziecko</option>
                                    </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col">
                                <label for="brand">Marka</label>
                                    <select class="form-control" id="brand" type="text" class="form-control" name="brand">
                                        <option value="adidas" @if ($shoe->brand == 'adidas') Selected @endif>Adidas</option>
                                        <option value="nike" @if ($shoe->brand == 'nike') Selected @endif>Nike</option>
                                        <option value="puma" @if ($shoe->brand == 'puma') Selected @endif>Puma</option>
                                    </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col-sm-10 col-sm-offset-1">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Zapisz zmiany</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection