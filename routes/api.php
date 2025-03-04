<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DeliveryPointController;

    Route::post('/delivery', [DeliveryPointController::class, 'store']);
    Route::get('/delivery', [DeliveryPointController::class, 'index']);
    Route::get('/delivery/{id}', [DeliveryPointController::class, 'show']);
?>
