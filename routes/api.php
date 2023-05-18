<?php

use App\Mail\PlumberAlert;
use App\Pipes\ConvertMarkdownToHtml;
use App\Pipes\Datasource;
use App\Pipes\FilterBadWords;
use App\Pipes\GetAvailablePlumber;
use App\Pipes\GetClientFromTeamId;
use App\Pipes\SendPlumberAlert;
use App\Pipes\SetDatasourceFromRequest;
use App\Pipes\SkipThisPipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::any('slack', function (Request $request) {
    $datasource = new Datasource(request: $request);
    return \Illuminate\Support\Facades\Pipeline::send($datasource)
        ->through([
            SetDatasourceFromRequest::class,
            GetClientFromTeamId::class,
            ConvertMarkdownToHtml::class,
            FilterBadWords::class,
            GetAvailablePlumber::class
        ])
        ->via('handle')
        ->then(fn(Datasource $datasource) => (new SendPlumberAlert())->handle($datasource));
})->middleware('slack.challenge');
