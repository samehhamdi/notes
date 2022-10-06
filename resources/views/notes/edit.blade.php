@extends('layouts.app')

@section('content')
    @if(Auth::user()->id == $note->user_id)
    <div
        class="bg-gray-50 border border-gray-200 p-10 rounded max-w-2xl mx-auto mt-24"
    >
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create new Note
            </h2>
        </header>
        <br>
        <form action="{{ url('create') }}" method="POST" role="form">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <input type="text"  class="border border-gray-200 rounded p-2 w-full"
                       name="title" value="{{ $note->title }}"
                       placeholder="Give your note a title" required autofocus>

                @if ($errors->has('title'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                @endif
            </div>

            <br>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <textarea  class="border border-gray-200 rounded p-2 w-full"
                                           name="body" rows="15" placeholder="...and here goes your note body" required >{{ $note->body }}</textarea>

                @if ($errors->has('body'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                @endif
            </div>
            <br>
            <div class="form-group{{ $errors->has('ispublic') ? ' has-error' : '' }}">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Is Public ?
                </label>
                <input type="checkbox"  class="border border-gray-200 rounded p-2 w-full"
                       name="ispublic" {{ $note->ispublic == 1 ? 'checked' : '' }} >

                @if ($errors->has('ispublic'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('ispublic') }}</strong>
                                    </span>
                @endif
            </div>

            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Save</button>
        </form>
    </div>
    @else
        <p>you don't have access for this action .. </p>
    @endif
@endsection
