<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form post :action="route('question.store')">
                <div class="mb-4">
                    <x-textarea label="Question" name="question" placeholder="Ask me anything..." />
                </div>
                <x-primary-button type="submit">
                    Save
                </x-primary-button>
                <x-secondary-button type="reset">
                    Cancel
                </x-secondary-button>
            </x-form>

            <hr class="my-4 border-gray-700 border-dashed" />

            <div class="mb-1 font-bold text-gray-800 uppercase">Drafts</div>

            <div class="space-y-4">
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                        @foreach ($questions->where('draft', true) as $question)
                            <x-table.tr>
                                <x-table.td>{{ $question->question }}</x-table.td>
                                <x-table.td>
                                    <div class="flex items-center gap-2">
                                        <x-form :action="route('question.publish', $question)" put>
                                            <x-primary-button
                                                class="bg-green-400 hover:bg-green-800">Publish</x-primary-button>
                                        </x-form>
                                        <a href="{{ route('question.edit', $question) }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                        <x-form :action="route('question.destroy', $question)" delete onsubmit="return confirm('tem certeza?')">
                                            <x-primary-button
                                                class="bg-red-400 hover:bg-red-800">Delete</x-primary-button>
                                        </x-form>
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                        @endforeach
                    </tbody>
                </x-table>
            </div>

            <hr class="my-4 border-gray-700 border-dashed" />

            <div class="mb-1 font-bold text-gray-800 uppercase">My Questions</div>

            <div class="space-y-4">
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                        @foreach ($questions->where('draft', false) as $question)
                            <x-table.tr>
                                <x-table.td>{{ $question->question }}</x-table.td>
                                <x-table.td>
                                    <div class="flex items-center gap-2">
                                        <x-form :action="route('question.destroy', $question)" delete onsubmit="return confirm('tem certeza?')">
                                            <x-primary-button
                                                class="bg-red-400 hover:bg-red-800">Delete</x-primary-button>
                                        </x-form>
                                        <x-form :action="route('question.archive', $question)" patch>
                                            <x-primary-button>Archive</x-primary-button>
                                        </x-form>
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                        @endforeach
                    </tbody>
                </x-table>
            </div>

            <hr class="my-4 border-gray-700 border-dashed" />

            <div class="mb-1 font-bold text-gray-800 uppercase">Archive Questions</div>

            <div class="space-y-4">
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                        @foreach ($archivedQuestions as $question)
                            <x-table.tr>
                                <x-table.td>{{ $question->question }}</x-table.td>
                                <x-table.td>
                                    <div class="flex items-center gap-2">
                                        <x-form :action="route('question.restore', $question)" patch>
                                            <x-primary-button>Restore</x-primary-button>
                                        </x-form>
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                        @endforeach
                    </tbody>
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
