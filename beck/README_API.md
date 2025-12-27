# Backend Prepom Navigator - Laravel API

## 🚀 Configuração Concluída

O backend foi criado com sucesso e está pronto para uso!

### ✅ Status da Instalação

- ✅ Laravel 11 instalado
- ✅ Banco de dados MySQL configurado e conectado
- ✅ Migrations executadas com sucesso
- ✅ Seeders executados (dados iniciais criados)
- ✅ Laravel Sanctum instalado para autenticação
- ✅ CORS configurado

### 🗄️ Banco de Dados

**Conexão:**
- Host: `192.168.176.30`
- Porta: `3306`
- Database: `db_prepom`
- Usuário: `carol`
- Senha: `secur1t1`

**Tabelas Criadas:**
1. `users` - Usuários (admin e alunos)
2. `questions` - Questões do simulado (40 questões)
3. `exam_attempts` - Histórico de tentativas de prova
4. `personal_access_tokens` - Tokens de autenticação (Sanctum)

### 👥 Usuários de Teste

**Administrador:**
- Login: `admin`
- Senha: `admin123`

**Alunos:**
- Login: `joao.silva` / Senha: `123456`
- Login: `maria.santos` / Senha: `123456`

### 📚 Questões

- **20 questões de Português**
- **20 questões de Matemática**
- Total: **40 questões** (necessário 31 acertos para aprovação)

## 🔌 Endpoints da API

### Autenticação

#### Login Admin
```
POST /api/auth/login/admin
Body: {
  "login": "admin",
  "password": "admin123"
}
Response: {
  "user": {...},
  "token": "..."
}
```

#### Login Aluno
```
POST /api/auth/login/student
Body: {
  "login": "joao.silva",
  "password": "123456"
}
Response: {
  "user": {...},
  "token": "..."
}
```

#### Logout
```
POST /api/auth/logout
Headers: Authorization: Bearer {token}
```

#### Verificar Usuário Autenticado
```
GET /api/auth/me
Headers: Authorization: Bearer {token}
```

### Gerenciamento de Alunos (Admin)

#### Listar Alunos
```
GET /api/students
Headers: Authorization: Bearer {token}
```

#### Criar Aluno
```
POST /api/students
Headers: Authorization: Bearer {token}
Body: {
  "name": "Nome do Aluno",
  "login": "login.aluno",
  "password": "senha123"
}
```

#### Ativar/Desativar Aluno
```
PATCH /api/students/{id}/toggle-status
Headers: Authorization: Bearer {token}
```

#### Deletar Aluno
```
DELETE /api/students/{id}
Headers: Authorization: Bearer {token}
```

### Questões

#### Listar Questões
```
GET /api/questions
Headers: Authorization: Bearer {token}
Response: [
  {
    "id": 1,
    "subject": "portugues",
    "text": "Qual é o sujeito...",
    "options": ["Opção A", "Opção B", "Opção C", "Opção D"]
  }
]
Nota: A resposta correta NÃO é retornada neste endpoint
```

#### Criar Questão (Admin)
```
POST /api/questions
Headers: Authorization: Bearer {token}
Body: {
  "subject": "portugues",
  "text": "Texto da questão",
  "options": ["A", "B", "C", "D"],
  "correct_answer": 0
}
```

#### Atualizar Questão
```
PUT /api/questions/{id}
Headers: Authorization: Bearer {token}
```

#### Deletar Questão
```
DELETE /api/questions/{id}
Headers: Authorization: Bearer {token}
```

### Prova

#### Submeter Prova
```
POST /api/exam/submit
Headers: Authorization: Bearer {token}
Body: {
  "answers": [0, 1, 2, 3, ...] // Array com 40 respostas (0-3 ou null)
}
Response: {
  "attempt": {...},
  "score": 35,
  "passed": true
}
```

#### Histórico de Tentativas
```
GET /api/exam/history
Headers: Authorization: Bearer {token}
```

#### Estatísticas Gerais
```
GET /api/exam/stats
Headers: Authorization: Bearer {token}
Response: {
  "total_attempts": 10,
  "passed_attempts": 7,
  "average_score": 33.5
}
```

## 🚀 Como Iniciar o Servidor

```bash
cd beck
php artisan serve
```

O servidor estará disponível em: `http://localhost:8000`

## 🔧 Comandos Úteis

### Limpar e recriar banco de dados
```bash
php artisan migrate:fresh --seed
```

### Ver status das migrations
```bash
php artisan migrate:status
```

### Criar novo usuário admin via Tinker
```bash
php artisan tinker
>>> \App\Models\User::create(['name' => 'Admin', 'login' => 'admin2', 'email' => 'admin2@prepom.local', 'password' => \Hash::make('senha'), 'role' => 'admin', 'active' => true]);
```

## 📁 Estrutura de Arquivos

```
beck/
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── AuthController.php
│   │   ├── StudentController.php
│   │   ├── QuestionController.php
│   │   └── ExamController.php
│   └── Models/
│       ├── User.php
│       ├── Question.php
│       └── ExamAttempt.php
├── database/
│   ├── migrations/
│   │   ├── 2025_12_24_185042_add_prepom_fields_to_users_table.php
│   │   ├── 2025_12_24_185053_create_questions_table.php
│   │   └── 2025_12_24_185106_create_exam_attempts_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
└── routes/
    └── api.php
```

## 🔐 Segurança

- Todas as senhas são hasheadas com bcrypt
- Autenticação via Laravel Sanctum (tokens)
- CORS configurado para aceitar requisições do frontend
- Validação de dados em todos os endpoints

## 📝 Notas Importantes

1. **Alunos inativos** não conseguem fazer login (retorna erro 403)
2. **Respostas corretas** das questões não são expostas no endpoint de listagem
3. **Aprovação** requer no mínimo 31 acertos de 40 questões
4. Todos os endpoints (exceto login) requerem **autenticação via token**

## 🎯 Próximos Passos

Para conectar o frontend React:

1. Configure a URL da API no frontend (provavelmente `http://localhost:8000/api`)
2. Use o token retornado no login para autenticar as requisições
3. Armazene o token no localStorage ou sessionStorage
4. Adicione o header `Authorization: Bearer {token}` em todas as requisições autenticadas

---

**Backend criado e configurado com sucesso! 🎉**
