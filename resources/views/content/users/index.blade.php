@extends('app')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Total Users</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$data['user']->count()}}</h3>
                        </div>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-user ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Active Users</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$data['activeUsers']->count()}}</h3>
                        </div>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-user-check ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Inactive Users</span>
                        <div class="d-flex align-items-center my-2">
                            <h3 class="mb-0 me-2">{{$data['inactiveUsers']->count()}}</h3>
                        </div>
                    </div>
                    <div class="avatar">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-user-exclamation ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    
    <h5 class="card-header">Data Users</h5>
    <div class="card-datatable table-responsive">
        <table class="data-users table">
            <thead class="border-top">
                <tr>
                    <th class="text-center">No. </th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Roles</th>
                    <th class="text-center">Company</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['user'] as $key => $item)
                <tr id="index_{{ $item->id }}">
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->name ?? '-' }}</td>
                    <td>{{ $item->email ?? '-' }}</td>
                    <td class="text-center">{{ $item->rolesName ?? '-' }} </td>
                    <td class="text-center">{{ $item->companyName ?? '-' }} </td>
                    <td class="text-center">
                        @if ($item->userStatus == 'Inactive')
                        <span class="badge bg-label-danger">Inactive</span>
                        @elseif ($item->userStatus == 'Active')
                        <span class="badge bg-label-success">Active</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-inline-block text-nowrap">
                            <a href="{{ url('users/view?id='.$item->id) }}" class="btn btn-sm btn-icon" title="Edit/View">
                                <i class="ti ti-eye"></i>
                            </a>
                            <button class="btn btn-sm btn-icon delete-record" data-id="{{ $item->id }}" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                            @if ($item->userStatus == 'Active')
                            <a href="{{ url('users/inActiveUser?id='.$item->id) }}" class="btn btn-sm btn-icon" title="Change Status Inactive">
                                <span class="badge rounded-pil bg-label-danger">
                                    <i class="ti ti-user-exclamation"></i>
                                </span>
                            </a>
                            @elseif ($item->userStatus == 'Inactive')
                            <a href="{{ url('users/activeUser?id='.$item->id) }}" class="btn btn-sm btn-icon" title="Change Status Active">
                            <span class="badge rounded-pil bg-label-success">
                                <i class="ti ti-user-check"></i>
                            </span>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    @include('content/users/create')
</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/user-list.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.admin-page').addClass('active')
        $('.users-page').addClass('active')
    });

</script>
@endsection
