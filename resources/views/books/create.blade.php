<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('book.store') }}">
                        @csrf
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Title</span>
                                <input type="text" name="title" class="block w-full mt-1 rounded-md"
                                       placeholder="Book title"
                                       value="{{old('title')}}"/>
                            </label>
                            @error('title')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Author</span>
                                <input type="text" name="author" class="block w-full mt-1 rounded-md"
                                       placeholder="Book author" value="{{old('author')}}"/>
                            </label>
                            @error('author')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Year</span>
                                <input type="text" name="year" class="block w-full mt-1 rounded-md"
                                       placeholder="Release year" value="{{old('year')}}"/>
                            </label>
                            @error('year')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Copies in circulation</span>
                                <input type="number" name="copies_in_circulation" class="block w-full mt-1 rounded-md"
                                       placeholder="Number of copies of the book" value="{{old('copies_in_circulation')}}"/>
                            </label>
                            @error('copies_in_circulation')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-primary-button type="submit">
                            Add To Library
                        </x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
