@extends('layouts.base-ticket')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('ticket.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="" cols="30" rows="10" class="form-control">
                            {{ old('content') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
