{{-- resources/views/quiz.blade.php --}}
<x-main-layout pageTitle="Questão {{ $question_number }}">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                {{-- Progress Bar --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success">Score: {{ session('score', 0) }}</span>
                        <span class="text-muted">{{ $question_number }} / {{ $total_questions }}</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary"
                             role="progressbar"
                             style="width: {{ ($question_number / $total_questions) * 100 }}%"
                             aria-valuenow="{{ $question_number }}"
                             aria-valuemin="0"
                             aria-valuemax="{{ $total_questions }}">
                        </div>
                    </div>
                </div>

                {{-- Question Card --}}
                <div class="card shadow-sm">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title mb-4">Qual é a capital de:</h5>
                        <h2 class="display-5 text-primary mb-4">{{ $question['country'] }}</h2>

                        {{-- Options Form --}}
                        <form action="{{ route('process_answer', ['question_number' => $question_number]) }}" method="post">
                            @csrf
                            <div class="d-grid gap-3">
                                @foreach ($question['options'] as $index => $option)
                                    <button
                                        class="btn btn-outline-primary btn-lg text-start p-3 option-btn"
                                        name="option"
                                        value="{{ $option }}"
                                        type="submit"
                                    >
                                        <span class="badge bg-primary me-2">{{ chr(65 + $index) }}</span>
                                        {{ $option }}
                                    </button>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Navigation hint --}}
                <div class="text-center mt-3">
                    <small class="text-muted">
                        Clique em uma das opções para continuar
                    </small>
                </div>

            </div>
        </div>
    </div>

    <style>
        .option-btn:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
    </style>
</x-main-layout>
