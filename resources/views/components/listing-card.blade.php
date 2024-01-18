@props(['listings'])
<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <a href="listing/{{$listings->id}}">
           <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listings->logo ? asset('storage/' . $listings->logo) : asset('/images/no-image.png')}}"
            alt=""
        />
        </a>
        {{-- <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listings->logo ? asset('storage/' . $listings->logo) : asset('/images/no-image.png')}}"
            alt=""
        /> --}}
        <div>
            <h3 class="text-2xl">
                <a href="listing/{{$listings->id}}">Job Title: {{$listings->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">Company: {{$listings->company}}</div>
            <ul class="flex">
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <x-listing-tags :tagcsv="$listings->tags"/>
                </li>

            </ul>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i>{{$listings->location}}
            </div>
{{--            <div class="mt-4 p-2 flex space-x-6">--}}
{{--                <a href="{{route("edit",$listings->id)}}">--}}
{{--                    <i class="fa-solid fa-pencil"></i> Edit--}}
{{--                </a>--}}

{{--                <form method="POST" action="{{route("delete",$listings->id)}}">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
</div>
