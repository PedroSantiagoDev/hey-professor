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
                </form>

                @foreach ($questions as $item)
                    <x-question :question="$item" />
                @endforeach

                {{ $questions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
