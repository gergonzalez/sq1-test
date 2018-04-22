@extends('layouts.default')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5">{{__('My Wishlist')}}</h1>
    <p class="lead">{{__('Make your dreams come true would cost you € :cost', ['cost'=>$cost])}}</p>
    <a href="{{session()->has('previous')?session('previous'):'/'}}" class="btn btn-lg btn-secondary">{{__('Add more products to your wishlist')}}</a>
    <button type="button" class="btn btn-lg btn-outline-secondary" data-toggle="modal" data-target="#share-modal">{{__('Share with your friends')}}</a>
  </div>
</div>
<div class="container">
    @if($products->total())
    <div class="row pt-5 pb-2">
        <div class="col-lg-12">
            @include ('components.products-nav')
        </div>
    </div>
    @endif
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if($products->total())
    <div class="row">
        @foreach ($products as $product)
        <div class="col-xs-12 col-md-6 col-lg-3 mb-3">
            @include ('components.product')
        </div>
        @endforeach
    </div>
    @else
        <h3 class="pt-8 pb-8">{{__('The wishlist is empty')}}</h3>
    @endif    
    <div class="row justify-content-center mt-4 mb-2">
        <a href="{{session()->has('previous')?session('previous'):'/'}}" class="btn btn-lg btn-secondary">{{__('Add more products to your wishlist')}}</a>
    </div>
    <div class="row justify-content-center mt-4 mb-4">
        {{ $products->appends(request()->input())->links() }}
    </div>
</div>
@include('components.share-modal')
@endsection
