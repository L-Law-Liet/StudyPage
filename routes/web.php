<?php

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

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth']], function (){
    Route::get('/', 'DashboardController@dashboard')->name('admin');

    Route::prefix('university')->group(function () {
        Route::get('/', 'UniversityController@index');
        Route::get('/add', 'UniversityController@getAdd');
        Route::get('/add/{id}', 'UniversityController@getAdd');
        Route::post('/add', 'UniversityController@postAdd');
        Route::post('/add/{id}', 'UniversityController@postAdd');
        Route::get('/view/{id}', 'UniversityController@getView');
        Route::get('/delete/{id}', 'UniversityController@getDelete');
    });
    Route::prefix('direction')->group(function () {
        Route::get('/', 'DirectionController@index');
        Route::get('/add', 'DirectionController@getAdd');
        Route::get('/add/{id}', 'DirectionController@getAdd');
        Route::post('/add', 'DirectionController@postAdd');
        Route::post('/add/{id}', 'DirectionController@postAdd');
        Route::get('/view/{id}', 'DirectionController@getView');
        Route::get('/delete/{id}', 'DirectionController@getDelete');
    });
    Route::prefix('subdirection')->group(function () {
        Route::get('/', 'SubdirectionController@index');
        Route::get('/add', 'SubdirectionController@getAdd');
        Route::get('/add/{id}', 'SubdirectionController@getAdd');
        Route::post('/add', 'SubdirectionController@postAdd');
        Route::post('/add/{id}', 'SubdirectionController@postAdd');
        Route::get('/view/{id}', 'SubdirectionController@getView');
        Route::get('/delete/{id}', 'SubdirectionController@getDelete');
    });
    Route::prefix('subject')->group(function () {
        Route::get('/', 'SubjectController@index');
        Route::get('/add', 'SubjectController@getAdd');
        Route::get('/add/{id}', 'SubjectController@getAdd');
        Route::post('/add', 'SubjectController@postAdd');
        Route::post('/add/{id}', 'SubjectController@postAdd');
        Route::get('/view/{id}', 'SubjectController@getView');
        Route::get('/delete/{id}', 'SubjectController@getDelete');
    });
    Route::prefix('specialty')->group(function () {
        Route::get('/', 'SpecialtyController@index');
        Route::get('/add', 'SpecialtyController@getAdd');
        Route::get('/add/{id}', 'SpecialtyController@getAdd');
        Route::post('/add', 'SpecialtyController@postAdd');
        Route::post('/add/{id}', 'SpecialtyController@postAdd');
        Route::get('/view/{id}', 'SpecialtyController@getView');
        Route::get('/delete/{id}', 'SpecialtyController@getDelete');
    });
    Route::prefix('rating')->group(function () {
        Route::get('/', 'RatingController@index');
        Route::get('/add', 'RatingController@getAdd');
        Route::get('/add/{id}', 'RatingController@getAdd');
        Route::post('/add', 'RatingController@postAdd');
        Route::post('/add/{id}', 'RatingController@postAdd');
        Route::post('/source', 'RatingController@postSource');
        Route::post('/source/{id}', 'RatingController@postSource');
        Route::get('/view/{id}', 'RatingController@getView');
        Route::get('/delete/{id}', 'RatingController@getDelete');
    });
    Route::prefix('list')->group(function () {
        Route::get('/', 'ListController@index');
        Route::get('/add', 'ListController@getAdd');
        Route::get('/add/{id}', 'ListController@getAdd');
        Route::post('/add', 'ListController@postAdd');
        Route::post('/add/{id}', 'ListController@postAdd');
        Route::post('/source', 'ListController@postSource');
        Route::post('/source/{id}', 'ListController@postSource');
        Route::get('/view/{id}', 'ListController@getView');
        Route::get('/delete/{id}', 'ListController@getDelete');
    });
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index');
        Route::get('/add', 'CategoryController@getAdd');
        Route::get('/add/{id}', 'CategoryController@getAdd');
        Route::post('/add', 'CategoryController@postAdd');
        Route::post('/add/{id}', 'CategoryController@postAdd');
        Route::get('/view/{id}', 'CategoryController@getView');
        Route::get('/delete/{id}', 'CategoryController@getDelete');
    });
    Route::prefix('language')->group(function () {
        Route::get('/', 'LanguageController@index');
        Route::get('/add', 'LanguageController@getAdd');
        Route::get('/add/{id}', 'LanguageController@getAdd');
        Route::post('/add', 'LanguageController@postAdd');
        Route::post('/add/{id}', 'LanguageController@postAdd');
        Route::get('/view/{id}', 'LanguageController@getView');
        Route::get('/delete/{id}', 'LanguageController@getDelete');
    });
    Route::prefix('cost')->group(function () {
        Route::get('/', 'CostController@index');
        Route::get('/add', 'CostController@getAdd');
        Route::get('/add/{id}', 'CostController@getAdd');
        Route::post('/add', 'CostController@postAdd');
        Route::post('/add/{id}', 'CostController@postAdd');
        Route::get('/view/{id}', 'CostController@getView');
        Route::get('/delete/{id}', 'CostController@getDelete');
    });
    Route::prefix('faq')->group(function () {
        Route::get('/', 'FaqController@index');
        Route::get('/add', 'FaqController@getAdd');
        Route::get('/add/{id}', 'FaqController@getAdd');
        Route::post('/add', 'FaqController@postAdd');
        Route::post('/add/{id}', 'FaqController@postAdd');
        Route::get('/view/{id}', 'FaqController@getView');
        Route::get('/delete/{id}', 'FaqController@getDelete');
    });
    Route::prefix('requirement')->group(function () {
        Route::get('/', 'RequirementController@index');
        Route::get('/add', 'RequirementController@getAdd');
        Route::get('/add/{id}', 'RequirementController@getAdd');
        Route::post('/add', 'RequirementController@postAdd');
        Route::post('/add/{id}', 'RequirementController@postAdd');
        Route::get('/view/{id}', 'RequirementController@getView');
        Route::get('/delete/{id}', 'RequirementController@getDelete');
    });
    Route::prefix('cityslider')->group(function () {
        Route::get('/', 'CitySliderController@index');
        Route::get('/add', 'CitySliderController@getAdd');
        Route::get('/add/{id}', 'CitySliderController@getAdd');
        Route::post('/add', 'CitySliderController@postAdd');
        Route::post('/add/{id}', 'CitySliderController@postAdd');
        Route::get('/view/{id}', 'CitySliderController@getView');
        Route::get('/delete/{id}', 'CitySliderController@getDelete');
    });
    Route::prefix('navigator')->group(function () {
        Route::get('/', 'NavigatorController@index');
        Route::get('/add', 'NavigatorController@getAdd');
        Route::get('/add/{id}', 'NavigatorController@getAdd');
        Route::post('/add', 'NavigatorController@postAdd');
        Route::post('/add/{id}', 'NavigatorController@postAdd');
        Route::get('/view/{id}', 'NavigatorController@getView');
        Route::get('/delete/{id}', 'NavigatorController@getDelete');
    });
    Route::prefix('social')->group(function () {
        Route::get('/', 'SocialController@index');
        Route::get('/add', 'SocialController@getAdd');
        Route::get('/add/{id}', 'SocialController@getAdd');
        Route::post('/add', 'SocialController@postAdd');
        Route::post('/add/{id}', 'SocialController@postAdd');
        Route::get('/view/{id}', 'SocialController@getView');
        Route::get('/delete/{id}', 'SocialController@getDelete');
    });
    Route::prefix('meta')->group(function () {
        Route::get('/', 'MetaController@index');
        Route::get('/add', 'MetaController@getAdd');
        Route::get('/add/{id}', 'MetaController@getAdd');
        Route::post('/add', 'MetaController@postAdd');
        Route::post('/add/{id}', 'MetaController@postAdd');
        Route::get('/view/{id}', 'MetaController@getView');
        Route::get('/delete/{id}', 'MetaController@getDelete');
    });
    Route::prefix('partner')->group(function () {
        Route::get('/', 'PartnerController@index');
        Route::get('/add', 'PartnerController@getAdd');
        Route::get('/add/{id}', 'PartnerController@getAdd');
        Route::post('/add', 'PartnerController@postAdd');
        Route::post('/add/{id}', 'PartnerController@postAdd');
        Route::get('/view/{id}', 'PartnerController@getView');
        Route::get('/delete/{id}', 'PartnerController@getDelete');
    });
    Route::prefix('callback')->group(function () {
        Route::get('/', 'CallbackController@index');
        Route::get('/add', 'CallbackController@getAdd');
        Route::get('/add/{id}', 'CallbackController@getAdd');
        Route::post('/add', 'CallbackController@postAdd');
        Route::post('/add/{id}', 'CallbackController@postAdd');
        Route::get('/view/{id}', 'CallbackController@getView');
        Route::get('/delete/{id}', 'CallbackController@getDelete');
    });
    Route::prefix('article')->group(function () {
        Route::get('/', 'ArticleController@index');
        Route::get('/add', 'ArticleController@getAdd');
        Route::get('/add/{id}', 'ArticleController@getAdd');
        Route::post('/add', 'ArticleController@postAdd');
        Route::post('/add/{id}', 'ArticleController@postAdd');
        Route::get('/view/{id}', 'ArticleController@getView');
        Route::get('/delete/{id}', 'ArticleController@getDelete');
    });
    Route::prefix('proposal')->group(function () {
        Route::get('/', 'ProposalController@index');
        Route::get('/view/{id}', 'ProposalController@getView');
        Route::get('/delete/{id}', 'ProposalController@getDelete');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index');
    });
});

Route::prefix('ajax')->group(function () {
    Route::post('city/', 'AjaxController@getCity');
    Route::get('specialty/', 'AjaxController@getSpecialty');
    Route::post('subdirection/', 'AjaxController@getSubdirection');
    Route::post('specialties/', 'AjaxController@getSpecialties');
    Route::post('university/', 'AjaxController@postUniversity');
    Route::post('un/', 'AjaxController@getUn');
});

Route::prefix('poisk/')->group(function () {
    Route::get('/', 'PoiskController@index');
    Route::post('/', 'PoiskController@index');
    Route::get('/view/{id}', 'PoiskController@getView');
});

Route::get('/cabinet', 'CabinetController@index')->name('cabinet');

Route::get('/poisk/bakalavriat/', 'PoiskController@index')->name('bakalavriat');
Route::get('/poisk/magistratura/', 'PoiskController@index')->name('magistratura');
Route::get('/poisk/doktorantura/', 'PoiskController@index')->name('doktorantura');
Route::get('/calculator', 'СalculatorController@index')->name('calculator');
Route::post('/calculator', 'СalculatorController@postResult');
Route::get('/rating/', 'RatingController@index')->name('rating');
Route::get('/list/', 'ListController@index')->name('list');
Route::get('/fmain/{degree_id}/{direction_id}/{city_id}/{query}', 'ListController@getFmain')->name('list');
Route::get('/faqs', 'FaqController@index')->name('faqs');

Route::get('verify/{email}/{verify_token}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('/', 'IndexController@index')->name('index');
Route::get('/city/view/{id}', 'IndexController@getCity')->name('city');
Route::get('/navigator/view/{id}', 'IndexController@getNavigator')->name('navigator');
Route::get('/navigator', 'IndexController@getNavigator1')->name('navigator');
Route::get('/article/{id}', 'IndexController@getArticle')->name('article');
//Route::get('/test/', 'IndexController@getTest')->name('test');
Route::get('/callback', 'IndexController@getCallback')->name('callback');
Route::post('/callback', 'IndexController@postCallback');
Route::post('/proposal', 'IndexController@postProposal');

Route::get('/login', 'LoginController@showLoginForm');
Route::post('/logging', 'CustomAuthController@login')->name('logging');
Route::get('/forgot-passwd', 'PagesController@showForgotPasswd');
Route::get('/registration', 'PagesController@showRegistrationForm');
Route::get('/cabinet', 'PagesController@showCabinet');
Route::get('/change-pwd', 'PagesController@changePassword')->name('change-pwd');
Route::prefix('college/')->group(function (){
    Route::get('/{id?}', 'PagesController@showCollege')->name('college-list');
    Route::get('/view/{sid}/uid/{uid}', 'PagesController@viewCollege');
});
Route::get('/university-school/{pages}', 'PagesController@showUniversityAfterSchool')->name('uni-school');
Route::get('/university-college/{pages}', 'PagesController@showUniversityAfterCollege')->name('uni-col');
//Route::get('/magistr/{id?}/{degree}', 'PagesController@showMagistr');
Route::get('/doctor/{degree}/{pages}', 'PagesController@showDoctor')->name('doctor');
Route::get('/university/list/multiprofile', function (){
    return view('multiprofile-rating');
});
Route::prefix('faq/')->group(function (){
    Route::get('select-profession', 'PagesController@showFAQSelectProfession');
    Route::get('good', 'PagesController@showFAQGoodUni');
    Route::get('future', 'PagesController@showFAQFutureProfession');
    Route::get('open-door', 'PagesController@showFAQOpenDoors');
    Route::get('college', 'PagesController@showFAQToCollege');
    Route::get('univer', 'PagesController@showFAQToUni');
    Route::get('calc', 'PagesController@showFAQEntCalc');
});
Route::get('/list/partner', 'PagesController@partnerList');
Route::get('/list/univer', 'PagesController@univerList');
Route::get('/list/college', 'PagesController@collegeList');
Route::prefix('college')->group(function (){
    Route::get('/view/{id}/{name}', 'PagesController@viewCollegeFromList');
    Route::get('/achievements/{id}/{name}', 'PagesController@achievementsCollegeFromList');
    Route::get('/coop/{id}/{name}', 'PagesController@coopCollegeFromList');
    Route::get('/rating/{id}/{name}', 'PagesController@ratingCollegeFromList');
    Route::get('/discounts/{id}/{name}', 'PagesController@discountsCollegeFromList');
    Route::get('/edu/{id}/{name}', 'PagesController@eduCollegeFromList');
    Route::get('/docs/{id}/{name}', 'PagesController@docsCollegeFromList');
    Route::get('/contacts/{id}/{name}', 'PagesController@contactsCollegeFromList');
});
Route::post('cabinet/edit', 'UserController@edit');
Route::post('change-pwd/reset', 'UserController@resetPassword');
Route::get('cabinet/edit', 'UserController@update');
Route::get('/univer/view/{id}', 'PagesController@viewUniver');
//Route::get('sfsdghjjhgfgd', 'EpayController@requestResult');
Route::get('/calculator-ent', 'PagesController@entCalculator')->name('calculator-ent');
Route::post('/result-ent', 'PagesController@entResult')->name('result-ent');
Route::get('result-ent/{score}/{profs1}/{profs2}/{map}', 'PagesController@showENTResult')->name('ent-show');
Route::get('/result-ent2/{prob}/{score}/{profs1}/{profs2}', 'PagesController@entResult2')->name('result-ent2');
Route::get('/callback-view', 'PagesController@showCallback');
Route::post('payment', 'EpayController@payment')->name('payment');
Route::get('success-payment/{m}/{sum}', 'PagesController@successPayment')->name('success-payment');
Route::get('fail-payment/{m}', 'PagesController@failPayment')->name('fail-payment');
Route::get('show-payment/{m}', 'PagesController@showPayment')->name('show-payment');
Route::get('ajax-filter/{pages}/{query?}', 'AjaxController@doctorFilter');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
