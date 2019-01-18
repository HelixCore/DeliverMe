@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            @if ($order)
                <span>Fecha de creacion </span><strong>{{ $order->created_at }}</strong>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->des }}</td>
                            <td>
                            <form action="{{ route('extract') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $order->id }}" name="order">
                                <input type="hidden" value="{{ $item->id }}" name="product">
                                <button class="btn btn-danger">Borrar</button>
                            </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td>No posee productos en el carrito</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ($order)
                <form action="{{ route('processOrder') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $order->id }}" name="order_id">
                    <button class="btn btn-success">Ordenar</button>
                </form>
            @endif
        </div>
    </div>
</div>


@endsection