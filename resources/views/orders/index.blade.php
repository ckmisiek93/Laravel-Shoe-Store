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
                <div class="card-header">Oceny</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($orders->count() == 0)
                        <p>Brak zamówień</p>
                    @else
                        <ul class="nav nav-tabs">
                            <li class="active nav-item"><a class="nav-link active" data-toggle="tab" href="#All" role="tab"><i class="fas fa-trophy"></i> Wszystkie</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Rated" role="tab"><i class="fas fa-star"></i> Ocenione</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Unrated" role="tab"><i class="far fa-star"></i> Nieocenione</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="All" role="tabpanel">
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
                                                                        {{ invoice_has_rate($order->id, $explosion) }} <i class="fas fa-star star"></i>
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
                            </div>
                            <div class="tab-pane" id="Rated" role="tabpanel">
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
                                                    @if (invoice_has_rate($order->id, $explosion) == true)
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
                                                                            {{ invoice_has_rate($order->id, $explosion) }} <i class="fas fa-star star"></i>
                                                                        @endif
                                                                    @else
                                                                        Nie dostarczone
                                                                    @endif
                                                                @else
                                                                    Nie zapłacone
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="Unrated" role="tabpanel">
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
                                                    @if (invoice_has_rate($order->id, $explosion) == false)
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
                                                                            {{ invoice_has_rate($order->id, $explosion) }} <i class="fas fa-star star"></i>
                                                                        @endif
                                                                    @else
                                                                        Nie dostarczone
                                                                    @endif
                                                                @else
                                                                    Nie zapłacone
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection