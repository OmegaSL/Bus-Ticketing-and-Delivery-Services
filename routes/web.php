<?php

	use App\Http\Controllers\PaymentController;
	use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/login', \App\Livewire\Auth\LoginComponent::class)->name('login');
Route::get('/register', \App\Livewire\Auth\RegisterComponent::class)->name('register');
Route::get('/verification', \App\Livewire\Auth\VerificationComponent::class)->name('verification');
Route::get('/forgot-password', \App\Livewire\Auth\ForgotPasswordComponent::class)->name('forgot-password');

Route::get('/', \App\Livewire\SplashComponent::class)->name('splash');
Route::get('/landing', \App\Livewire\LandingComponent::class)->name('landing');
Route::get('/getting-started', \App\Livewire\GettingStartedComponent::class)->name('getting-started');

Route::group(['middleware' => ['auth']], static function (){
	Route::get('/home', \App\Livewire\HomeComponent::class)->name('home');
	Route::get('/list-buses', \App\Livewire\ListingComponent::class)->name('listing');
	Route::get('/bus/{bus_number}', \App\Livewire\BusComponent::class)->name('bus');
	Route::get('/bus-seats/{bus_number}', \App\Livewire\BusSeatsComponent::class)->name('bus-seats');
	Route::get('/make-payment/{bus_number}/{seats?}', \App\Livewire\MakePaymentComponent::class)->name('make-payment');
	Route::get('/my-tickets', \App\Livewire\UserTicketsComponent::class)->name('my-tickets');
	Route::get('/view-ticket/{payment_id}', \App\Livewire\ViewTicketComponent::class)->name('view-ticket');
	Route::get('/profile', \App\Livewire\ProfileComponent::class)->name('profile');

	// The callback url after a payment
	Route::get('/rave/callback', [PaymentController::class, 'callback'])->name('callback');
	Route::get('/payment-complete/{payment_id}', [PaymentController::class, 'payment_success'])->name('completed-payment');
});
