@extends('layouts.app')

@section('content')
<div class="container bootstrap snippet bg-row">
    <div class="card">
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('code') }}">
                <p>{{ Session::get('message') }}</p>
            </div> 
        @endif
        <br>
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-sm-8">
                <h1>Panel Administracyjny</h1>
            </div>
            <div class="col-sm-4">
                <h1>
                <i class="fas fa-user-tie"></i>{{ $user->name}}</h1>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <img src="{{ url('storage/site/avatar.png') }}" class="avatar rounded-circle img-thumbnail img-responsive" alt="avatar">
                </div><br>
                <ul class="list-group">
                    <li class="list-group-item"><i class="fas fa-chart-line"></i> Statystyki strony</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Ilość butów</strong></span> {{ $dashboard['shoes']->count() }}</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Ilość użytkowników</strong></span> {{ $dashboard['users']->count() }}</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Ilość zamówień</strong></span> {{ $dashboard['invoices']->count() }}</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Ilość ocen</strong></span> {{ $dashboard['rates']->count() }}</li>
                </ul> 
                <br>
                <br>
            </div>
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active nav-item"><a class="nav-link active" data-toggle="tab" href="#Users" role="tab"><i class="fas fa-users"></i> Użytkownicy</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Shoes" role="tab"><i class="fas fa-shoe-prints"></i> Buty</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Orders" role="tab"><i class="fas fa-receipt"></i> Zamówienia</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Rates" role="tab"><i class="fas fa-star"></i> Oceny</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Stats" role="tab"><i class="fas fa-chart-line"></i> Statystyki</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="Users" role="tabpanel">
                        <hr>
                        <div class="form-group">
                            <div class="table-responsive col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" data-sort="table">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                            <th>Imię</th>
                                            <th>E-mail</th>
                                            <th>Miasto</th>
                                            <th>Rola</th>
                                            <th>Usuń</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                        	@foreach ($dashboard['users'] as $user)
    	                                    	<tr>
    	                                            <td>{{ $user->id }}</td>
    	                                            <td>{{ $user->name }}</td>
    	                                            <td>{{ $user->email }}</td>
    	                                            <td>{{ $user->city }}</td>
                                                    <td>@if($user->user_type == 'Administrator')Administrator <i class="fas fa-user-tie"></i>@else Użytkownik <i class="fas fa-user"></i>@endif</td>
                                                    <td>
                                                    	@if ($user->user_type !== 'Administrator')
                                                            <form method="POST" action="{{ url('/users/' . $user->id . '/delete') }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE')}}
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Na pewno chcesz usunąć użytkownika?');"><i class="fas fa-trash-alt"></i></button>
                                                            </form>  
                                                        @endif
                                                    </td>
    	                                    	</tr>
    	                                    @endforeach
                                       	</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Shoes" role="tabpanel">
                        <hr>
                        <div class="form-group">
                            <div class="table-responsive col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" data-sort="table">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                            <th>Nazwa</th>
                                            <th>Marka</th>
                                            <th>Cena</th>
                                            <th>Rozmiar</th>
                                            <th>Kolor</th>
                                            <th>Opis</th>
                                            <th>Płeć</th>
                                            <th>Ilość</th>
                                            <th>Edytuj</th>
                                            <th>Usuń</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                        	@foreach ($dashboard['shoes'] as $shoe)
    	                                    	<tr>
    	                                            <td>{{ $shoe->id }}</td>
    	                                            <td>{{ $shoe->name }}</td>
    	                                            <td>{{ $shoe->brand }}</td>
    	                                            <td>{{ $shoe->price }}</td>
    	                                            <td>{{ $shoe->size }}</td>
    	                                            <td>
    		                                            @if($shoe->colour == 'black')
    		                                            	<i style="color: black" class="fas fa-square"></i> 
    		                                            @elseif($shoe->colour == 'red') 
    		                                            	<i style="color: red" class="fas fa-square"></i> 
    		                                            @else 
    		                                        		<i class="far fa-square"></i>
    		                                        	@endif
    	                                        	</td>
    	                                            <td>{{ $shoe->description }}</td>
    	                                            <td>
    	                                            	@if($shoe->target == 'male')
    	                                            		Mężczyzna 
    	                                            	@elseif($shoe->target == 'female') 
    	                                            		Kobieta 
    	                                            	@else 
    	                                            		Dziecko 
    	                                            	@endif</td>
    	                                            <td style="width: 10%">
    	                                                <div class="shoe_quantity">
    	                                                	<a class="shoe_quantity_up" href="{{ url('/shoes/' . $shoe->id . '/increment') }}"><i style="color: green" class="fas fa-chevron-up"></i></a>{{$shoe->quantity}}<a class="shoe_quantity_down" href="{{ url('/shoes/' . $shoe->id . '/decrement') }}"><i style="color: red" class="fas fa-chevron-down"></i></a></td>
    	                                                </div>
    	                                            <td><a href="{{ url('/shoes/' . $shoe->id . '/edit' ) }}"><button type="button" class="btn btn-success"><i class="fas fa-cog"></i></button></a></td>
    	                                            <td>
                                                        <form method="POST" action="{{ url('/shoes/' . $shoe->id . '/destroy') }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE')}}
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Na pewno chcesz usunąć buty?');"><i class="fas fa-trash-alt"></i></button>
                                                        </form>  
                                                    </td>
    	                                    	</tr>
    	                                    @endforeach
                                       	</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Orders" role="tabpanel">
                        <hr>
                        <div class="form-group">
                            <div class="table-responsive col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" data-sort="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 3%">ID</th>
                                                <th>Status</th>
                                                <th>Zapłacone</th>
                                                <th>Tytuł</th>
                                                <th>Koszt (zł)</th>
                                                <th>Klient</th>
                                                <th>Miasto</th>
                                                <th>Adres</th>
                                                <th>Telefon</th>
                                                <th>Email</th>
                                                <th>Informacje</th>
                                                <th>Produkt</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach ($dashboard['invoices'] as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->id }}</td>
                                                    <td>
                                                        @if ($invoice->delivery == 0)
                                                            @if ($invoice->payment_status == 'Completed')
                                                                <form method="POST" action="{{ url('/orders/' . $invoice->id . '/delivered') }}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PATCH') }}
                                                                    <input type="hidden" value="1" name="confirmed">
                                                                    <button class="btn btn-success"><i class="fas fa-shipping-fast"></i></button>
                                                                </form>
                                                            @else
                                                                Oczekiwanie na zapłatę
                                                            @endif
                                                        @else
                                                            Dostarczone
                                                        @endif</td>
                                                    <td>
                                                        @if ($invoice->payment_status == 'Completed')
                                                            Zapłacone
                                                        @else
                                                            Niezapłacone
                                                        @endif
                                                    </td>
                                                    <td>{{ $invoice->title }}}</td>
                                                    <td>{{ $invoice->price }}</td>
                                                    <td>{{ find_user($invoice->user_id)->name }}</td>
                                                    <td>{{ $invoice->city }}</td>
                                                    <td>{{ $invoice->adress }}</td>
                                                    <td>{{ $invoice->phone }}</td>
                                                    <td>{{ $invoice->email }}</td>
                                                    <td>{{ $invoice->info }}</td>
                                                    <td>
                                                        @foreach (shoe_explode($invoice->shoe_ids) as $explosion)         
                                                        <a href="{{ url('shoes/' . $explosion) }}"> {{ find_shoe($explosion)->name }}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Rates" role="tabpanel">
                        <hr>
                        <div class="form-group">
                            <div class="table-responsive col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" data-sort="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Klient</th>
                                                <th>Produkt</th>
                                                <th>ID zamówienia</th>
                                                <th>Komentarz</th>
                                                <th>Ocena</th>
                                                <th>Usuń</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach ($dashboard['rates'] as $rate)
                                                <tr>
                                                    <td>{{ $rate->id }}</td>
                                                    <td>{{ find_user($rate->user_id)->name }}</td>
                                                    <td><a href="{{ url('shoes/' . $rate->shoe_id) }}"> {{ find_shoe($rate->shoe_id)->name }}</td>
                                                    <td>{{ $rate->invoice_id }}</td>
                                                    <td>{{ $rate->comment }}</td>
                                                    <td>
                                                        @switch($rate->rate)
                                                            @case('1')
                                                                <i class="fas fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                @break
                                                            @case('2')
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                @break
                                                            @case('3')
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                @break
                                                            @case('4')
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="far fa-star star"></i>
                                                                @break
                                                            @case('5')
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                <i class="fas fa-star star"></i>
                                                                @break
                                                        @endswitch
                                                    </td>
                                                    <td>      
                                                        <form method="POST" action="{{ url('/rates/' . $rate->id) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE')}}
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Na pewno chcesz usunąć ocenę?');"><i class="fas fa-trash-alt"></i></button>
                                                        </form>  
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


