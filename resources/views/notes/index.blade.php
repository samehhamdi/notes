@extends('layouts.app')

@section('content')
    <div class="bg-gray-80 border border-gray-250 p-10 rounded mt-40">
    <div class="panel-heading">Notes</div>

            @if($message = Session::get('success'))

                <div class="alert alert-success">
                    {{ $message }}
                </div>

            @endif

            @if($notes->isEmpty())
                <p>
                    You have not created any notes! <a href="{{ url('create') }}">Create one</a> now.
                </p>
            @else
                <ul class="list-group">
                    @foreach($notes as $note)
                        <div class="bg-gray-50 border border-gray-200 rounded p-6">

                            <div class="flex">
                        <li class="list-group-item">
                            <div>
                            <div>
                                <p><a class="hover:text-laravel font-bold" href="{{ url('show', [$note->slug]) }}">{{ $note->title }}</a> -
                                @if($note->ispublic == 1 ) Public @else Private @endif |
                                    <span class="pull-right">{{ $note->updated_at->diffForHumans() }}</span></p>
                            </div>
                                <p class="card-text">{{ substr($note->body, 0,  180) }}</p>
                            </div>
                        </li>
                            </div>

                        </div>
                        <br>
                    @endforeach
                </ul>
            @endif

    <div class="panel-heading">
        {{ $notes->links() }}
    </div>
    </div>
@endsection
