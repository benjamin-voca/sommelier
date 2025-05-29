<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

Route::middleware('api')->group(function () {
    Route::get('/search', function (Request $request) {
        $request->validate([
            'search' => 'required|string',
        ]);

        try {
            $searchTerm = '%' . $request->search . '%';
            $results = DB::select(
                'SELECT * FROM Fragrances WHERE dior LIKE ? OR original LIKE ? OR dupe LIKE ?',
                [$searchTerm, $searchTerm, $searchTerm]
            );

            return response()->json([
                'success' => true,
                'count' => count($results),
                'results' => $results
            ]);


        } catch (\Exception $e) {
            Log::error("Search error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing request',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    Route::get('/test', function () {
        return response()->json(['message' => 'API working!']);
    });
});
