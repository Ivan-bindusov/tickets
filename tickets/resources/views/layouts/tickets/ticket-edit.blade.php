@extends('layouts.base-ticket')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input name="title" type="text" class="form-control" value="{{ $ticket->title }}">
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="" cols="30" rows="10" class="form-control">
                            {{ $ticket->content }}
                        </textarea>
                    </div>
                    <div class="form-check my-3">
                        <input
                            id="published"
                            type="checkbox"
                            name="published"
                            class="form-check-input"
                            @if($ticket->published == 'yes')
                                checked
                            @endif
                        >
                        <label for="published" class="form-check-label">Закрыт</label>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
