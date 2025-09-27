# 🌍 Quiz de Países e Capitais

Um jogo interativo desenvolvido em Laravel para testar seus conhecimentos sobre países e suas respectivas capitais ao redor do mundo.

<br>
<br>
<img width="1278" height="867" alt="image" src="https://github.com/user-attachments/assets/5d87b902-2c6f-4b3b-889f-dd2413a3e7cc" />
<img width="1346" height="958" alt="image" src="https://github.com/user-attachments/assets/c0127f21-54e7-4a68-9f1d-aee0a54fda42" />
<img width="1279" height="961" alt="image" src="https://github.com/user-attachments/assets/30974584-afb8-4b00-825a-b5c12e66d484" />

<br>

## ✨ Características

- 🎯 **Quiz Personalizável**: Escolha de 3 a 30 perguntas
- 🌐 **Banco de Dados Extenso**: Mais de 190 países e capitais
- 📊 **Sistema de Pontuação**: Acompanhe seu desempenho em tempo real
- 🎨 **Interface Responsiva**: Design moderno com Bootstrap
- 🔄 **Opções Aleatórias**: Perguntas e alternativas embaralhadas a cada jogo
- 💾 **Sessões Seguras**: Controle de estado do jogo via sessões Laravel
- 🏆 **Feedback Personalizado**: Mensagens baseadas na performance

## 🛠️ Tecnologias Utilizadas

- **Laravel 11** - Framework PHP
- **PHP 8.2+** - Linguagem de programação
- **Bootstrap 5** - Framework CSS
- **Session Storage** - Gerenciamento de estado do jogo
- **Blade Templates** - Engine de templates

## 📋 Requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e npm (para assets)
- Servidor web (Apache/Nginx) ou Laravel Sail/Valet

## 🚀 Instalação

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/quiz-paises-capitais.git
   cd quiz-paises-capitais
   ```

2. **Instale as dependências**
   ```bash
   composer install
   npm install
   ```

3. **Configure o ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Compile os assets**
   ```bash
   npm run build
   ```

5. **Inicie o servidor**
   ```bash
   php artisan serve
   ```

6. **Acesse a aplicação**
   Abra seu navegador em `http://localhost:8000`

## 🎮 Como Jogar

1. **Página Inicial**: Escolha quantas perguntas deseja responder (3-30)
2. **Quiz**: Responda qual é a capital do país apresentado
3. **Progresso**: Acompanhe sua pontuação e progresso em tempo real
4. **Resultados**: Veja sua performance final com feedback personalizado
5. **Recomeçar**: Jogue novamente quantas vezes quiser!

## 📁 Estrutura do Projeto

```
├── app/
│   ├── Http/Controllers/
│   │   └── MainController.php      # Controlador principal do jogo
│   ├── View/Components/
│   │   └── MainLayout.php          # Componente de layout
│   └── appData.php                 # Dados dos países e capitais
├── resources/
│   ├── views/
│   │   ├── components/
│   │   │   ├── main-layout.blade.php
│   │   │   ├── logo.blade.php
│   │   │   └── footer.blade.php
│   │   ├── home.blade.php          # Página inicial
│   │   ├── quiz.blade.php          # Página do quiz
│   │   └── results.blade.php       # Página de resultados
│   └── css/
│       └── app.css                 # Estilos personalizados
└── routes/
    └── web.php                     # Rotas da aplicação
```

## 🎯 Funcionalidades Principais

### Sistema de Validação
- Validação do número de perguntas
- Verificação de sessão ativa
- Controle de navegação sequencial

### Geração Dinâmica de Perguntas
- Seleção aleatória de países
- Geração automática de 4 alternativas por pergunta
- Embaralhamento das opções de resposta

### Sistema de Pontuação
- Contagem de acertos em tempo real
- Cálculo de percentual de acertos
- Feedback baseado na performance:
  - 90%+: "Excelente! Você é um expert em geografia!"
  - 80-89%: "Muito bom! Você conhece bem os países e capitais!"
  - 70-79%: "Bom trabalho! Continue estudando!"
  - 60-69%: "Não está mal, mas há espaço para melhoria!"
  - 50-59%: "Resultado mediano. Que tal estudar um pouco mais?"
  - <50%: "Precisa estudar mais geografia. Não desista!"

### Controle de Sessão
- Prevenção contra navegação direta via URL
- Limpeza automática de sessões anteriores
- Proteção contra pulos de perguntas

## 🌍 Base de Dados

O quiz inclui dados de mais de 190 países com suas respectivas capitais, incluindo:

- Países de todos os continentes
- Nomes em português brasileiro
- Capitais oficiais atualizadas
- Casos especiais como países com múltiplas capitais

## 🎨 Interface do Usuário

- **Design Responsivo**: Funciona perfeitamente em desktop, tablet e mobile
- **Bootstrap 5**: Interface moderna e profissional
- **Animações Sutis**: Transições suaves para melhor experiência
- **Feedback Visual**: Indicadores de progresso e pontuação
- **Acessibilidade**: Estrutura semântica e navegação clara

## 🤝 Contribuições

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Possíveis Melhorias

- [ ] Sistema de ranking/leaderboard
- [ ] Categorias por continente
- [ ] Modo de dificuldade (bandeiras, línguas)
- [ ] Timer para respostas
- [ ] Sistema de hints
- [ ] Multiplayer
- [ ] API para dados externos
- [ ] Modo offline/PWA

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 👨‍💻 Autor

Seu Nome - [seu-email@exemplo.com](mailto:seu-email@exemplo.com)

Link do Projeto: [https://github.com/seu-usuario/quiz-paises-capitais](https://github.com/seu-usuario/quiz-paises-capitais)

---

⭐ Se este projeto foi útil para você, considere dar uma estrela no GitHub!

## 🎯 Capturas de Tela

### Página Inicial
*Interface limpa para configurar o número de perguntas*

### Durante o Quiz
*Pergunta com 4 alternativas e barra de progresso*

### Resultados
*Feedback detalhado com opção de jogar novamente*

---

**Divirta-se testando seus conhecimentos geográficos! 🌍🎓**
