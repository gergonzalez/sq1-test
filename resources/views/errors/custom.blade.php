@extends('layouts.default')

@section('content')
<div class="container pb-8 pt-8">
	<h1>{{__('We have to go back!')}}</h1>
	<p>{{__('Sorry something went wrong click the bottom to come back to home')}}</p>
	<a class="btn btn-lg btn-primary" href="{{url('')}}">{{__('Go Back Home')}}</a>
</div>
@endsection
