@props(['number'])
@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $number)
        <i class="fa fa-star"></i>
    @else
        <i class="fa fa-star star-none"></i>
    @endif
@endfor
