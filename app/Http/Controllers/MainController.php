<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class MainController extends Controller
{
    public $appData;

    public function __construct()
    {
        $this->appData = require(app_path('appData.php'));
    }

    public function startGame(): View
    {
        return view('home');
    }

    public function prepareGame(Request $request)
    {
        // Validar request
        $validated = $request->validate(
            [
                'total_questions' => 'required|integer|min:3|max:30',
            ],
            [
                'total_questions.required' => 'O número de questões é obrigatório.',
                'total_questions.integer'  => 'O número de questões precisa ser um valor inteiro.',
                'total_questions.min'      => 'O mínimo permitido é :min questões.',
                'total_questions.max'      => 'O máximo permitido é :max questões.',
            ]
        );

        // get total questions
        $total_questions = intval($request->input('total_questions'));
        $quiz = $this->prepareQuiz($total_questions);

        dd($quiz);
    }

    private function prepareQuiz(int $totalQuestions): array
    {
        /*  $countries = $this->appData['countries'];
        shuffle($countries);

        $quiz = [];
        for ($i = 0; $i < $totalQuestions; $i++) {
            $country = array_shift($countries);
            $quiz[] = [
                'country' => $country['country'],
                'capital' => $country['capital'],
            ];
        }

        return $quiz; */
    }
}
