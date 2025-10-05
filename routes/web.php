<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\LocalSaleController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\WebPageController;
use App\Mail\StudentRegistrationMailable;
use App\Models\District;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Blog\Http\Controllers\BlogController;
use Modules\Sales\Http\Controllers\SalesController;
use App\Http\Controllers\WebController;

// PAGINA WEB //
// Route::get('/', [WebPageController::class, 'construction'])->name('construction');
Route::get('/', [WebPageController::class, 'index'])->name('index_main');
Route::get('/home', [WebPageController::class, 'index'])->name('index_main_home');
Route::get('/home2', [WebPageController::class, 'index2'])->name('index_main_home2');
Route::get('/nosotros', [WebPageController::class, 'about'])->name('web_about');
Route::get('/landing/{slug}', [WebPageController::class, 'landing'])->name('web_landing');

Route::get('/el-amauta-de-las-niif', [WebPageController::class, 'bookamauta'])->name('web_book_amauta');
Route::get('/planes-de-suscripcion', [WebPageController::class, 'subscriptions'])->name('web_subscriptions');
Route::get('/politicas-de-devolucion', [WebPageController::class, 'politicas_devoluciones'])->name('politicas_devoluciones');
Route::get('/Terminos-y-condiciones', [LandingController::class, 'terms'])->name('terms_main');  //terminos y condiciones
Route::get('/politicas_privacidad', [WebPageController::class, 'privacypolicies'])->name('politicas_privacidad');
//Route::get('/terminos-y-condiciones', [WebPageController::class, 'terms'])->name('terms_main'); //ya está hecho

Route::get('/cursos', [WebPageController::class, 'courses'])->name('web_courses');
Route::get('/curso-descripcion/{id}', [WebPageController::class, 'coursedescription'])->name('web_course_description');
Route::get('/carrito', [WebPageController::class, 'shopcart'])->name('web_carrito');
Route::get('/metodos-de-pago', [WebPageController::class, 'accounts'])->name('web_accounts');
Route::get('/pagar', [WebPageController::class, 'pay'])->name('web_pay');
Route::post('/safe_pay', [WebPageController::class, 'pagar'])->name('paying');
Route::post('/user_safe_pay', [WebPageController::class, 'pagar_auth'])->name('paying_auth');
Route::get('/gracias/{id}', [WebPageController::class, 'thanks'])->name('web_thanks');
Route::get('/curso-descripcion-x/{id}', [WebPageController::class, 'cursodescripcion'])->name('web_curso_descripcion');
Route::get('/prices/academic', [LandingController::class, 'academicPrices'])->name('academic_prices');


Route::get('/libro-de-reclamaciones',  [WebPageController::class, 'claims'])->name('web_claims');

// E-MAIL //
Route::get('/email', [WebPageController::class, 'email'])->name('web_email');
Route::get('/e-libro-de-reclamaciones', [WebPageController::class, 'eclaims'])->name('web_e_claims');

//////mensajes de whatsapp///////
Route::get('/ask/product/{id}', [LandingController::class, 'redirectToWhatsApp'])->name('whatsapp_send');

/////cunsulta comprobante electronico ///////////
Route::get('/find/invoice', [SalesController::class, 'findInvoice'])->name('find_electronic_invoice');
Route::post('/find/invoice', [SalesController::class, 'clientSearchDocument'])->name('client_search_electronic_invoice');

// Route::get('/blog/home', [BlogController::class, 'index'])->name('blog_principal');
// Route::get('/article/{url}', [BlogController::class, 'article'])->name('blog_article_by_url');
// Route::get('/category/{id}', [BlogController::class, 'category'])->name('blog_category');
// Route::get('/policies', [BlogController::class, 'policies'])->name('blog_policies');
// Route::get('/contact-us', [BlogController::class, 'contactUs'])->name('blog_contact_us');

Route::get('/stories/article/{url}', [BlogController::class, 'storiesArticle'])->name('blog_stories_article_by_url');
Route::get('/stories/policies', [BlogController::class, 'storiesPolicies'])->name('blog_stories_policies');
Route::get('/stories/contact-us', [BlogController::class, 'storiesContactUs'])->name('blog_stories_contact_us');
Route::put('/process_payment/{id}/{student_id}', [WebController::class, 'processPayment'])->name('web_process_payment');


Route::get('/mipais', function () {
    $ip = $_SERVER['REMOTE_ADDR']; // Esto contendrá la ip de la solicitud.

    // Puedes usar un método más sofisticado para recuperar el contenido de una página web con PHP usando una biblioteca o algo así
    // Vamos a recuperar los datos rápidamente con file_get_contents
    $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

    //var_dump($dataArray);

    dd($dataArray);
});

// Route::get('/email', function () {
//     Mail::to('elrodriguez2423@gmail.com')
//         ->send(new StudentRegistrationMailable('data'));
//     return 'mensaje enviado';
// });



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class);
    Route::resource('establishments', LocalSaleController::class);
    Route::resource('modulos', ModuloController::class);
    Route::get('modulos/permissions/{id}/add', [ModuloController::class, 'permissions'])->name('modulos_permissions');
    Route::post('modulos/permissions/store', [ModuloController::class, 'storePermissions'])->name('modulos_permissions_store');
    Route::delete('establishments/destroies/{id}', [LocalSaleController::class, 'destroy'])->name('establishment_destroies');
    Route::post('establishments/updated', [LocalSaleController::class, 'update'])->name('establishment_updated');

    Route::get(
        'inventory/product/establishment',
        [KardexController::class, 'index']
    )->name('kardex_index');

    Route::post(
        'inventory/product/sizes',
        [KardexController::class, 'kardexDeailsSises']
    )->name('kardex_sizes');

    Route::post(
        'search/person/number',
        [PersonController::class, 'searchByNumberType']
    )->name('search_person_number');

    Route::post(
        'search/person/apies',
        [PersonController::class, 'searchByNumberTypeApies']
    )->name('search_person_apies');


    Route::post(
        'save/person/update/create',
        [PersonController::class, 'saveUpdateOrCreate']
    )->name('save_person_update_create');

    Route::post(
        'search/person/full_name/number',
        [PersonController::class, 'searchByNameOrNumber']
    )->name('search_person_fullname_number');

    Route::get(
        'general/stock',
        [KardexController::class, 'generalStock']
    )->name('generalstock');



    Route::get(
        'company/show',
        [CompanyController::class, 'show']
    )->name('company_show');

    Route::post(
        'company/update_create',
        [CompanyController::class, 'updateCreate']
    )->name('company_update_create');

    Route::get(
        'company/getdata',
        [CompanyController::class, 'getdata']
    )->middleware(['auth', 'verified'])->name('datosempresa');

    Route::post(
        'company/convert_upload_certificate',
        [CompanyController::class, 'convertUploadCertificate']
    )->name('company_convert_upload_certificate');

    Route::post(
        'company/sunat/credentials',
        [CompanyController::class, 'saveSunatCredentials']
    )->name('company_save_sunat_credentials');

    Route::post(
        'company/social/networks',
        [CompanyController::class, 'saveSocialNetworks']
    )->name('company_save_social_networks');

    Route::post(
        'company/upload/images',
        [CompanyController::class, 'uploadImages']
    )->name('company_upload_images');

	Route::post(
        'user/persom/info/store',
        [PersonController::class, 'updateInfoPersonByUser']
    )->name('user_persom_info_store');

    Route::get('parameters/list', [ParametersController::class, 'index'])->name('parameters');
    Route::get('parameters/create', [ParametersController::class, 'create'])->name('parameters_create');
    Route::post('parameters/store', [ParametersController::class, 'store'])->name('parameters_store');
    Route::get('parameters/{id}/edit', [ParametersController::class, 'edit'])->name('parameters_edit');
    Route::put('parameters/update/{id}', [ParametersController::class, 'update'])->name('parameters_update');
    Route::get('parameters/{id}/{val}/default', [ParametersController::class, 'updateDefaultValue'])->name('parameters_update_default_value');

    ////////////////actualizar informacion de personas
    Route::get('person/update_information', function () {
        $person = Person::find(Auth::user()->person_id);
        $identityDocumentTypes = DB::table('identity_document_type')->get();

        $ubigeo = District::join('provinces', 'province_id', 'provinces.id')
            ->join('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'districts.id AS district_id',
                'districts.name AS district_name',
                'provinces.name AS province_name',
                'departments.name AS department_name'
            )
            ->get();

        if (Auth::user()->hasRole('Alumno')) {
            return Inertia::render('Person/UpdateInformation', [
                'person' => $person,
                'identityDocumentTypes' => $identityDocumentTypes,
                'ubigeo' => $ubigeo
            ]);
        } else {
            return back();
        }
    })->name('user-update-profile');

    Route::post(
        'person/update_information/store',
        [PersonController::class, 'updateInformationPerson']
    )->name('user-update-profile-store');

    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar');

	Route::post(
        'person/birthdays',
        [PersonController::class, 'getBirthdays']
    )->name('person-birthdays');

    ///////////////META FACEBOOK WHATSAPP/////////////////

    Route::post('meta/whatsapp/message/send', [MetaController::class, 'sendMessageWhatsapp'])->name('meta_whatsapp_message_send');
});


//CERTIFICADOS AUTOMATIZACIÓN Y PRUEBAS
Route::get('/test-image/{student_id}/{certificate_id}', [WebController::class, 'testimage'])->name('test-image');

Route::post('landing/store/course-free',[WebPageController::class, 'storeCourseFree'])
    ->name('landing_store_course_free');

require __DIR__ . '/auth.php';
require __DIR__ . '/system.php';
