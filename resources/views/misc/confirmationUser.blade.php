@extends('app')
@section('content')
<div class="container-xxl container-p-y">
    <div class="misc-wrapper text-center">
    @include('layouts.alert')
        <h2 class="mb-1 mt-4">{{ $title }}</h2>
        <p class="mb-4 mx-2">{{ $subTitle }}</p>
        <div class="mt-4">
            <img src="/assets/img/illustrations/page-misc-confirm.png" alt="confirmUser" width="300"
                class="img-fluid" />
        </div>
    </div>
</div>
@endsection
