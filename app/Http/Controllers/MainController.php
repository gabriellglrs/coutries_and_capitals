<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MainController extends Controller
{
    private array $appData;
    private const MIN_QUESTIONS = 3;
    private const MAX_QUESTIONS = 30;
    private const MIN_OPTIONS = 4;

    public function __construct()
    {
        $this->appData = require(app_path('appData.php'));
    }

    public function startGame(): View
    {
        return view('home');
    }

    public function prepareGame(Request $request): RedirectResponse
    {
        // Validar request
        $validated = $request->validate(
            [
                'total_questions' => 'required|integer|min:' . self::MIN_QUESTIONS . '|max:' . self::MAX_QUESTIONS,
            ],
            [
                'total_questions.required' => 'O número de questões é obrigatório.',
                'total_questions.integer'  => 'O número de questões precisa ser um valor inteiro.',
                'total_questions.min'      => 'O mínimo permitido é :min questões.',
                'total_questions.max'      => 'O máximo permitido é :max questões.',
            ]
        );

        // Limpa a sessão de um jogo anterior
        $this->clearGameSession($request);

        // Get total questions
        $totalQuestions = $validated['total_questions'];

        // Validate if we have enough data
        if ($totalQuestions > count($this->appData)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['total_questions' => 'Não temos dados suficientes para ' . $totalQuestions . ' questões.']);
        }

        $quiz = $this->prepareQuiz($totalQuestions);

        // Adicionar opções de resposta para cada pergunta
        $quizWithOptions = $this->prepareQuizWithOptions($quiz);

        // Guardar o quiz na sessão
        $this->initializeGameSession($request, $quizWithOptions, $totalQuestions);

        // Redirecionar para a primeira pergunta do quiz
        return redirect()->route('show_question', ['question_number' => 1]);
    }

    public function showQuestion(Request $request, int $question_number): View|RedirectResponse
    {
        // Verificar se há um jogo ativo
        if (!$this->hasActiveGame($request)) {
            return redirect()->route('start_game');
        }

        $quiz = $request->session()->get('quiz');
        $totalQuestions = $request->session()->get('total_questions');
        $currentQuestion = $request->session()->get('current_question');

        // Garante que o usuário não pule perguntas pela URL
        if ($question_number !== $currentQuestion) {
            return redirect()->route('show_question', ['question_number' => $currentQuestion]);
        }

        // Se já respondeu todas as perguntas
        if ($question_number > $totalQuestions) {
            return redirect()->route('show_results');
        }

        // Validar se a questão existe
        if (!isset($quiz[$question_number - 1])) {
            return redirect()->route('start_game');
        }

        return view('quiz', [
            'question' => $quiz[$question_number - 1],
            'question_number' => $question_number,
            'total_questions' => $totalQuestions
        ]);
    }

    public function processAnswer(Request $request, int $question_number): RedirectResponse
    {
        // Verificar se há um jogo ativo
        if (!$this->hasActiveGame($request)) {
            return redirect()->route('start_game');
        }

        // Valida se uma opção foi enviada
        $validated = $request->validate([
            'option' => 'required|string'
        ], [
            'option.required' => 'Você deve selecionar uma opção.'
        ]);

        // Pega os dados da sessão
        $quiz = $request->session()->get('quiz');
        $totalQuestions = $request->session()->get('total_questions');
        $currentQuestion = $request->session()->get('current_question');

        // Verificar se é a pergunta correta
        if ($question_number !== $currentQuestion) {
            return redirect()->route('show_question', ['question_number' => $currentQuestion]);
        }

        // Verificar se a pergunta existe
        if (!isset($quiz[$question_number - 1])) {
            return redirect()->route('start_game');
        }

        // Verifica se a resposta está correta
        $correctAnswer = $quiz[$question_number - 1]['capital'];
        if ($validated['option'] === $correctAnswer) {
            $this->incrementScore($request);
        }

        // Avança para a próxima pergunta
        $nextQuestionNumber = $question_number + 1;
        $request->session()->put('current_question', $nextQuestionNumber);

        if ($nextQuestionNumber > $totalQuestions) {
            return redirect()->route('show_results');
        }

        return redirect()->route('show_question', ['question_number' => $nextQuestionNumber]);
    }

    public function showResults(Request $request)
    {
        // Se não há jogo ativo, redirecionar
        if (!$this->hasActiveGame($request)) {
            return redirect()->route('start_game');
        }

        $score = $request->session()->get('score', 0);
        $total_questions = $request->session()->get('total_questions', 0);

        // Calcular percentual
        $percentage = $total_questions > 0 ? round(($score / $total_questions) * 100, 1) : 0;

        // Determinar mensagem baseada na performance
        $message = $this->getPerformanceMessage($percentage);

        // Limpa a sessão do quiz para poder jogar de novo
        $this->clearGameSession($request);

        return view('results', compact('score', 'total_questions', 'percentage', 'message'));
    }

    /**
     * Prepara o quiz selecionando questões aleatórias
     */
    private function prepareQuiz(int $totalQuestions): array
    {
        return Arr::random($this->appData, $totalQuestions);
    }

    /**
     * Adiciona opções de resposta para cada pergunta
     */
    private function prepareQuizWithOptions(array $quiz): array
    {
        $allCapitals = array_column($this->appData, 'capital');

        foreach ($quiz as &$question) {
            // Remove a capital correta da lista de possíveis respostas erradas
            $wrongCapitals = array_diff($allCapitals, [$question['capital']]);

            // Seleciona 3 capitais erradas aleatoriamente
            $selectedWrongCapitals = Arr::random($wrongCapitals, self::MIN_OPTIONS - 1);

            // Combina resposta correta com as erradas
            $question['options'] = array_merge($selectedWrongCapitals, [$question['capital']]);

            // Embaralha as opções
            shuffle($question['options']);
        }

        return $quiz;
    }

    /**
     * Limpa a sessão do jogo
     */
    private function clearGameSession(Request $request): void
    {
        $request->session()->forget(['quiz', 'current_question', 'total_questions', 'score']);
    }

    /**
     * Inicializa a sessão do jogo
     */
    private function initializeGameSession(Request $request, array $quiz, int $totalQuestions): void
    {
        $request->session()->put('quiz', $quiz);
        $request->session()->put('total_questions', $totalQuestions);
        $request->session()->put('current_question', 1);
        $request->session()->put('score', 0);
    }

    /**
     * Verifica se há um jogo ativo
     */
    private function hasActiveGame(Request $request): bool
    {
        return $request->session()->has(['quiz', 'current_question', 'total_questions', 'score']);
    }

    /**
     * Incrementa o score do jogador
     */
    private function incrementScore(Request $request): void
    {
        $currentScore = $request->session()->get('score', 0);
        $request->session()->put('score', $currentScore + 1);
    }

    /**
     * Retorna uma mensagem baseada na performance do jogador
     */
    private function getPerformanceMessage(float $percentage): string
    {
        return match (true) {
            $percentage >= 90 => 'Excelente! Você é um expert em geografia!',
            $percentage >= 80 => 'Muito bom! Você conhece bem os países e capitais!',
            $percentage >= 70 => 'Bom trabalho! Continue estudando!',
            $percentage >= 60 => 'Não está mal, mas há espaço para melhoria!',
            $percentage >= 50 => 'Resultado mediano. Que tal estudar um pouco mais?',
            default => 'Precisa estudar mais geografia. Não desista!'
        };
    }
}
