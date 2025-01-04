<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Question;
use Illuminate\Support\Facades\Validator;
class QuizController extends Controller
{
    // ... other methods ...

    public function submitQuiz(Request $request) {
        try {
            // Validasi
            $validator = Validator::make($request->all(), [
                'quiz_id' => 'required|exists:quizzes,id',
                'answers' => 'required|array',
                'answers.*' => 'in:a,b,c,d',
                ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422); // 422 Unprocessable Entity
            }

            $quizId = $request->input('quiz_id');
            $userAnswers = $request->input('answers');
            $correctAnswers = []; // Array untuk menyimpan status jawaban (benar/salah)

            $questions = Question::where('quiz_id', $quizId)->get();

            foreach ($questions as $question) {
                $questionId = $question->id;
                $isCorrect = false; // Default-nya salah

                if (isset($userAnswers[$questionId]) && $userAnswers[$questionId] == $question->correct_answer) {
                    $isCorrect = true; // Jika benar, ubah jadi true
                }

                $correctAnswers[$questionId] = $isCorrect; // Simpan status benar/salah
            }

            return response()->json([
                'message' => 'Quiz submitted successfully.',
                'correct_answers' => $correctAnswers // Kirim array status jawaban saja
            ]);

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error submitting quiz: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

            // Kembalikan response JSON dengan pesan error umum
            return response()->json([
                'error' => 'Terjadi kesalahan saat mengirim kuis.',
                'message' => 'Internal server error'
            ], 500);
        }
    }
}
