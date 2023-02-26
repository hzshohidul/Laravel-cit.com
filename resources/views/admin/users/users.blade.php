@extends('layouts.dashboard')

@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User List</li>
    </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
@can('show_user_list')
                <form action="{{ route('delete.check') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>User List <span class="float-right">Total Users: {{ $total_users; }}</span></h3>
@can('user_delete')
                            <button type="submit" class="btn btn-danger float-right">Deleted Checked</button>
@endcan
                        </div>
                        <div class="card-body">
                            <!--Message-->
                            @if(session('check_nai'))
                                <strong class="text-danger">
                                    {{ session('check_nai') }}
                                </strong>

                                @elseif(session('check_user_delete'))
                                <strong class="text-danger">
                                    {{ session('check_user_delete') }}
                                </strong>

                                @elseif(session('userdelete'))
                                <strong class="text-danger">
                                    {{ session('userdelete') }}
                                </strong>
                            @endif
                            <table class="table table-sm table-striped">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"> <label for="checkAll">Select All</label></th>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
    @foreach ($usersall as $sl=>$user_data)
                                <tr>
                                    <td><input type="checkbox" name="check[]" value="{{ $user_data->id; }}"></td>
                                    <td>{{ $sl+1; }}</td>
                                    <td>{{ $user_data->name; }}</td>
                                    <td>{{ $user_data->email; }}</td>
                                    <td>
                                        @if ($user_data->image == null)
                                            <img src="{{ Avatar::create($user_data->name)->toBase64() }}" />
                                        @else
                                            <img src="{{ asset('/uploads/user') }}/{{ $user_data->image; }}" alt="">
                                        @endif
                                    </td>
                                    <td>
@can('user_delete')
                                        <a href="{{ route('user.delete', $user_data->id ); }}" class="btn btn-danger">Delete</a>
@endcan
                                    </td>
                                </tr>
    @endforeach
                            </table>
                            <div class="py-3">
                                {{ $usersall->links() }}
                            </div>
                        </div>
                    </div>
                </form>
@endcan
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
