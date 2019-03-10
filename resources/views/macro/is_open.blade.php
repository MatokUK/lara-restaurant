@inject('availability', 'App\Restaurant\Availability')

@if ($availability->isOpen($restaurant))
    Yes
@else
    No
@endif