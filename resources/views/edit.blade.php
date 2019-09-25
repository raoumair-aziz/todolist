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
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div align="left">
                            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
                        </div>
                        <form method="post" action="{{route('tasks.update', $data->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="col-md-4 text-right">Task name</label>
                                <div class="col-md-8">
                                    <input type="text" name="task_name" class="form-control input-lg" value="{{ $data->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 text-right">Task description</label>
                                <div class="col-md-8">
                                    <input type="text" name="task_description" class="form-control input-lg" value="{{ $data->description }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="submit" name="edit" class="btn btn-primary input-lg" value="Edit" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
