<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediction;
use Illuminate\Support\Facades\Storage;

class PredictionController extends Controller
{
    public function savePrediction(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public');

            // Process the file and get the prediction data
            $prediction = [
                'file' => $filePath,
                'predicted_sleep_disorder' => 'Sleep Apnea', // Replace with the actual prediction
                'quality_of_sleep' => 3, // Replace with the actual value
                'sleep_duration' => 6.5, // Replace with the actual value
            ];

            Prediction::create($prediction);

            return response()->json($prediction);
        }

        return response()->json(['error' => 'No file uploaded'], 422);
    }
}