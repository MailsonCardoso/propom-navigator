# 📦 Versões dos Componentes - Backend Propom Navigator

## 🔧 Ambiente de Desenvolvimento

### Sistema Operacional
- **OS:** Windows

### PHP
- **Versão:** PHP 8.2.12 (CLI)
- **Zend Engine:** v4.2.12
- **Build:** October 2023

---

## 🚀 Framework e Dependências Principais

### Laravel Framework
- **Versão:** 12.44.0 (Laravel 12)
- **Tipo:** Framework PHP moderno
- **Requisito PHP:** ^8.2

### Pacotes Laravel Instalados

#### Produção (`require`)
```json
{
  "php": "^8.2",
  "laravel/framework": "^12.0",
  "laravel/sanctum": "^4.2",
  "laravel/tinker": "^2.10.1"
}
```

**Descrição dos pacotes:**
- **laravel/framework** (^12.0) - Framework principal
- **laravel/sanctum** (^4.2) - Autenticação via tokens API
- **laravel/tinker** (^2.10.1) - REPL interativo para Laravel

#### Desenvolvimento (`require-dev`)
```json
{
  "fakerphp/faker": "^1.23",
  "laravel/pail": "^1.2.2",
  "laravel/pint": "^1.24",
  "laravel/sail": "^1.41",
  "mockery/mockery": "^1.6",
  "nunomaduro/collision": "^8.6",
  "phpunit/phpunit": "^11.5.3"
}
```

**Descrição dos pacotes de desenvolvimento:**
- **fakerphp/faker** (^1.23) - Geração de dados fake para testes
- **laravel/pail** (^1.2.2) - Visualização de logs em tempo real
- **laravel/pint** (^1.24) - Code style fixer
- **laravel/sail** (^1.41) - Ambiente Docker para Laravel
- **mockery/mockery** (^1.6) - Framework de mocking para testes
- **nunomaduro/collision** (^8.6) - Error handler elegante
- **phpunit/phpunit** (^11.5.3) - Framework de testes unitários

---

## 🗄️ Banco de Dados

### MySQL
- **Host:** 192.168.176.30
- **Porta:** 3306
- **Database:** db_prepom
- **Charset:** utf8mb4
- **Collation:** utf8mb4_unicode_ci

---

## 📚 Bibliotecas e Extensões PHP Utilizadas

### Extensões PHP Necessárias (padrão Laravel 12)
- ✅ Ctype
- ✅ cURL
- ✅ DOM
- ✅ Fileinfo
- ✅ Filter
- ✅ Hash
- ✅ Mbstring
- ✅ OpenSSL
- ✅ PCRE
- ✅ PDO
- ✅ Session
- ✅ Tokenizer
- ✅ XML

---

## 🔐 Segurança e Autenticação

### Laravel Sanctum
- **Versão:** 4.2
- **Tipo:** Token-based authentication
- **Uso:** API authentication para SPA e mobile apps
- **Tabela:** personal_access_tokens

---

## 📊 Estrutura do Projeto

### Arquitetura
- **Padrão:** MVC (Model-View-Controller)
- **API:** RESTful
- **Autenticação:** Token-based (Sanctum)
- **ORM:** Eloquent

### Models Criados
1. **User** - Usuários (admin e students)
2. **Question** - Questões do simulado
3. **ExamAttempt** - Tentativas de prova

### Controllers API
1. **AuthController** - Autenticação
2. **StudentController** - Gerenciamento de alunos
3. **QuestionController** - Gerenciamento de questões
4. **ExamController** - Submissão e histórico de provas

### Migrations
1. `add_propom_fields_to_users_table` - Campos customizados
2. `create_questions_table` - Tabela de questões
3. `create_exam_attempts_table` - Tabela de tentativas

---

## 🎯 Compatibilidade

### Requisitos Mínimos
- **PHP:** >= 8.2
- **MySQL:** >= 5.7 ou MariaDB >= 10.3
- **Composer:** >= 2.0
- **Extensões PHP:** Listadas acima

### Testado em
- ✅ Windows 10/11
- ✅ PHP 8.2.12
- ✅ MySQL 8.0+
- ✅ Laravel 12.44.0

---

## 📝 Configurações Importantes

### Timezone
- **APP_TIMEZONE:** UTC (padrão Laravel)
- **DB_TIMEZONE:** UTC

### Locale
- **APP_LOCALE:** pt_BR (configurável)
- **APP_FALLBACK_LOCALE:** en

### Debug
- **APP_DEBUG:** true (desenvolvimento)
- **APP_ENV:** local

---

## 🔄 Versionamento

### Controle de Versão
- **Git:** Configurado (.gitignore presente)
- **Branches:** Não especificado

### Composer Lock
- ✅ `composer.lock` presente
- ✅ Garante versões consistentes das dependências

---

## 📦 Instalação e Atualização

### Instalar Dependências
```bash
composer install
```

### Atualizar Dependências
```bash
composer update
```

### Verificar Versões
```bash
php artisan --version
php -v
composer --version
```

---

## 🚀 Performance

### Otimizações Habilitadas
- ✅ **optimize-autoloader:** true
- ✅ **preferred-install:** dist
- ✅ **sort-packages:** true

### Cache (disponível)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📅 Data de Criação
- **Projeto Criado:** 24/12/2024
- **Última Atualização:** 25/12/2024

---

## 🎉 Status
✅ **Todas as dependências instaladas e funcionando**  
✅ **Banco de dados configurado e populado**  
✅ **API totalmente funcional**  
✅ **Servidor rodando em http://localhost:8000**

---

**Versão do Backend:** 1.0.0  
**Status:** Produção Ready 🚀
