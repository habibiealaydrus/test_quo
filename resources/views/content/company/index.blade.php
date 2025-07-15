@extends('app')
@section('content')
<div class="card">
    <h5 class="card-header">Data Company</h5>
    <div class="card-datatable table-responsive">
        <table class="data-company table">
            <thead class="border-top">
                <tr>
                    <th class="text-center">No. </th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Area</th>
                    <th class="text-center">Code Area</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['company'] as $key => $item)
                <tr id="index_{{ $item->companyId }}">
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->companyCode ?? '-'}}</td>
                    <td>{{ $item->companyName }}</td>
                    <td class="text-center">{{ $item->companyArea }} </td>
                    <td class="text-center">{{ $item->codeArea }} </td>
                    <td class="text-center">
                        <div class="d-inline-block text-nowrap">
                            <a href="{{ url('company/view?companyId='.$item->companyId) }}" class="btn btn-sm btn-icon" title="Edit/View">
                                <i class="ti ti-eye"></i>
                            </a>
                            <button class="btn btn-sm btn-icon delete-record" data-id="{{ $item->companyId }}" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    @include('content/company/create')
</div>
@endsection
@section('script')
<script src="{{asset ('/assets/js/company-list.js')}}"></script>
<script>
    $(window).on('load', function () {
        $('.admin-page').addClass('active')
        $('.company-page').addClass('active')
    });
</script>
@endsection
