<?php

$middleware = array_merge(\Config::get('lfm.middlewares'), ['\Unisharp\Laravelfilemanager\middleware\MultiUser']);
$prefix = \Config::get('lfm.prefix', 'laravel-filemanager');
$as = 'unisharp.lfm.';
$namespace = '\Unisharp\Laravelfilemanager\controllers';

// make sure authenticated
Route::group(compact('middleware', 'prefix', 'as', 'namespace'), function () {

    // Show LFM
    Route::get('/', [
        'uses' => 'LfmController@show',
        'as' => 'show'
    ]);

    // upload
    Route::any('/upload', [
        'uses' => 'UploadController@upload',
        'as' => 'upload'
    ]);

    // list images & files
    Route::get('/jsonitems', [
        'uses' => 'ItemsController@getItems',
        'as' => 'getItems'
    ]);

    // folders
    Route::get('/newfolder', [
        'uses' => 'FolderController@getAddfolder',
        'as' => 'getAddfolder'
    ]);
    Route::get('/deletefolder', [
        'uses' => 'FolderController@getDeletefolder',
        'as' => 'getDeletefolder'
    ]);
    Route::get('/folders', [
        'uses' => 'FolderController@getFolders',
        'as' => 'getFolders'
    ]);

    // crop
    Route::get('/crop', [
        'uses' => 'CropController@getCrop',
        'as' => 'getCrop'
    ]);
    Route::get('/cropimage', [
        'uses' => 'CropController@getCropimage',
        'as' => 'getCropimage'
    ]);

    // rename
    Route::get('/rename', [
        'uses' => 'RenameController@getRename',
        'as' => 'getRename'
    ]);

    // scale/resize
    Route::get('/resize', [
        'uses' => 'ResizeController@getResize',
        'as' => 'getResize'
    ]);
    Route::get('/doresize', [
        'uses' => 'ResizeController@performResize',
        'as' => 'performResize'
    ]);

    // download
    Route::get('/download', [
        'uses' => 'DownloadController@getDownload',
        'as' => 'getDownload'
    ]);

    // delete
    Route::get('/delete', [
        'uses' => 'DeleteController@getDelete',
        'as' => 'getDelete'
    ]);

    Route::get('/demo', 'DemoController@index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);



Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', function(){

        return view('admin.index');


    });


    Route::resource('admin/users', 'AdminUsersController');

    Route::resource('admin/posts', 'AdminPostsController');

    Route::resource('admin/categories', 'AdminCategoriesController');

    Route::resource('admin/media', 'AdminMediasController');


    Route::resource('admin/comments', 'PostCommentsController');

    Route::resource('admin/comment/replies', 'CommentRepliesController');

});



Route::group(['middleware'=>'auth'], function(){



    Route::post('comment/reply', 'CommentRepliesController@createReply');



});



