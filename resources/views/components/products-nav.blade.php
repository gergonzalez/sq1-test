<h5 class="text-muted float-left">{{ __('Found :total products.', ['total' => $products->total()] ) }}</h5>

<div class="dropdown float-right">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ 
        (request('sort') === 'price_desc')? __('Price low to high'):
        ((request('sort') === 'price_asc')? __('Price high to low'):
        ((request('sort') === 'name_desc')? __('Name from A to Z'):
        ((request('sort') === 'name_asc')? __('Name from Z to A'):
        ('Filter By') )))
        }}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="?sort=price_desc">{{__('Price low to high')}}</a>
        <a class="dropdown-item" href="?sort=price_asc">{{__('Price high to low')}}</a>
        <a class="dropdown-item" href="?sort=name_desc">{{__('Name from A to Z')}}</a>
        <a class="dropdown-item" href="?sort=name_asc">{{__('Name from Z to A')}}</a>
    </div>
</div>
