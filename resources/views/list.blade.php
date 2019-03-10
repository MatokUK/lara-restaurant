@extends('layouts.app')

@section('content')
    <form name="search_restaurant" method="get" id="search_form">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="spinner-border text-danger js-search-spinner" role="status" style="display: none">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="search_restaurant_search" name="search_restaurant[search]" required="required" placeholder="at least two chars.. " class="form-control" value="{{ $search }}" />
                </div>
                <div class="col">
                    <div class="form-group"><div class="form-check">
                            <input type="checkbox" id="search_restaurant_closed" name="search_restaurant[closed]" required="required" class="form-check-input" value="1" @if ($closed) checked="checked" @endif />
                            <label class="form-check-label required" for="search_restaurant_closed">Include closed restaurant</label></div></div>
                </div>
                <div class="col">
                    <a href="{{ url('/') }}">reset search</a>
                </div>
            </div>
        </div>


    </form>
    <div id="restaurant-table">
        @include('table')
    </div>
@endsection


@push('javascripts')
    <script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endpush