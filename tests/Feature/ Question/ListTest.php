<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it('should list all questions', function () {
    $user = User::factory()->create();
    actingAs($user);
    $questions = Question::factory()->count(5)->create();

    $response = get(route('dashboard'));

    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});

it('should paginate the result', function () {
    $user      = User::factory()->create();
    $questions = Question::factory()->count(20)->create();
    actingAs($user);

    $response = get(route('dashboard'))
        ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator);
});

it('should order by link and unlike, most liked question should be at the top, most unlike question should be in the bottom', function () {
    $user       = User::factory()->create();
    $secondUser = User::factory()->create();
    $questions  = Question::factory()->count(5)->create();

    $mostLikedQuestion   = Question::find(3);
    $mostUnlikedQuestion = Question::find(1);

    $user->like($mostLikedQuestion);
    $secondUser->unlike($mostUnlikedQuestion);

    actingAs($user);

    $response = get(route('dashboard'))
        ->assertViewHas(
            'questions',
            function ($questions) use ($mostLikedQuestion, $mostUnlikedQuestion) {
                expect($questions)
                    ->first()->id->toBe($mostLikedQuestion->id)
                    ->and($questions)
                    ->last()->id->toBe($mostUnlikedQuestion->id);

                return true;
            }
        );
});
