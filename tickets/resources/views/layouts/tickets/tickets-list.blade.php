@extends('layouts.base-ticket')

@section('content')
<div class="col-md-12">
    <div class="list-group">
        @foreach($tickets as $ticket)
            <a href="{{ route('ticket.show', $ticket->id) }}"
               class="list-group-item list-group-item-action"
               @if($ticket->published == 'yes')
                style="background-color:#ccc;"
               @endif
            >
                {{ $ticket->title }}
                <form class="float-right" action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn badge badge-danger" type="submit" title="Удалить">x</button>
                </form>
            </a>
        @endforeach
    </div>
</div>
@endsection
