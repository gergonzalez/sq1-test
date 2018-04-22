@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row pt-5 pb-2">
        <div class="col-lg-12">
            @include ('components.products-nav')
        </div>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        @foreach ($products as $product)
        <div class="col-xs-12 col-md-6 col-lg-3 mb-3">
            @include ('components.product')
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center mt-4 mb-4">
        {{ $products->appends(request()->input())->links() }}
    </div>
</div>
@endsection
