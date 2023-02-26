@extends('layouts.dashboard')
@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Role</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
    </ol>
</nav>
<div class="container-fluid">
@can('show_role')
    <div class="row">
        <div class="col-lg-6 col-md-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Update User Permission</h3>
                </div>
                @if (session('permission_update'))
                    <strong class="text-danger">
                        {{ session('permission_update') }}
                    </strong>
                @endif
                <div class="card-body">
                    <form action="{{ route('permission.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <h5>{{ $user_info_gola->name; }}
                                <span class="float-right badge badge-success">
                                    @foreach ($user_info_gola->getRoleNames() as $roleta)
                                        {{ $roleta }}
                                    @endforeach
                                </span>
                            </h5>
                        </div>

                        <div class="md-3">
                            <input type="hidden" name="user_id" value="{{ $user_info_gola->id }}">
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                @foreach ($permission_gola as $permission)
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input {{($user_info_gola->hasPermissionTo($permission->name))?'checked':''}} type="checkbox" name="permission[]" value="{{ $permission->id }}" class="form-check-input" value="54">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan
</div>
@endsection
