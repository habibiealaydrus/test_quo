@extends('app')
@section('content')
<div class="card">
    <h5 class="card-header">Data Login Logs</h5>
    <div class="card-datatable table-responsive">
        <table class="data-login_logs table">
            <thead class="border-top">
                <tr>
                    <th class="text-center">No. </th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role/Position</th>
                    <th class="text-center">Last Login Date</th>
                    <th class="text-center">Login IP</th>
                    <th class="text-center">Login Device</th>
                    <th class="text-center">Login Browser</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['logs'] as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->name ?? '-' }}</td>
                    <td>{{ $item->email ?? '-' }}</td>
                    <td class="text-center">{{ $item->rolesName ?? '-' }}</td>
                    <td class="text-center">
                        @if ($item->last_login_at !== null)
                          {{ date('d M, Y', strtotime($item->last_login_at)) }}  
                        @else
                          -
                        @endif
                    </td>
                    <td class="text-center">{{ $item->login_ip ?? '-' }}</td>
                    <td class="text-center">{{ $item->login_device?? '-' }}</td>
                    <td class="text-center">{{ $item->login_browser?? '-' }}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/login_logs.js')}}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.documentation-page').addClass('active')
        $('.loginLogs-page').addClass('active')
    });

</script>
@endsection