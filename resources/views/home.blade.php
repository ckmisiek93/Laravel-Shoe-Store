@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (Session::has('message'))
                    <div class="alert alert-{{ Session::get('code') }}">
                        <p>{{ Session::get('message') }}</p>
                    </div> 
                @endif
                <div class="card-header">Buty</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($shoe as $sh)
                        <a href="{{ url('/shoes/' . $sh->id) }}"><div class="col-xs-5">
                            <img src="{{ url('shoeimg/' . $sh->id . '/100') }}" alt="image" class="img-responsive">
                            <p>{{ $sh->name }}</p>
                            <p>{{ $sh->name }}</p>
                        </div></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<!-- 

                        <div class="col">
                            <a href="{{ url('/shoes/' . $sh->id) }}"><img src="{{ url('shoeimg/' . $sh->id . '/150') }}" alt="image" class="img-thumbnail img-responsive rounded-circle"></a>
                            <h4>{{ $sh->name }}</h4>
                            <p>{{ $sh->price }}</p>
                            <p>{{ $sh->description }}</p>
                            <p>{{ $sh->colour}}</p>
                            <p>{{ $sh->size }}</p>
                            <p>{{ $sh->brand }}</p>
                            <p>
                                <form method="POST" action="{{url('cart/add')}}"> 
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{$sh->id}}">
                                    <button type="submit" class="btn btn-sm btn-warning">{{$sh->price}} zł | <i class="fa fa-fw fa-shopping-cart"></i></button>
                                </form>
                            </p>
                        </div>