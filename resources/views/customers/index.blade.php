@extends('layout')

@section('title', 'Clientes')

@section('content')
    <h1> Clientes </h1>
    <a href="{{ route('customers.create') }}">Agregar nuevo cliente</a>
    <ul>
        @forelse($customers as $customer)
            <li><a href="{{ route('customers.show', $customer) }}"> {{ $customer->first_name . ' ' . $customer->last_name }} </a></li>
        @empty
            <li> No hay clientes registrados aun </li>
        @endforelse
    </ul>

@endsection