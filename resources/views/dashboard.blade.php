<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form post :action="route('question.store')">
                <div class="mb-4">
                    <x-textarea label="Question" name="question" placeholder="Ask me anything..."/>
                </div>
                <x-primary-button type="submit">
                    Save
                </x-primary-button>
                <x-secondary-button type="reset">
                    Cancel
                </x-secondary-button>
            </x-form>

            <hr class="border-gray-700 border-dashed my-4"/>

            <div class="text-gray-800 uppercase font-bold mb-1">List of questions</div>

            <div class="space-y-4">
                @foreach($questions as $item)
                    <x-question :question="$item"/>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
