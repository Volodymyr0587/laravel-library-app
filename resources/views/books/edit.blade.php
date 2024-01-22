<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('book.update', $book) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Title</span>
                                <input type="text" name="title" class="block w-full mt-1 rounded-md"
                                       placeholder="Book title"
                                       value="{{ $book->title }}"/>
                            </label>
                            @error('title')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Author</span>
                                <input type="text" name="author" class="block w-full mt-1 rounded-md"
                                       placeholder="Book author" value="{{$book->author}}"/>
                            </label>
                            @error('author')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Year</span>
                                <input type="text" name="year" class="block w-full mt-1 rounded-md"
                                       placeholder="Release date" value="{{$book->year}}"/>
                            </label>
                            @error('year')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Copies in circulation</span>
                                <input type="number" name="copies_in_circulation" class="block w-full mt-1 rounded-md"
                                       placeholder="" value="{{$book->copies_in_circulation}}"/>
                            </label>
                            @error('copies_in_circulation')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-primary-button type="submit">
                            Update Book
                        </x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
