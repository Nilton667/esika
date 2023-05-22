<?php

/**
 * Test API
 */
Route::get('/', function() {
    return response()->json(['message' => 'ok']);
});
