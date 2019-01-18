@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
        <h3>Nuevo Item</h3>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
        <strong>Whoops! </strong> there where some problems with your input.<br>
        <ul>
            @foreach ($errors as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
    @endif

    <form action="{{route('item.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <strong>Name :</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-12">
                <strong>Description :</strong>
                <textarea class="form-control" placeholder="des" name="des" rows="8" cols="80"></textarea>
            </div>
            
            <div class="form-check col-md-12">
                <strong>Compañias</strong>
                @foreach ($companies as $company)
                    <div class="col-12">
                        <input class="form-check-input" type="radio" name="company" id="{{ $company->id }}" value="{{ $company->id }}">
                        <label class="form-check-label" for="{{ $company->id }}">{{ $company->name }}</label>    
                    </div> 
                @endforeach
            </div>


            <div class="col-md-12">
                <a href="{{route('item.index')}}" class="btn btn-sm btn-success">Back</a>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
            

        </div>
    </form>

    </div>
@endsection