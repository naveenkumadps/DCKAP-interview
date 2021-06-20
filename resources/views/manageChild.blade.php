<ul>
@foreach($childs as $child)
	<li   id="{{ $child->id }}">
	    {{ $child->name }}
	@if(count($child->childs))
            @include('manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>