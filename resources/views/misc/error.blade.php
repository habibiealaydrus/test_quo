@extends('app')
@section('content')
<div class="container-xxl container-p-y">
    <div class="misc-wrapper text-center">
    @include('layouts.alert')
        <h2 class="mb-1 mt-4">{{ $title }}</h2>
        <p class="mb-4 mx-2">{{ $subTitle }}</p>
        <a href="{{url ('/register')}}" class="btn btn-warning mb-4">Register Again</a>
        <p class="mb-4 mx-2">Please Click Register Again and Change Your Email</p>
        <div class="mt-4">
            <img src="/assets/img/illustrations/page-misc-error.png" alt="error" width="150px" height="50px"
                class="img-fluid" />
        </div>
    </div>
</div>
@endsection
