<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen">
    @if (Route::has('login'))
        <div class="p-6 text-right">
            @auth
                @include('layouts.navigation')
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <h2 class="m-6 text-xl font-semibold text-gray-900 text-center">Laravel Library App</h2>

    @if (session()->has('status'))
        <div x-data="{show: true}"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-7/12  text-center mx-auto m-5">
                <p>
                    {{ session('status') }}
                </p>
            </div>
    @endif
    <table class="mx-auto">
        <thead>
        <tr>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                #
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Title
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Author
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Release Year
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Released Copies
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Available Copies
            </th>
            @auth
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Actions
                </th>
            @endif
        </tr>
        </thead>

        <tbody class="bg-white">
        @foreach($books as $book)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $loop->index + 1 }}</td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="text-sm font-medium leading-5 text-gray-900">
                            {{$book->title}}
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-500">{{$book->author}}</div>
                </td>

                <td
                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                    {{$book->year}}
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    @if($book->copies_in_circulation < 10)
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                {{$book->copies_in_circulation}}
                            </span>
                    @elseif($book->copies_in_circulation < 20)
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-orange-800 bg-orange-100 rounded-full">
                                {{$book->copies_in_circulation}}
                            </span>
                    @else
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                {{$book->copies_in_circulation}}
                            </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    @if($book->availableCopies() < 10)
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                {{$book->availableCopies()}}
                            </span>
                    @elseif($book->availableCopies() < 20)
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-orange-800 bg-orange-100 rounded-full">
                                {{$book->availableCopies()}}
                            </span>
                    @else
                        <span
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                {{$book->availableCopies()}}
                            </span>
                    @endif
                </td>
                @auth
                    <td
                        class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                        @if($book->canBeBorrowed())
                            <a href="{{ route('loans.create', ['book' => $book->id]) }}"
                                class="text-sky-800 hover:text-sky-400 transition-colors duration-200">{{ __('Borrow book') }}</a>
                        @else
                            <p class="text-red-600"> No copies available to borrow</p>
                        @endif

                            <a href="{{ route('book.edit', ['book' => $book->id]) }}" class="text-green-800 hover:text-green-400 transition-colors duration-200">
                                Edit
                            </a>
                            <form action="{{ route('book.destroy', ['book' => $book->id]) }}" method="POST"
                                onclick="return confirm('{{ __('Are you sure you want to delete all copies of the book?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-800 hover:text-red-400 transition-colors duration-200">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                    </td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="m-4">
        {{ $books->links() }}
    </div>
</div>

</body>
</html>
