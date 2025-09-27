{{-- resources/views/home.blade.php --}}
<x-main-layout pageTitle="Início">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="text-center mb-4">
                    <p class="text-muted">Teste os seus conhecimentos de geografia mundial!</p>
                </div>

                {{-- Exibir erros de validação --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulário de início --}}
                <form action="{{ route('prepare_game') }}" method="POST">
                    @csrf
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="total_questions" class="form-label">Quantas perguntas você quer responder?</label>
                                <input
                                    type="number"
                                    class="form-control form-control-lg text-center @error('total_questions') is-invalid @enderror"
                                    name="total_questions"
                                    id="total_questions"
                                    value="{{ old('total_questions', 10) }}"
                                    min="3"
                                    max="30"
                                    placeholder="10"
                                >
                                <div class="form-text">Escolha entre 3 e 30 perguntas</div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg">
                                    🚀 Começar Quiz
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <small class="text-muted">
                        Teste seu conhecimento sobre as capitais de países do mundo inteiro!
                    </small>
                </div>

            </div>
        </div>
    </div>
</x-main-layout>
