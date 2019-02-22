<?php

// //tutapp
// Route::get('/tuthome', 'TutHomeController@index');
// /*route for handling user block*/
// Route::get('user/{id}/block','Admin\adminController@blockUser')
// ->name('blockUser');

// /*route for handling user unblock*/
// Route::get('user/{id}/unblock','Admin\adminController@unblockUser')
// ->name('unblockUser');

// /*serve a course's cover image */
// Route::get('cover/{id}','mentor\mentorController@coverImage')
// ->name('coverImage');


// /*serve a course's video lesson */
// Route::get('videos/{id}','mentor\mentorController@serveVideo')
// ->name('serveVideo');

// /*serve a course's Ebook */
// Route::get('ebooks/{id}','mentor\mentorController@serveEbook')
// ->name('serveEbook');

// Route::get('blocked','TutHomeController@blocked')
// ->name('blocked');


// Public Routes

        // Homepage Route
        // Route::get( '/_debugbar/assets/stylesheets', '\Barryvdh\Debugbar\Controllers\AssetController@css' );
        
        // Route::get( '/_debugbar/assets/javascript', '\Barryvdh\Debugbar\Controllers\AssetController@js' );


        Route::get('/_debugbar/assets/stylesheets', [
            'as' => 'debugbar-css',
            'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css'
        ]);
        
        Route::get('/_debugbar/assets/javascript', [
            'as' => 'debugbar-js',
            'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js'
        ]);
        
        Route::get('/_debugbar/open', [
            'as' => 'debugbar-open',
            'uses' => '\Barryvdh\Debugbar\Controllers\OpenController@handler'
        ]);
    Route::get('/', 'WelcomeController@welcome')->name('welcome');
    
    // Route::get('/', function () { return redirect('/admin/home'); });
    Route::resource('institutes','InstitutesController');
    Route::get('/download/{file}', 'DownloadsController@download')->name('download');
    // Authentication Routes
            // Authentication Routes...
            $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
            $this->post('login', 'Auth\LoginController@login');
            $this->post('logout', 'Auth\LoginController@logout')->name('logout');
    
            // Registration Routes...
            $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            $this->post('register', 'Auth\RegisterController@register');
    
            // Password Reset Routes...
            $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
            $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
            $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    // Auth::routes();
    Route::group(['middleware' => ['web', 'activity']], function () {
        // app('debugbar')->disable();
        
        // Activation Routes
        Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

        Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
        Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
        Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

        // Socialite Register Routes
        Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
        Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

        // Route to for user to reactivate their user deleted account.
        Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
    });

    // Registered and Activated User Routes
    Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

        // Activation Routes
        Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
        Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
        
    });
    // Registered and Activated User Routes
    Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {
        Route::get('/notify', 'EmailController@autoEmail');

            Route::get('/notifynewstudents', 'EmailController@autoEmail2newstudents');
            Route::get('/notifyusers', 'EmailController@autoEmail2users');
        // app('debugbar')->disable();
        //  Homepage Route - Redirect based on user role is in controller.
        // Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);
        // Change Password Routes...
        $this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
        $this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
        $this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

        // Route::get('auth/logout', 'Auth\AuthController@logout');

        Route::get('/home', ['as' => 'public.home',   'uses' => 'HomeController@index']);
        Route::get('/dashboard', ['as' => 'public.dashboard',   'uses' => 'DashboardController@index']);
        // Route::get('/home', 'HomeController@index');
        //tutapp
        Route::get('/tuthome', 'TutHomeController@index');
        /*route for handling user block*/
        Route::get('user/{id}/block','Admin\adminController@blockUser')
        ->name('blockUser');

        /*route for handling user unblock*/
        Route::get('user/{id}/unblock','Admin\adminController@unblockUser')
        ->name('unblockUser');

        /*serve a course's cover image */
        Route::get('cover/{id}','mentor\mentorController@coverImage')
        ->name('coverImage');

        Route::get('profilepic/{id}','mentor\mentorController@profileImage')
        ->name('profileImage');

        Route::get('cvs/{id}','mentor\mentorController@cvs')
        ->name('cvs');

        /*serve a course's video lesson */
        Route::get('videos/{id}','mentor\mentorController@serveVideo')
        ->name('serveVideo');

        /*serve a course's Ebook */
        Route::get('ebooks/{id}','mentor\mentorController@serveEbook')
        ->name('serveEbook');

        Route::get('blocked','TutHomeController@blocked')
        ->name('blocked');
        // // Show users profile - viewable by other users.
        Route::get('profile/{username}', [
            'as'   => '{username}',
            'uses' => 'ProfilesController@show',
        ]);
        Route::resource('AdminTasks','AdminTasksController');
        Route::get('mentor/course/{id}/AdminTasks/gettasks', ['as' => 'AdminTasks.getTasks',   'uses' => 'AdminTasksController@getTasks']);
        Route::resource('AssignTasks','AssignTasksController');
        Route::resource('UserProfile','UserProfileController');
        Route::resource('Profiles','ProfilesController');
        Route::resource('viewprofile','ViewprofileController');
        Route::resource('TaskMigrate','TaskMigrateController');
        Route::resource('UserTasks','UserTasksController');
        Route::resource('Charts','ChartController');
        Route::resource('Subject','SubjectController');
        Route::resource('User','UserController');
        Route::resource('online_quiz','OnlineQuizController');
        Route::resource('online_quiz_questions','OnlineQuizQuestionsController');

        Route::resource('institute','InstitutesController');

        //Download a file
    // Route::get('/download/{file}', 'DownloadsController@download');
    });
    
    Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        // Route::get('/home', 'HomeController@index');
        // Route::get('/home', ['as' => 'public.home',   'uses' => 'HomeController@index']);
        
        Route::resource('permissions', 'Admin\PermissionsController');
        Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
        Route::resource('roles', 'Admin\RolesController');
        Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
        Route::resource('users', 'Admin\UsersController');
        Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

 
     
    
    });



