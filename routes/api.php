<?php
// need to login
Route::middleware(['auth.api'])->group(function () {

});
authRoutes('api');