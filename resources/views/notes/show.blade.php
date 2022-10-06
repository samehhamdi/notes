@extends('layouts.app')

@section('content')
    <div class="bg-gray-80 border border-gray-250 p-10 rounded mt-40">
    <main>
        <a href="{{ url('/') }}" class="inline-block text-black ml-4 mb-4"
        ><i class="fa-solid fa-arrow-left"></i> Back
        </a>
        @if(Auth::user()->id == $note->user_id)
        <a href="{{ url('destroy/'.$note->slug) }}" class="bg-black text-white rounded-xl px-3 py-1 mr-2"
        >Delete</a>
        <a href="{{ url('edit/'.$note->slug) }}" class="bg-black text-white rounded-xl px-3 py-1 mr-2"
        >Edit</a>
        @endif
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                <div
                    class="flex flex-col items-center justify-center text-center"
                >

                    <ul class="flex">
                        <div class="text-xl font-bold mb-4">
                            <a href="#">@if($note->ispublic == 1 ) Public @else Private @endif </a>
                        </div>
                    </ul>
                    <h3 class="text-2xl mb-2">..</h3>
                    <div class="text-lg my-4">
                        {{ $note->created_at }}
                    </div>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <h3 class="text-3xl font-bold mb-4">
                            {{ $note->title }}
                        </h3>
                        <div class="text-lg space-y-6">
                            <p>
                                {{ $note->body }}
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>
    <!-- Search -->
    <form action="{{ url('store/'.$note->slug) }}" method="POST">
        {{ csrf_field() }}
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="comment"
                class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="add comment..."
            />
            <div class="absolute top-2 right-2">
                <button
                    type="submit"
                    class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
                >
                    save
                </button>
            </div>
        </div>
    </form>
    </div>
    @if(count($comments)>0)
        <ul class="list-group list-group-flush">
        @foreach($comments as $comment)
            <br>
            <li class="list-group-item">{{ $comment->comment }}</li>
        @endforeach
        </ul>
    @else
        <p>no comment found ..</p>
    @endif
@endsection
