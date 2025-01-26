<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Questions') }} :: {{ $question->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form put :action="route('question.update', $question)">
                <div class="mb-4">
                    <x-textarea label="Question" name="question" :value="$question->question"/>
                </div>
                <x-primary-button type="submit">
                    Save
                </x-primary-button>
                <x-secondary-button type="reset">
                    Cancel
                </x-secondary-button>
            </x-form>
        </div>
    </div>
</x-app-layout>
