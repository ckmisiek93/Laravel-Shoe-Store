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
                <div class="card-header">{{ $shoe->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        <img src="{{ url('shoeimg/' . $shoe->id . '/150') }}" alt="image" class="img-thumbnail img-responsive rounded-circle">
                        Nazwa {{ $shoe->name }}
                        Cena {{ $shoe->price }}
                        Opis {{ $shoe->description }}
                        Kolor {{ $shoe->colour }}
                        Rozmiar {{ $shoe->size }}
                        <p @if ($shoe->quantity == 0) style="color: red" @endif>W magazynie: {{ $shoe->quantity }}</p>
                        Marka {{ $shoe->brand }}
                        Płeć {{ $shoe->target }}
                        Oceny: 
                        @if (shoe_rates_available($shoe->id) == false) 
                            Brak ocen
                        @elseif (shoe_rates_available($shoe->id) == true)
                            {{ $rates }}
                        @endif
                        <form method="POST" action="{{url('cart/add')}}">              
                            <span class="float-right buttons">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{ $shoe->id }}">
                                <button type="submit" class="btn btn-sm btn-warning add-to-cart">{{ $shoe->price}} zł | <i class="fa fa-fw fa-shopping-cart"></i></button>
                            </span>
                        </form>
                    </p>
                    @auth
                        @if (is_user_admin() == True)
                            <h1>
                                <a href="{{ url('/shoes/' . $shoe->id . '/edit' ) }}">Edytuj</a>
                            </h1>
                            <h1>    
                                <form method="POST" action="{{ url('/shoes/' . $shoe->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}
                                    <a class="tooltips" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <button type="submit" onclick="return confirm('Na pewno chcesz usunac obuwie?');" class="btn btn-outlined btn-theme btn-lg btn-custom btn-menu"> Usuń ubuwie</button>
                                    </a>
                                </form>      
                            </h1>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endsection