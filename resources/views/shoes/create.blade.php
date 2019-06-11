@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buty</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/shoes') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
<!--
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="">Zdjęcie</label>
                                    <input type="file" name="image" class="form-control" placeholder="Wybierz plik">

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>
                        </div>
 -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="">Nazwa Obuwia</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nazwa obuwia">

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
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Cena">

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
                                    <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Opis">

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
                                    <input type="text" name="size" class="form-control" value="{{ old('size') }}" placeholder="Wielkość">

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
                                        <option value="black">Czarne</option>
                                        <option value="white">Białe</option>
                                        <option value="red">Czerwone</option>
                                    </select>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                    <label for="">Ilość</label>
                                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" placeholder="Podaj ilość w magazynie">

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
                                        <option value="male">Mężczyzna</option>
                                        <option value="female">Kobieta</option>
                                        <option value="child">Dziecko</option>
                                    </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col">
                                <label for="brand">Marka</label>
                                    <select class="form-control" id="brand" type="text" class="form-control" name="brand">
                                        <option value="adidas">Adidas</option>
                                        <option value="nike">Nike</option>
                                        <option value="puma">Puma</option>
                                    </select>
                            </div>
                        </div> 


                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Dodaj Buty</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection