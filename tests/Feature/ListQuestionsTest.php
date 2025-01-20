<?php

use App\Models\{Question, User};

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
