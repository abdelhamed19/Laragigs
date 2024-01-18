@props(['tagcsv'])
@php
$tags=explode(",",$tagcsv)
@endphp
<ul class="flex">
    @foreach($tags as $tags)

        <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">

            <a href="/?tags={{$tags}}">{{$tags}}</a>

        </li>
    @endforeach

</ul>
