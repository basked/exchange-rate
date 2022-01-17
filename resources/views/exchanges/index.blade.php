@extends('layouts.app')
@section('content')
    <div class="container-fluid-center">
        <div class="fade-in">
            <div class="row align-items-center">
                <div class="col-12 d-flex flex-column flex-lg-row flex-wrap">
                    <div class="card">
                        <div class="card-header">
                            Курсы валют с
{{--                            {{$exchDates->min()->DateExch}} по {{$exchDates->max()->DateExch }}--}}
                        </div>
                        <div class="card-body">
                            <table class="table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Валюта/Дата</th>
                                    @foreach($exchDates as $exchDate)
                                        <th> {{$exchDate->DateExch }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currencies as $currency)
                                    <tr>
                                        @if(sizeof( $currency->exchanges)>0)
                                            <td>{{$currency->Name}} </td>
                                            @foreach($currency->exchanges as $exchange)
                                                <td>{{$exchange->Rate}}</td>
                                            @endforeach
                                        @endif
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
@endsection
