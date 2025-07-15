@extends('app')
@section('content')

<div class="card">
    <h5 class="card-header">Data Notification</h5>
    <div class="card-datatable table-responsive">
        <table class="data-notification table">
            <thead class="border-top">
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Content</th>
                    <th class="text-center">Date & Time</th>
                    <th class="text-center">Follow Up</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['notif'] as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->user_name }} - ({{ $item->user_email ?? '-' }})</td>
                    <td>{{ strtoupper($item->title) ?? '-' }}</td>
                    <td>{{ ucfirst($item->content) ?? '-' }}</td>
                    <td>{{ date('d M, Y H:i:s', strtotime($item->created_at)) }}</td>
                    <td class="text-center">
                        <a href="{{ route('notification.read', $item->notification_id) }}" 
                           class="btn rounded-pill btn-label-primary waves-effect">
                            <span class="ti-xs ti ti-eye me-1"></span>View
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Tidak ada notifikasi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('/assets/js/notification.js') }}"></script>
@endsection
