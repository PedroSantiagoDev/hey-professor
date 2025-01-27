<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Vote for a question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-4">
                <form method="GET">
                    <x-input-label for="search" :value="__('Search')" />
                    <x-text-input id="search" class="mt-1" type="text" name="search" :value="old('search')" />
                    <x-primary-button class="h-10 ml-3">Search</x-primary-button>
                </form>

                @if ($questions->isEmpty())
                    <div class="flex flex-col justify-center text-center">
                        <div class="flex justify-center">
                            <x-draw.searching width="400" />
                        </div>

                        <div class="mt-6 text-2xl font-bold">
                            Question not found
                        </div>
                    </div>
                @else
                    @foreach ($questions as $item)
                        <x-question :question="$item" />
                    @endforeach
                @endif

                {{ $questions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
