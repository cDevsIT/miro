use App\Http\Controllers\Admin\AttributeController;

Route::get('/attributes', [AttributeController::class, 'index']);
Route::post('/attributes', [AttributeController::class, 'store']);
Route::get('/attributes/{attribute}', [AttributeController::class, 'edit']);
Route::put('/attributes/{attribute}', [AttributeController::class, 'update']);
Route::delete('/attributes/{attribute}', [AttributeController::class, 'destroy']); 