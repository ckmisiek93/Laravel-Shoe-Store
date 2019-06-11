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
	            <h1>Ustawienia</h1>
	        </div>
	        <div class="col-sm-4">
	            <h1>
	            <i class="fas fa-user-cog"></i> {{ $user->name}}</h1>
	        </div>
	    </div>
	    <hr>
	    <div class="row">
	        <div class="col-sm-3">
	            <div class="text-center">
	                <img src="{{ url('storage/site/avatar.png') }}" class="avatar rounded-circle img-thumbnail img-responsive" alt="avatar">
	            </div><br>
	            <ul class="list-group">
	                <li class="list-group-item"><i class="fas fa-chart-line"></i>Statystyki strony</li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong>Ilość zamówień</strong></span> {{ user_rate_stats($user->id)['invoice_count'] }}</li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong>Ilość ocen</strong></span> {{ user_rate_stats($user->id)['count'] }}</li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong>Najczęstsza ocena</strong></span>
		                @if (user_rate_stats($user->id)['common_rate'] == 0)
		                    Brak ocen
		                @else
		                    {{ user_rate_stats($user->id)['common_rate'] }}<i class="fas fa-star star"></i>
		                @endif
	                </li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong>Średnia ocena</strong></span>
	                    @switch(user_rate_stats($user->id)['star_display'])
	                        @case('1')
	                            <i class="fas fa-star star"></i>
	                            <i class="far fa-star star"></i>
	                            <i class="far fa-star star"></i>
	                            <i class="far fa-star star"></i>
	                            <i class="far fa-star star"></i>
	                            @break

	                        @case('1.5')
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star-half-alt star"></i>
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

	                        @case('2.5')
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star-half-alt star"></i>
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

	                        @case('3.5')
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star-half-alt star"></i>
	                            <i class="far fa-star star"></i>
	                            @break

	                        @case('4')
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="far fa-star star"></i>
	                            @break

	                        @case('4.5')
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star-half-alt star"></i>
	                            @break

	                        @case('5')
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            <i class="fas fa-star star"></i>
	                            @break

	                        @case('-10')
	                            Brak ocen
	                            @break
	                    @endswitch
	                </li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong>Data dołączenia</strong></span>{{ $user->created_at }}</li>
	            </ul> 
	            <br>
	            <br>
	        </div>
	        <div class="col-sm-9">
	            <ul class="nav nav-tabs">
	                <li class="active nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings" role="tab"><i class="far fa-id-card"></i> Dane Osobowe</a></li>
	                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Edit" role="tab"><i class="fas fa-user-edit"></i> Edytuj swoje dane</a></li>
	                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Orders" role="tab"><i class="fas fa-receipt"></i> Zamówienia</a></li>
	                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Rates" role="tab"><i class="fas fa-chart-line"></i>> Twoje oceny {{ user_rate_stats($user->id)['count'] }}</a></li>
	            </ul>
	            <div class="tab-content">
	                <div class="tab-pane active" id="Settings" role="tabpanel">
	                    <hr>
	                    <div class="form-group">
	                        <div class="col col-xs-6">
	                            <label for="first_name"><h4>Imię</h4></label><br>                   
	                            <label for="first_name">{{ $user->name }}</label>  
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col col-xs-6">
	                            <label for="email"><h4>Email</h4></label><br>               
	                            <label for="email">{{ $user->email }}</label> 
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col col-xs-6">
	                            <label for="city"><h4>Miasto</h4></label><br>               
	                            <label for="city">{{ $user->city }}</label> 
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col col-xs-6">
	                            <label for="adress"><h4>Adres</h4></label><br>               
	                            <label for="adress">{{ $user->adress }}</label> 
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col col-xs-6">
	                            <label for="phone"><h4>Telefon</h4></label><br>                   
	                            <label for="phone">{{ $user->phone }}</label> 
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col-xs-12">
	                            <br>
	                            <a href="{{ url('/users/' . $user->id . '/edit') }}"><button class="btn btn-lg btn-primary" type="submit"><i class="fas fa-user-edit"></i>Edytuj dane</button></a>
	                        </div>
	                    </div>
	                    <hr>
	                </div>
	                <div class="tab-pane" id="Edit" role="tabpanel">
	                    <hr>   
	                    <form class="form" action="{{ url('/users/' . $user->id) }}" method="post" id="registrationForm">
	                        {{ csrf_field() }}
	                        {{ method_field('PATCH') }}
	                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                            <div class="col col-xs-6">
	                                <label for="first_name"><h4>Imię i nazwisko</h4></label>
	                                <input type="text" class="form-control" name="name" id="first_name" placeholder="{{ $user->name }}" value="{{ $user->name }}" title="Podaj swoje imie">
	                                @if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif 
	                            </div>
	                        </div>
	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <div class="col col-xs-6">
	                                <label for="email"><h4>Email</h4></label>
	                                <input type="email" class="form-control" name="email" id="email" placeholder="{{ $user->email }}" value="{{ $user->email }}" title="Podaj swój email">
	                                @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif     
	                            </div>
	                        </div>
	                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	                            <div class="col col-xs-6">
	                                <label for="phone"><h4>Telefon</h4></label>
	                                <input type="phone" class="form-control" name="phone" id="{{ $user->phone }}" placeholder="{{ $user->phone }}" value="{{ $user->phone }}" title="Podaj swój numer telefonu">
	                                @if ($errors->has('phone'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('phone') }}</strong>
	                                    </span>
	                                @endif      
	                            </div>
	                        </div>
	                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
	                            <div class="col col-xs-6">
	                                <label for="city"><h4>Miasto</h4></label>
	                                <input type="city" class="form-control" name="city" id="{{ $user->city }}" placeholder="{{ $user->city }}" value="{{ $user->city }}" title="Podaj swój numer telefonu">
	                                @if ($errors->has('city'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('city') }}</strong>
	                                    </span>
	                                @endif      
	                            </div>
	                        </div>
	                        <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
	                            <div class="col col-xs-6">
	                                <label for="adress"><h4>Adres</h4></label>
	                                <input type="adress" class="form-control" name="adress" id="{{ $user->adress }}" placeholder="{{ $user->adress }}" value="{{ $user->adress }}" title="Podaj swój numer telefonu">
	                                @if ($errors->has('adress'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('adress') }}</strong>
	                                    </span>
	                                @endif      
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="col-xs-12">
	                                <br>
	                                <button class="btn btn-lg btn-primary" type="submit"><i class="fas fa-check"></i> Zapisz zmiany</button>
	                                <button class="btn btn-lg btn-danger float-right" type="reset"><i class="fas fa-redo-alt"></i> Reset</button>
	                            </div>
	                        </div>
	                    </form>
	                    <hr>
	                </div>
	                <div class="tab-pane" id="Orders" role="tabpanel">
	                	<hr>
	                    <div class="form-group">
	                        <div class="table-responsive col-xs-12">
	                            @if($orders->count() == 0)
	                                <p>Brak zamówień</p>
	                            @else
	                                <div class="table-responsive">
	                                    <table class="table" data-sort="table">
	                                        <thead>
	                                            <tr>
	                                                <th>Nr zamówienia</th>
	                                                <th>Obuwie</th>
	                                                <th>Zamówienie</th>
	                                                <th>Koszt(zł)</th>
	                                                <th>Zapłacone</th>
	                                                <th>Dostarczone</th>
	                                                <th>Ocena</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                            @foreach($orders as $order)
	                                                @foreach (shoe_explode($order->shoe_ids) as $explosion)
	                                                    <tr>
	                                                        <td>{{ $order->id }}</td>
	                                                        <td><a href="{{ url('shoes/' . $explosion) }}"> {{ find_shoe($explosion)->name }}</a></td>
	                                                        <td>{{ $order->title }}</td>
	                                                        <td>{{ $order->price }}</td>
	                                                        <td>
	                                                            @if ($order->payment_status == 'Completed')
	                                                                Tak
	                                                            @else
	                                                                Nie
	                                                            @endif
	                                                        </td>
	                                                        <td>
	                                                            @if ($order->delivery == 1)
	                                                                Tak
	                                                            @else
	                                                                Nie
	                                                            @endif
	                                                        </td>
	                                                        <td>
	                                                            @if ($order->payment_status == 'Completed')
	                                                                @if ($order->delivery == 1)
	                                                                    @if (invoice_has_rate($order->id, $explosion) == false)
	                                                                        <a href="{{ url('orders/' . $order->id . '/rate/' . $explosion . '/create') }}"><button class="btn btn-success">Oceń <i class="fas fa-star star"></i></button></a>
	                                                                    @else
						                                                    @switch(invoice_has_rate($order->id, $explosion))
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
	                                                                    @endif
	                                                                @else
	                                                                    Nie dostarczone
	                                                                @endif
	                                                            @else
	                                                                Nie zapłacone
	                                                            @endif
	                                                        </td>
	                                                    </tr>
	                                                @endforeach
	                                            @endforeach
	                                        </tbody>
	                                    </table>
	                                </div>
	                            @endif
	                        </div>
	                    </div>
	                	<hr>
	                </div>
	                <div class="tab-pane" id="Rates" role="tabpanel">
	                    <hr>
	                    <div class="col">
	                    	<hr>
	                        @if(user_rate_stats($user->id)['count'] === 0)
	                            <h1 style="text-align: center;">Brak ocen użytkownika</h1>
	                        @else                    
	                        <h1 style="text-align: center;">Statystyki</h1>
	                        <div class="row">
	                            <div class="col" style="text-align: center;">
	                                <div class="rating-block">
	                                    <p>Średnia ocena użytkownika z {{ user_rate_stats($user->id)['count'] }} zamówień</p>
	                                    <p class="bold padding-bottom-7">{{ round(user_rate_stats($user->id)->get('avg_rate'), 2) }} <small>/ 5</small></p>
	                                    @switch(user_rate_stats($user->id)['star_display'])
	                                        @case('0')
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('0.5')
	                                            <i class="fas fa-star-half-alt star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('1')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('1.5')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star-half-alt star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('2')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('2.5')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star-half-alt star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('3')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('3.5')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star-half-alt star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('4')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="far fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('4.5')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star-half-alt star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('5')
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            <i class="fas fa-star star"  style="font-size: 24px;"></i>
	                                            @break

	                                        @case('-10')
	                                            Brak ocen
	                                            @break
	                                    @endswitch
	                                </div>
	                            </div>
	                            <div class="col" style="text-align: left;">
	                                <div class="rating-block">
	                                    <p>Oceny użytkownika</p>
	                                    <div class="float-left">
	                                        <div class="float-left" style="width:35px; line-height:1;">
	                                            <div style="height:9px; margin:5px 0;">5 <i class="fas fa-star star"></i></div>
	                                        </div>
	                                        <div class="float-left" style="width:180px;">
	                                            <div class="progress" style="height:9px; margin:8px 0;">
	                                              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: {{ user_rate_stats($user->id)->get('five_percentage') }}%">
	                                                <span class="sr-only">100% Complete (danger)</span>
	                                              </div>
	                                            </div>
	                                        </div>
	                                        <div class="float-right" style="margin-left:10px;">{{ user_rate_stats($user->id)->get('five_star') }}</div>
	                                    </div>
	                                    <div class="float-left">
	                                        <div class="float-left" style="width:35px; line-height:1;">
	                                            <div style="height:9px; margin:5px 0;">4 <i class="fas fa-star star"></i></div>
	                                        </div>
	                                        <div class="float-left" style="width:180px;">
	                                            <div class="progress" style="height:9px; margin:8px 0;">
	                                              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: {{ user_rate_stats($user->id)->get('four_percentage') }}%">
	                                                <span class="sr-only">80% Complete (danger)</span>
	                                              </div>
	                                            </div>
	                                        </div>
	                                        <div class="float-right" style="margin-left:10px;">{{ user_rate_stats($user->id)->get('four_star') }}</div>
	                                    </div>
	                                    <div class="float-left">
	                                        <div class="float-left" style="width:35px; line-height:1;">
	                                            <div style="height:9px; margin:5px 0;">3 <i class="fas fa-star star"></i></div>
	                                        </div>
	                                        <div class="float-left" style="width:180px;">
	                                            <div class="progress" style="height:9px; margin:8px 0;">
	                                              <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: {{ user_rate_stats($user->id)->get('three_percentage') }}%">
	                                                <span class="sr-only">80% Complete (danger)</span>
	                                              </div>
	                                            </div>
	                                        </div>
	                                        <div class="float-right" style="margin-left:10px;">{{ user_rate_stats($user->id)->get('three_star') }}</div>
	                                    </div>
	                                    <div class="float-left">
	                                        <div class="float-left" style="width:35px; line-height:1;">
	                                            <div style="height:9px; margin:5px 0;">2 <i class="fas fa-star star"></i></div>
	                                        </div>
	                                        <div class="float-left" style="width:180px;">
	                                            <div class="progress" style="height:9px; margin:8px 0;">
	                                              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: {{ user_rate_stats($user->id)->get('two_percentage') }}%">
	                                                <span class="sr-only">80% Complete (danger)</span>
	                                              </div>
	                                            </div>
	                                        </div>
	                                        <div class="float-right" style="margin-left:10px;">{{ user_rate_stats($user->id)->get('two_star') }}</div>
	                                    </div>
	                                    <div class="float-left">
	                                        <div class="float-left" style="width:35px; line-height:1;">
	                                            <div style="height:9px; margin:5px 0;">1 <i class="fas fa-star star"></i></div>
	                                        </div>
	                                        <div class="float-left" style="width:180px;">
	                                            <div class="progress" style="height:9px; margin:8px 0;">
	                                              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: {{ user_rate_stats($user->id)->get('one_percentage') }}%">
	                                                <span class="sr-only">80% Complete (danger)</span>
	                                              </div>
	                                            </div>
	                                        </div>
	                                        <div class="float-right" style="margin-left:10px;">{{ user_rate_stats($user->id)->get('one_star') }}</div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <br>
	                        <br>
	                        @endif
	                    </div>
	                        <div class="col">
	                            <h1 style="text-align: center;">Twoje oceny</h1>         
	                            <ul class="media-list">
	                                @foreach ($rates as $rate)
	                                    <li class="media">
	                                        <a class="float-left" style="padding-right: 5px;">
	                                            <img class="media-object rounded-circle" src="{{ url('shoeimg/' . $rate->shoe_id . '/100') }}" alt="circle" class="thumbnail img-responsive">
	                                        </a>
	                                        <div class="media-body">
	                                            <div class="well well-lg">
	                                                <p class="reviews float-right rate">{{ $rate->created_at }}</p>
	                                                <h4 class="reviews"><a href="{{ url('/shoes/' . $rate->shoe_id) }}">{{ find_shoe($rate->shoe_id)->name }}</a></h4>
	                                                <p class="media-comment">
	                                                    {{ $rate->comment }}
	                                                </p>
	                                                <span class="rate float-right">
	                                                    Jakość
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
	                                                </span>
	                                            </div>
	                                        </div>     
	                                    </li>
	                                @endforeach
	                            </ul>
	                        </div>
	                	<hr>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection


