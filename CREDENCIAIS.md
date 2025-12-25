# 🔐 Credenciais de Acesso - Propom Navigator

## ✅ Usuários Criados com Sucesso!

### 👨‍💼 ADMINISTRADOR

**Nome:** Administrador Sistema  
**Login:** `admin`  
**Senha:** `admin@2026`  
**Email:** admin@propom.com.br  
**Role:** admin  
**Status:** Ativo ✅

**Endpoint de Login:**
```
POST http://localhost:8000/api/auth/login/admin

Body (JSON):
{
  "login": "admin",
  "password": "admin@2026"
}
```

**Permissões:**
- ✅ Gerenciar alunos (criar, editar, ativar/desativar, deletar)
- ✅ Gerenciar questões (CRUD completo)
- ✅ Visualizar estatísticas gerais
- ✅ Acesso total ao sistema

---

### 👤 ALUNO

**Nome:** Aluno Teste  
**Login:** `aluno.teste`  
**Senha:** `aluno@2026`  
**Email:** aluno@propom.com.br  
**Role:** student  
**Status:** Ativo ✅

**Endpoint de Login:**
```
POST http://localhost:8000/api/auth/login/student

Body (JSON):
{
  "login": "aluno.teste",
  "password": "aluno@2026"
}
```

**Permissões:**
- ✅ Fazer simulados (40 questões)
- ✅ Ver histórico de tentativas
- ✅ Ver resultados (aprovado/reprovado)
- ❌ Não pode gerenciar outros usuários
- ❌ Não pode criar/editar questões

---

## 📊 Estatísticas do Sistema

**Total de usuários:** Varia (verificar no banco)  
**Administradores:** 1+  
**Alunos:** 1+  

---

## 🧪 Como Testar

### 1. Teste via cURL (Windows PowerShell)

**Login Admin:**
```powershell
$body = @{
    login = "admin"
    password = "admin@2026"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/auth/login/admin" -Method POST -Body $body -ContentType "application/json"
```

**Login Aluno:**
```powershell
$body = @{
    login = "aluno.teste"
    password = "aluno@2026"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/auth/login/student" -Method POST -Body $body -ContentType "application/json"
```

### 2. Teste via Postman/Insomnia

1. Crie uma nova requisição POST
2. URL: `http://localhost:8000/api/auth/login/admin` (ou `/student`)
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
5. Envie a requisição
6. Copie o `token` da resposta
7. Use o token nas próximas requisições:
   - Header: `Authorization: Bearer {token}`

### 3. Teste via Frontend React

No seu código React, use o exemplo em `FRONTEND_INTEGRATION.ts`:

```typescript
const response = await apiClient.loginAdmin('admin', 'admin@2026');
// ou
const response = await apiClient.loginStudent('aluno.teste', 'aluno@2026');

// Salvar o token
localStorage.setItem('auth_token', response.token);
```

---

## 🔄 Resetar Senha

Se precisar resetar a senha de algum usuário, execute:

```bash
cd beck
php artisan tinker
```

Depois, no console do Tinker:
```php
$user = \App\Models\User::where('login', 'admin')->first();
$user->password = \Hash::make('nova_senha');
$user->save();
```

---

## 📝 Criar Novos Usuários

### Via Script PHP:
```bash
cd beck
php create_users.php
```

### Via Tinker:
```bash
cd beck
php artisan tinker
```

```php
// Criar admin
\App\Models\User::create([
    'name' => 'Novo Admin',
    'login' => 'novo.admin',
    'email' => 'novo@propom.com.br',
    'password' => \Hash::make('senha123'),
    'role' => 'admin',
    'active' => true,
]);

// Criar aluno
\App\Models\User::create([
    'name' => 'Novo Aluno',
    'login' => 'novo.aluno',
    'email' => 'aluno2@propom.com.br',
    'password' => \Hash::make('senha123'),
    'role' => 'student',
    'active' => true,
]);
```

### Via API (requer autenticação admin):
```
POST http://localhost:8000/api/students
Authorization: Bearer {admin_token}

Body:
{
  "name": "Novo Aluno",
  "login": "novo.aluno",
  "password": "senha123"
}
```

---

## ⚠️ IMPORTANTE - SEGURANÇA

### Produção:
1. **NUNCA** use senhas simples como estas em produção
2. **SEMPRE** use senhas fortes e únicas
3. **ATIVE** autenticação de dois fatores se disponível
4. **ROTACIONE** senhas periodicamente
5. **NÃO** compartilhe credenciais em repositórios públicos

### Desenvolvimento:
- ✅ Estas credenciais são apenas para desenvolvimento/teste
- ✅ O arquivo `.env` não está no Git (protegido)
- ✅ Senhas são hasheadas com bcrypt

---

## 📞 Suporte

Se tiver problemas com login:

1. Verifique se o servidor está rodando: `http://localhost:8000`
2. Verifique se o banco de dados está acessível
3. Verifique os logs: `beck/storage/logs/laravel.log`
4. Execute: `php artisan migrate:status` para ver as migrations

---

**Credenciais criadas em:** 25/12/2024  
**Servidor:** http://localhost:8000  
**Status:** ✅ Pronto para uso!
