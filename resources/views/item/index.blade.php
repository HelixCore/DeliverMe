@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3>Items</h3>
      </div>
      <div class="col-sm-2">
        <a class="btn btn-sm btn-success" href="{{ route('item.create') }}">Create New Item</a>
      </div>
    </div>

    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{$message}}</p>
      </div>
    @endif

    <table class="table table-hover table-sm">
      <tr>
        <th width = "50px"><b>No.</b></th>
        <th width = "300px">Name</th>
        <th>Description</th>
        <th width = "180px">Action</th>
      </tr>

      @foreach ($items as $item)
        <tr>
          <td><b>{{++$i}}.</b></td>
          <td>{{$item->name}}</td>
          <td>{{$item->des}}</td>
          <td>
            <form action="{{ route('item.destroy', $item->id) }}" method="post">
              <a class="btn btn-sm btn-success" href="{{route('item.show',$item->id)}}">Show</a>
              <a class="btn btn-sm btn-warning" href="{{route('item.edit',$item->id)}}">Edit</a>
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>

{!! $items->links() !!}
  </div>
@endsection