# 🚀 Projeto Rodando Localmente

## ✅ Status dos Servidores

### 🔧 Backend (Laravel API)
- **Status:** ✅ RODANDO
- **URL:** http://localhost:8000
- **API:** http://localhost:8000/api
- **Porta:** 8000
- **Tempo ativo:** 26h+

**Como parar:**
```bash
# Pressione Ctrl+C no terminal do backend
```

**Como reiniciar:**
```bash
cd beck
php artisan serve --host=0.0.0.0 --port=8000
```

---

### ⚛️ Frontend (React + Vite)
- **Status:** ✅ RODANDO
- **URL Local:** http://localhost:8080
- **URL Rede:** http://192.168.176.30:8080
- **Porta:** 8080

**Como parar:**
```bash
# Pressione Ctrl+C no terminal do frontend
```

**Como reiniciar:**
```bash
cd propom-navigator
npm run dev
```

---

## 🌐 Como Acessar

### 1. Abra o Navegador

Digite uma das URLs:
- **Local:** http://localhost:8080
- **Rede:** http://192.168.176.30:8080

### 2. Faça Login

#### Como Administrador:
- **Login:** `admin`
- **Senha:** `admin@2026`

#### Como Aluno:
- **Login:** `aluno.teste`
- **Senha:** `aluno@2026`

---

## 📋 Funcionalidades Disponíveis

### 👨‍💼 Área do Administrador
Após login como admin, você pode:
- ✅ Gerenciar alunos (criar, editar, ativar/desativar)
- ✅ Visualizar dashboard com estatísticas
- ✅ Ver lista de todos os alunos
- ✅ Controlar acesso dos alunos

### 👤 Área do Aluno
Após login como aluno, você pode:
- ✅ Fazer simulados (40 questões)
- ✅ Ver histórico de tentativas
- ✅ Ver resultados (aprovado/reprovado)
- ✅ Tempo de 90 minutos por prova

---

## 🔌 Endpoints da API Disponíveis

### Autenticação
```
POST http://localhost:8000/api/auth/login/admin
POST http://localhost:8000/api/auth/login/student
POST http://localhost:8000/api/auth/logout
GET  http://localhost:8000/api/auth/me
```

### Alunos (Admin)
```
GET    http://localhost:8000/api/students
POST   http://localhost:8000/api/students
PATCH  http://localhost:8000/api/students/{id}/toggle-status
DELETE http://localhost:8000/api/students/{id}
```

### Questões
```
GET    http://localhost:8000/api/questions
POST   http://localhost:8000/api/questions
PUT    http://localhost:8000/api/questions/{id}
DELETE http://localhost:8000/api/questions/{id}
```

### Prova
```
POST http://localhost:8000/api/exam/submit
GET  http://localhost:8000/api/exam/history
GET  http://localhost:8000/api/exam/stats
```

---

## 🧪 Testar a API

### Via Browser (GET)
Abra no navegador:
```
http://localhost:8000/api/questions
```

### Via PowerShell (POST - Login)
```powershell
$body = @{
    login = "admin"
    password = "admin@2026"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/auth/login/admin" -Method POST -Body $body -ContentType "application/json"
```

### Via Postman/Insomnia
1. Crie requisição POST
2. URL: `http://localhost:8000/api/auth/login/admin`
3. Headers:
   - `Content-Type: application/json`
   - `Accept: application/json`
4. Body (raw JSON):
```json
{
  "login": "admin",
  "password": "admin@2026"
}
```

---

## 📁 Estrutura do Projeto

```
propom-navigator/
├── Frontend (React + Vite)
│   ├── URL: http://localhost:8080
│   ├── src/
│   │   ├── pages/
│   │   │   ├── AdminDashboard.tsx
│   │   │   ├── AdminStudents.tsx
│   │   │   ├── ExamPage.tsx
│   │   │   └── ...
│   │   └── components/
│   └── package.json
│
└── beck/ (Backend Laravel)
    ├── URL: http://localhost:8000
    ├── app/
    │   ├── Http/Controllers/Api/
    │   └── Models/
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    └── routes/api.php
```

---

## 🔧 Comandos Úteis

### Ver Logs do Backend
```bash
cd beck
tail -f storage/logs/laravel.log
```

### Limpar Cache do Backend
```bash
cd beck
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Reinstalar Dependências do Frontend
```bash
npm install
```

### Build de Produção do Frontend
```bash
npm run build
```

---

## 🐛 Troubleshooting

### Frontend não carrega
1. Verifique se o servidor está rodando: `npm run dev`
2. Limpe o cache do navegador (Ctrl + Shift + Delete)
3. Tente outra porta: edite `vite.config.ts`

### Backend não responde
1. Verifique se o servidor está rodando: `php artisan serve`
2. Verifique a conexão com o banco de dados
3. Veja os logs: `beck/storage/logs/laravel.log`

### Erro de CORS
1. Verifique `beck/config/cors.php`
2. Certifique-se que `allowed_origins` está correto
3. Reinicie o servidor backend

### Login não funciona
1. Verifique as credenciais
2. Veja os logs: `beck/storage/logs/laravel.log`
3. Execute: `cd beck && php verify_users.php`

---

## 📊 Monitoramento

### Ver Requisições em Tempo Real
Terminal 1 (Backend):
```bash
cd beck
php artisan serve --host=0.0.0.0 --port=8000
```

Terminal 2 (Logs):
```bash
cd beck
tail -f storage/logs/laravel.log
```

Terminal 3 (Frontend):
```bash
npm run dev
```

---

## 🎯 Próximos Passos

1. **Acesse:** http://localhost:8080
2. **Faça login** com as credenciais fornecidas
3. **Explore** as funcionalidades
4. **Teste** a criação de alunos (como admin)
5. **Faça** um simulado (como aluno)

---

## 📝 Notas Importantes

- ✅ Backend rodando há 26h+ sem problemas
- ✅ Frontend iniciado com sucesso
- ✅ Banco de dados conectado e populado
- ✅ 40 questões disponíveis para simulado
- ✅ Sistema de autenticação seguro
- ✅ Logs de auditoria ativos

---

**🎉 Projeto 100% funcional e pronto para uso!**

**URLs de Acesso:**
- Frontend: http://localhost:8080
- Backend API: http://localhost:8000/api
- Documentação API: Veja `beck/README_API.md`

**Credenciais:**
- Admin: `admin` / `admin@2026`
- Aluno: `aluno.teste` / `aluno@2026`
