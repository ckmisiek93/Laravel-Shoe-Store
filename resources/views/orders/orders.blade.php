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
                <div class="card-header">Zamówienia</div>

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
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Unfinished" role="tab"><i class="fas fa-truck"></i> Niedostarczone</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Finished" role="tab"><i class="fas fa-shipping-fast"></i> Dostarczone</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="All" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table" data-sort="table" name="orderstable">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%">ID</th>
                                            <th>Status</th>
                                            <th>Zapłacone</th>
                                            <th>Tytuł</th>
                                            <th>Koszt</th>
                                            <th>Miasto</th>
                                            <th>Adres</th>
                                            <th>Telefon</th>
                                            <th>Email</th>
                                            <th>Informacje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $invoice)
                                            <tr>
                                                <td style="width: 3%">{{ $invoice->id }}</td>
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
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($invoice->payment_status == 'Completed')
                                                        Zapłacone
                                                    @else
                                                        Niezapłacone
                                                    @endif
                                                </td>
                                                <td style="width: 10%">{{ $invoice->title }}</td>
                                                <td>{{ $invoice->price }}</td>
                                                <td>{{ $invoice->city }}</td>
                                                <td>{{ $invoice->adress }}</td>
                                                <td>{{ $invoice->phone }}</td>
                                                <td>{{ $invoice->email }}</td>
                                                <td>{{ $invoice->info }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="Unfinished" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table" data-sort="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%">ID</th>
                                            <th>Status</th>
                                            <th>Zapłacone</th>
                                            <th>Tytuł</th>
                                            <th>Koszt</th>
                                            <th>Miasto</th>
                                            <th>Adres</th>
                                            <th>Telefon</th>
                                            <th>Email</th>
                                            <th>Informacje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $invoice)
                                            @if ($invoice->delivery == 0)
                                                <tr>
                                                    <td style="width: 3%">{{ $invoice->id }}</td>
                                                    <td>
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
                                                    </td>
                                                    <td>
                                                        @if ($invoice->payment_status == 'Completed')
                                                            Zapłacone
                                                        @else
                                                            Niezapłacone
                                                        @endif
                                                    </td>
                                                    <td style="width: 10%">{{ $invoice->title }}</td>
                                                    <td>{{ $invoice->price }}</td>
                                                    <td>{{ $invoice->city }}</td>
                                                    <td>{{ $invoice->adress }}</td>
                                                    <td>{{ $invoice->phone }}</td>
                                                    <td>{{ $invoice->email }}</td>
                                                    <td>{{ $invoice->info }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="Finished" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table" data-sort="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%">ID</th>
                                            <th>Status</th>
                                            <th>Zapłacone</th>
                                            <th>Tytuł</th>
                                            <th>Koszt</th>
                                            <th>Miasto</th>
                                            <th>Adres</th>
                                            <th>Telefon</th>
                                            <th>Email</th>
                                            <th>Informacje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $invoice)
                                            @if ($invoice->delivery == 1)
                                                <tr>
                                                    <td style="width: 3%">{{ $invoice->id }}</td>
                                                    <td>Dostarczone</td>
                                                    <td>
                                                        @if ($invoice->payment_status == 'Completed')
                                                            Zapłacone
                                                        @else
                                                            Niezapłacone
                                                        @endif
                                                    </td>
                                                    <td style="width: 10%">{{ $invoice->title }}</td>
                                                    <td>{{ $invoice->price }}</td>
                                                    <td>{{ $invoice->city }}</td>
                                                    <td>{{ $invoice->adress }}</td>
                                                    <td>{{ $invoice->phone }}</td>
                                                    <td>{{ $invoice->email }}</td>
                                                    <td>{{ $invoice->info }}</td>
                                                </tr>
                                            @endif
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