<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminQuestionController as AdminAdminQuestionController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TryoutController;
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

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})


    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
    Route::get("/tryout/start", [TryoutController::class, "start"])->name(
        "tryout.start",
    );
    Route::post("/tryout/answer", [
        TryoutController::class,
        "storeAnswer",
    ])->name("tryout.answer");

    Route::post("/tryout/finish", [TryoutController::class, "finish"])->name(
        "tryout.finish",
    );

    Route::get("/tryout/{tryout}/result", [
        TryoutController::class,
        "result",
    ])->name("tryout.result");

    Route::get("/tryout/{tryout}/review", [
        TryoutController::class,
        "review",
    ])->name("tryout.review");

    Route::get("/tryout/history", [TryoutController::class, "history"])->name(
        "tryout.history",
    );

    Route::get("/tryout/progress", [TryoutController::class, "progress"])->name(
        "tryout.progress",
    );

    // testbuat halaman lain
    Route::get("/cobadulu", function () {
    return view("cobadulu");
});
});

Route::middleware(["auth", "admin"])
    ->prefix("admin")
    ->group(function () {
        Route::get("/dashboard", [
            AdminDashboardController::class,
            "dashboard",
        ])->name("admin.dashboard");

        Route::get("/users", [AdminDashboardController::class, "users"])->name(
            "admin.users",
        );

        Route::patch("/users/{user}/role", [
            AdminDashboardController::class,
            "updateRole",
        ])->name("admin.users.updateRole");

        Route::delete("/users/{user}", [
            AdminDashboardController::class,
            "destroyUser",
        ])->name("admin.users.destroyUser");

        Route::get("/users/trash", [
            AdminDashboardController::class,
            "trash",
        ])->name("admin.users.trash");

        Route::patch("/users/{user}/restore", [
            AdminDashboardController::class,
            "restore",
        ])->name("admin.users.restore");

        Route::delete("/users/{user}/force-delete", [
            AdminDashboardController::class,
            "forceDelete",
        ])->name("admin.users.forceDelete");

        Route::resource("questions", AdminAdminQuestionController::class)->except([
            "show",
        ]);
    });

require __DIR__ . "/auth.php";
