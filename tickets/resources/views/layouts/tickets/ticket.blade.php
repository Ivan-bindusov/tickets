@extends('layouts.base-ticket')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $ticket->title }}</h2>
                <div class="content">
                    <p>{{ $ticket->content }}</p>
                </div>
                <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-primary">Редактировать</a>
            </div>
        </div>
    </div>
@endsection
