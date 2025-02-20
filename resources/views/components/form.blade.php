@props([
    'action',
    'post' => null,
    'put' => null,
    'patch' => null,
    'delete' => null
])

<form action="{{$action}}" method="post">
    @csrf
    @if($put)
        @method('PUT')
    @endif
    @if($delete)
        @method('DELETE')
    @endif
    @if($patch)
        @method('PATCH')
    @endif
    {{$slot}}
</form>
