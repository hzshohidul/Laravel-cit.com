@extends('layouts.dashboard')

@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tag</li>
    </ol>
</nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-8">
@can('show_tag')
                <div class="card">
                    <div class="card-header">
                        <h4>Tag List</h4>
                    </div>
                    <div class="card-body">
                        @if(session('deletesuccess'))
                            <strong class="text-danger">
                                {{ session('deletesuccess') }}
                            </strong>
                        @endif
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Tag Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($tag_name_niyejaw as $sl=>$tag_data)
                            <tr>
                                <td>{{ $sl+1; }}</td>
                                <td>{{ $tag_data->tag_name; }}</td>
                                <td>
                                    <a href="{{ route('tag.delete', $tag_data->id ) }}" class="btn btn-danger" >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
@endcan
            </div>
            <div class="col-lg-4 col-md-4">
@can('add_tag')
                @if(session('successtag'))
                    <strong class="text-danger">
                        {{ session('successtag') }}
                    </strong>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Add Tag</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tag.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="tagname">Tag Name</label>
                                <input type="text" name="tag_name" id="tagname" class="form-control">
                                @error('tag_name')
                                    <strong class="text-danger">
                                        {{ $message; }}
                                    </strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
@endcan
            </div>
        </div>
    </div>
@endsection
