@extends('layouts.app')

@section('content')

<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first()}}
        </div>
    @endif

    <div class="row">
        @forelse ($productos as $item)
        <div class="col-6" style="margin-bottom:5px">
            <div class="card">
                <div class="card-body">
                    <strong>{{ $item->name }}</strong><br>
                    <span>{{ $item->des }}</span><br>
                    @auth
                        <form action="{{ route('addCar') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="item">
                            <button class="btn btn-primary">Añadir al carrito</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        @empty 
        
        
        @endforelse
    </div>
</div>
@endsection
