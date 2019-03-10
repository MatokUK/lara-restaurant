<div class="container">
    <div class="row">
        <div class="col">
            Number of displayed restaurants: <strong>{{ count($restaurants) }}</strong>
        </div>
        <div class="col">
            Actual time is: <strong>{{ date('H:i, l, Y-m-d') }}</strong>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Restaurant</th>
            <th scope="col">Cuisine</th>
            <th scope="col" class="restaurant-description">Description</th>
            <th scope="col">Opening Hours</th>
            <th scope="col">Is Open</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->title }}</td>
                <td>{{ $restaurant->cuisine }}</td>
                <td>{{ $restaurant->description }}</td>
                <td>@include('macro/hours', ['restaurant' => $restaurant])</td>
                <td>@include('macro/is_open', ['restaurant' => $restaurant])</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Sorry, no restaurant - try to change search criteria</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>