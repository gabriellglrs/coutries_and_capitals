{{-- resources/views/results.blade.php --}}
<x-main-layout pageTitle="Resultados">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow">
                    <div class="card-body text-center p-5">

                        {{-- Result Icon --}}
                        <div class="mb-4">
                            @if($percentage >= 80)
                                <span class="display-1">🏆</span>
                            @elseif($percentage >= 60)
                                <span class="display-1">🎉</span>
                            @else
                                <span class="display-1">📚</span>
                            @endif
                        </div>

                        <h2 class="mb-4">Resultados Finais</h2>

                        {{-- Score Display --}}
                        <div class="mb-4">
                            <h3 class="display-4 text-primary">{{ $score }}/{{ $total_questions }}</h3>
                            <p class="text-muted">
                                Você acertou <strong>{{ $percentage }}%</strong> das perguntas
                            </p>
                        </div>

                        {{-- Performance Message --}}
                        @php
                            $alertClass = $percentage >= 70 ? 'success' : ($percentage >= 50 ? 'warning' : 'info');
                        @endphp
                        <div class="alert alert-{{ $alertClass }}" role="alert">
                            {{ $message }}
                        </div>

                        {{-- Score Breakdown --}}
                        <div class="mb-4">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <div class="h4 text-success mb-0">{{ $score }}</div>
                                        <small class="text-muted">Corretas</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="h4 text-danger mb-0">{{ $total_questions - $score }}</div>
                                    <small class="text-muted">Erradas</small>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('start_game') }}" class="btn btn-primary btn-lg">
                                🔄 Jogar Novamente
                            </a>
                        </div>

                    </div>
                </div>

                {{-- Share Results --}}
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Conseguiu {{ $percentage }}% no Quiz de Países e Capitais!
                        @if($percentage >= 80)
                            Impressionante! 🌟
                        @endif
                    </small>
                </div>

            </div>
        </div>
    </div>
</x-main-layout>
