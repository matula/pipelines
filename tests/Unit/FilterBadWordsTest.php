<?php

test('a short message', function () {
    $filter = new \App\Pipes\FilterBadWords();
    $datasource = new \App\Pipes\Datasource(
        request: new \Illuminate\Http\Request(),
        convertedText: 'This is a short message'
    );

    $result = $filter->handle($datasource, fn($datasource) => $datasource);

    expect($result->filteredText)->toBe('This is a s~~~ message');
});

test('forking heck', function () {
    $filter = new \App\Pipes\FilterBadWords();
    $datasource = new \App\Pipes\Datasource(
        request: new \Illuminate\Http\Request(),
        convertedText: 'What the forking heck is going on here?'
    );

    $result = $filter->handle($datasource, fn($datasource) => $datasource);

    expect($result->filteredText)->toBe('What the f~~~ing h~~~ is going on here?');
});
