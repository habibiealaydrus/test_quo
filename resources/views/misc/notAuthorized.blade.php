@extends('app')
@section('content')
<div class="container-xxl container-p-y">
    <div class="misc-wrapper text-center">
        <h2 class="mb-1 mx-2">You are not authorized!</h2>
        <p class="mb-4 mx-2">
            You do not have permission to view this page using the credentials that you have provided while login.
            <br />
            Please contact your site administrator.
        </p>
        <a href="{{url ('/')}}" class="btn btn-primary mb-4">Back to home</a>
        <div class="mt-4">
            <img src="/assets/img/illustrations/page-misc-you-are-not-authorized2.png" alt="page-misc-not-authorized"
                width="170" class="img-fluid" />
        </div>
    </div>
</div>
@endsection
