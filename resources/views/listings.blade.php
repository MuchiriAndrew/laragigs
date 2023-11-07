<h1>{{$heading}}</h1>

@if(count($listings) === 0)
    <p>There are no listings</p>
@endif

@foreach ($listings as $listing)
    <a href="/listings/{{$listing['id']}}"><h2>{{$listing['title']}}</h2></a>
    <p>{{$listing['description']}} </p>
@endforeach

