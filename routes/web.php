<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

Route::controller(ListController::class)->group(function () {
    Route::get("/","index");
    Route::get("listing/{list}","show");
    Route::get("createjob","showform")->middleware("auth");
    Route::post("tostore","store");
    Route::get("edit/{id}","edit")->name("edit")->middleware("auth");
    Route::put("update/{id}","update")->name("update")->middleware("auth");
    Route::delete("delete/{id}","destroy")->name("delete")->middleware("auth");
    Route::get("manage","manage")->name("manage")->middleware("auth");
});

Route::controller(UserController::class)->group(function () {
    Route::get("register","showregister")->name("showregister")->middleware("guest");
    Route::get("login","showlogin")->name("showlogin")->middleware("guest");
    Route::post("register","SaveRegisterInfo")->name("register");
    Route::post("login","login")->name("login");
    Route::get("logout","logout")->name("logout")->middleware("auth");

});


//Route::get('/', function () {
//    return view('listings',["listings"=>\App\Models\Listing::all()]);
//});

//Route::get("listing/{id}",function ($id)
//{
//    $list=\App\Models\Listing::find($id);
//    if ($list){
//        return view("listing",compact("id","list"));
//    }
//    else
//    {
//        abort("404");
//    }
//
//
//});

//Route::get("listing/{list}",function (Listing $list)
//{
//        return view("listing",compact("list"));
//});
