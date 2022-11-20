<?php
// if (env('APP_ENV') === 'production') {
//     URL::forceSchema('https');
// }
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

// Route::get('dashboard/{location?}', [HotelController::class, 'dashboard'])->name('dashboard');
Route::get('dashboard/', [HotelController::class, 'dashboard'])->name('dashboard');
//Route::post('dashboard/hotels', [HotelController::class, 'showHotels'])->name('showHotels');
Route::any('dashboard/hotels/{location?}', [HotelController::class, 'showHotels'])->name('showHotels');

Route::get('hotel_images/id/{hotelId}', [HotelController::class, 'getHotelImages'])->name('hotelImages');

Route::get('hotel_details/id/{hotelId}', [HotelController::class, 'hotelDetails'])->name('hotelDetails');

Route::get('quiz-dashboard', [QuizController::class, 'index'])->name('quiz-dashboard');

Route::get('add-new-quiz', function(){
    return view('quiz.addQuiz');
})->name('add-new-quiz');

Route::post('post-quiz', [QuizController::class, 'post_quiz'])->name('post-quiz');

Route::get('add-quiz/{quizId}', [QuizController::class, 'add_quiz'])->name('add-quiz');

Route::post('post-question/{quizId}', [QuizController::class, 'post_question'])->name('post-question');

Route::get('publish-quiz/{quizId}', [QuizController::class, 'publish_quiz'])->name('publish-quiz');


Route::post('signup-post', [AuthController::class, 'signup_post'])->name('signup-post');


Route::get('pusher', function () {
    event(new App\Events\StatusLiked('Someone1'));
    return "Event has been sent!";
});

Route::get('Players', [PlayerController::class, 'players'])->name('players');

Route::get('fetchPlayers', [PlayerController::class, 'fetchPlayers'])->name('fetchPlayers');

Route::get('appleLogin', [AuthController::class, 'appleLogin'])->name('appleLogin');

Route::post('apple-callback', [AuthController::class, 'appleCallback'])->name('appleCallback');

Route::get('hash/{password}', [AuthController::class, 'hash'])->name('hash');

Route::view('event', 'pusher');

Route::get('send-mail', [AuthController::class, 'send_mail'])->name('send_mail');

/**
 * google login 
 */

Route::get('auth', [AuthController::class, 'auth'])->name('auth');
Route::get('google', [AuthController::class, 'google'])->name('google');
Route::get('callback/google', [AuthController::class, 'googleCallback'])->name('callback.google');


/**
 * profile route
 */

 route::get('profile', [AuthController::class, 'profile'])->name('profile');


 /**
  * email verify
  */

  
Route::get('sendVerifyMail', [AuthController::class, 'sendVerifyMail'])->name('verify.sendMail');
Route::get('email/verify', [AuthController::class, 'verifyEmail']);