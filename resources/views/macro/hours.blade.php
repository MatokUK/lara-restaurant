@php ($days = ['', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Su', 'Sa'])

@for ($i = 1; $i <= 7; $i++)
    <dl>
        <dt>{{ $days[$i] }}</dt>
        <dd>
            @foreach ($restaurant->openingIntervals as $interval)
                @if ($interval->day_in_week == $i)
                    <span class="restaurant-hours">{{ \Carbon\Carbon::parse($interval->open_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($interval->close_at)->format('H:i') }}</span>
                @endif
            @endforeach
        </dd>
    </dl>
@endfor