@extends('layouts.dashboard')
@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Role</li>
    </ol>
</nav>
<div class="container-fluid">
@can('show_role')
    <div class="row">
        <!--Role List Start-->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Role List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive-lg table-responsive-md">
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @foreach($roledatagola as $sl=>$role_data)
                        <tr>
                            <td>{{ $sl+1; }}</td>
                            <td>{{ $role_data->name; }}</td>
                            <td>
                                @foreach ($role_data->getAllPermissions() as $permission_data)
                                <span class="badge badge-primary">
                                        {{ $permission_data->name; }}
                                </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--Role List End-->

        <!--User List Start-->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User List</h4>
                </div>
                <div class="card-body">
                    @if (session('roledelete'))
                        <strong class="text-danger">
                            {{ session('roledelete') }}
                        </strong>
                    @endif
                    <table class="table table-striped table-sm table-dark table-responsive-lg table-responsive-md">
                        <tr>
                            <th>SL</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($usergola as $sl=>$userdata)
                        <tr>
                            <td>{{ $sl+1; }}</td>
                            <td>{{ $userdata->name }}</td>
                            <td>
                                @forelse ($userdata->getRoleNames() as $role_gola)
                                    <span class="badge badge-primary">{{ $role_gola; }}</span>
                                @empty
                                    <span class="badge badge-danger">Role Not Assign</span>
                                @endforelse
                            </td>
                            <td>
                                @forelse ($userdata->getAllPermissions() as $permission_gola)
                                    <span class="badge badge-warning">{{ $permission_gola->name; }}</span>
                                @empty
                                <span class="badge badge-danger">Permission Not Assign</span>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('edit.rolewith_permission', $userdata->id) }}" class="btn btn-info">Edit</a>
                                @if($userdata->id != Auth::id())
                                    <a href="{{ route('remove.role', $userdata->id) }}" class="btn btn-danger">Remove</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--User List End-->


        <div class="col-lg-6 col-md-6">
            <!--Add Permission Start-->
            <div class="card">
                <div class="card-body">
                    @if (session('successpermission'))
                        <strong class="text-danger">
                            {{ session('successpermission') }}
                        </strong>
                    @endif
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="per" class="form-label">
                            <h4>Add New Permission</h4>
                          </label>
                          <input type="text" name="permission_name" id="per" class="form-control" aria-describedby="helpId" placeholder="Permission Name">
                          @error('permission_name')
                              <strong class="text-danger">
                                {{ $message; }}
                              </strong>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--Add Permission end-->
            <!--Add Role Start-->
            <div class="card">
                <div class="card-body">
                    @if(session('successrole'))
                        <strong class="text-danger">
                            {{ session('successrole') }}
                        </strong>
                    @endif
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 form-group">
                          <label for="roleadd" class="form-label">
                                <h4>Add New Role</h4>
                          </label>
                          <input type="text" name="role_name" id="roleadd" class="form-control" placeholder="Role Name" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <h4>Permission</h4>
                            @foreach($permissiondatagola as $permission_data)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissiongola[]" value="{{ $permission_data->id }}" class="form-check-input">
                                    {{ $permission_data->name }}
                                <i class="input-frame"></i></label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--Add Role end-->
        </div>

        <div class="col-lg-6 col-md-6">
            <!--Role Assign Start-->
            <div class="card">
                @if (session('assignrole'))
                    <strong class="text-danger">
                        {{ session('assignrole') }}
                    </strong>
                @endif
                <div class="card-body">
                    <h4>Role Assign</h4>
                    <hr>
                    <form action="{{ route('assign.role') }}" method="POST">
                        @csrf
                        <!--User List-->
                        <div class="mb-3">
                          <label for="userrr" class="form-label">
                            <h5>User Select</h5>
                          </label>
                          <select name="user_id" id="userrr" class="form-control user-search">
                            <option value="">--Select User--</option>

                            @foreach ($usergola as $user_data)

                            <option value="{{ $user_data->id; }}">{{ $user_data->name; }}</option>

                            @endforeach

                          </select>
                        </div>
                        <!--Role List-->
                        <div class="mb-3">
                            <label for="roleee" class="form-label">
                              <h5>Role Assign</h5>
                            </label>
                            <select name="role_id" id="roleee" class="form-control role-search">
                              <option value="">--Select Role--</option>
                              @foreach ($roledatagola as $role_data)
                              <option value="{{ $role_data->id; }}">{{ $role_data->name; }}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--Role Assign end-->
        </div>
    </div>
@endcan
</div>
@endsection

@section('footer_script')
<script>
    $(document).ready(function() {
        $('.user-search').select2();
    });
    $(document).ready(function() {
        $('.role-search').select2();
    });
</script>
@endsection
