<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\SameQuestionRule;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions'         => user()->questions,
            'archivedQuestions' => user()->questions()->onlyTrashed()->get(),
        ]);
    }

    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Are you sure that is a question? It is missing the question mark in the end.');
                    }
                },
                new SameQuestionRule(),
            ],
        ]);

        user()->questions()
            ->create(
                [
                    'question' => request()->question,
                    'draft'    => true,
                ]
            );

        return back();
    }

    public function edit(Question $question): View
    {
        abort_unless(user()->can('update', $question), Response::HTTP_FORBIDDEN);

        return view('question.edit', compact('question'));
    }

    public function update(Question $question): RedirectResponse
    {
        abort_unless(user()->can('update', $question), Response::HTTP_FORBIDDEN);

        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Are you sure that is a question? It is missing the question mark in the end.');
                    }
                },
            ],
        ]);

        $question->question = request()->question;

        $question->save();

        return to_route('question.index');
    }

    public function restore(int $id): RedirectResponse
    {
        $question = Question::withTrashed()->find($id);

        $question->restore();

        return back();
    }

    public function archive(Question $question): RedirectResponse
    {
        abort_unless(user()->can('archive', $question), Response::HTTP_FORBIDDEN);

        $question->delete();

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        abort_unless(user()->can('destroy', $question), Response::HTTP_FORBIDDEN);

        $question->forceDelete();

        return back();
    }
}
