<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Support\Facades\Log;

Route::middleware('api')->group(function () {
    Route::get('/search', function (Request $request) {
        $request->validate([
            'search' => 'required|string',
        ]);

        try {
            $csv = Reader::createFromPath(storage_path('app/data.csv'), 'r');
            $csv->setHeaderOffset(0);

            // Correctly process records using the Statement
            $stmt = (new Statement())
                ->where(function (array $record) use ($request) {
                    $searchTerm = strtolower($request->search);
                    
                    foreach ($record as $value) {
                        // Check if any column contains the search term
                        if (str_contains(strtolower($value), $searchTerm)) {
                            return true; // Include this record in results
                        }
                    }
                    return false;
                });

            // Execute the search
            $results = $stmt->process($csv);
            
            return response()->json([
                'success' => true,
                'count' => $results->count(),
                'results' => iterator_to_array($results)
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
