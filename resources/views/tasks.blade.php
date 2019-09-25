@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div align="right">
                        <a href="{{route('tasks.create')}}" class="btn btn-success">Add</a>
                    </div>
                    @if($message=session('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-bordered table-striped" id="">
                        <tr>
                            <th width="25%">Name</th>
                            <th width="60%">Description</th>
                            <th width="15%">Actions</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td>@if($row->is_complete == 1)<s>{{$row->name}}</s> @else {{$row->name}} @endif</td>
                                <td>@if($row->is_complete == 1)<s>{{$row->description}}</s> @else {{$row->description}} @endif</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <div class="col-md-4 custom">
                                            <a href="{{ route('tasks.edit',$row->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                        <div class="col-md-4 custom">
                                            <form action="{{ route('tasks.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        </div>
                                        <div class="col-md-4 custom">
                                            <form action="{{ route('tasks.complete', $row->id) }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-warning btn-sm " @if($row->is_complete == 1) disabled @endif >Complete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $data->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
