<div class="card">
  <div class="wrapper">
    <a href="{{ $product->url }}" target="_tab">
        <img class="card-img-top" src="{{ $product->img }}" alt="Card image">
    </a>
  </div>

  <div class="card-body">
    <h5 class="card-title"><a href="{{ $product->url }}" target="_tab">{{ $product->name }}</a></h5>
    <h5 class="pb-1 text-center"> {{ __('Price') }}: <strong>€{{ $product->price }}</strong></h5>
    
    @auth

        @if( isset($alreadyWishlist) && in_array( $product->id, $alreadyWishlist ) )
            <action-button url="{{ route('product-whislist-delete', ['product' => $product->id ]) }}"
                token="{{ csrf_token() }}" idle="{{__('Already in your wishlist')}}" hover="{{__('Remove from your list')}}"
                ></action-button>
        @elseif( request()->is('wishlists') )
            <form action="{{ route('product-whislist-delete', ['product' => $product->id ]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-block">{{__('Remove from your list')}}</button>
            </form>
        @else
            <form action="{{ route('product-whislist', ['product' => $product->id ]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-block">{{ __('Add to my wishlist') }}</button>
            </form>
        @endif

    @else
        <a href="{{ route('login') }}" class="btn btn-info btn-block" disabled>{{ __('Login to start adding') }}</a>
    @endauth

  </div>
</div>
