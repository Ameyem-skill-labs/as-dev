<?php

Route::group(['middleware' => ('role:admin') ,'prefix' => 'admin'], function () {

    /*Show mentors dashboard when logged in */
    Route::get('dashboard','Admin\adminController@showDashboard')
        ->name('adminDash');

    /*Show mentors dashboard when logged in */
    Route::get('cv/pending','Admin\adminController@ReviewCV')
        ->name('ReviewCV');

    /*approve CV */
    Route::get('cv/{id}/approve','Admin\adminController@approveCV')
        ->name('approveCV');

    /*disapprove CV */
    Route::get('cv/{id}/disapproveCV','Admin\adminController@disapproveCV')
        ->name('disapproveCV');

    /*preview a cv in a pdf view*/
    Route::get('cv/preview/{id}','Admin\adminController@CVpdfview')
        ->name('CVpdfview');

    /*List all students*/
    Route::get('students/all','Admin\adminController@AllStudents')
        ->name('Allstudents');

    /*List all courses*/
    Route::get('courses/all','Admin\adminController@Allcourses')
        ->name('Allcourses');

    /*Approve a particular course*/
    Route::get('courses/{id}/approve','Admin\adminController@approveCourse')
        ->name('approveCourse');

    /*Disapprove a particular course*/
    Route::get('courses/{id}/disapprove','Admin\adminController@disapproveCourse')
        ->name('disapproveCourse');
});


