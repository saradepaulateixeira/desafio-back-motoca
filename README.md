# 🚗 Concessionaria API

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/PostgreSQL-16-336791?style=for-the-badge&logo=postgresql">
  <img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker">
  <img src="https://img.shields.io/badge/Nginx-269199?style=for-the-badge&logo=nginx">
</p>

> API REST completa para gerenciamento de veículos e leads de uma concessionária, com autenticação, dashboard e métricas.

## 📸 Preview

<a href="docs/demo.gif">
  <img src="docs/demo.gif" alt="API Demo" width="100%">
</a>

Demonstração dos endpoints principais: listagem de veículos, filtro por tipo, criação de lead e dashboard com métricas.

---

## 🛠️ Tecnologias

| Tecnologia | Descrição |
|------------|-----------|
| **PHP 8.4** | Linguagem de programação |
| **Laravel 13.x** | Framework PHP |
| **PostgreSQL 16** | Banco de dados |
| **Docker** | Containerização |
| **Nginx** | Servidor web |
| **Laravel Sanctum** | Autenticação API |

---

## 🏗️ Arquitetura

```
┌─────────────────────────────────────────────────────────────┐
│                      CAMADA DE ENTRADA                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐          │
│  │   Requests  │  │ Validation │  │   Middle   │          │
│  └─────────────┘  └─────────────┘  └─────────────┘          │
├─────────────────────────────────────────────────────────────┤
│                      CAMADA DE LÓGICA                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐          │
│  │  Services  │  │   Models   │  │  Database  │          │
│  └─────────────┘  └─────────────┘  └─────────────┘          │
├─────────────────────────────────────────────────────────────┤
│                      CAMADA DE SAÍDA                        │
│  ┌─────────────┐  ┌─────────────┐                          │
│  │  Resources  │  │    JSON     │                          │
│  └─────────────┘  └─────────────┘                          │
└─────────────────────────────────────────────────────────────┘
```

### Estrutura de Pastas

```
concessionaria/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   ├── AuthController.php
│   │   │   ├── VehicleController.php
│   │   │   ├── LeadController.php
│   │   │   └── DashboardController.php
│   │   ├── Requests/
│   │   │   ├── StoreVehicleRequest.php
│   │   │   ├── UpdateVehicleRequest.php
│   │   │   └── StoreLeadRequest.php
│   │   └── Resources/
│   │       ├── VehicleResource.php
│   │       ├── LeadResource.php
│   │       └── DashboardResource.php
│   ├── Models/
│   │   ├── Vehicle.php
│   │   ├── Lead.php
│   │   └── User.php
│   └── Services/
│       ├── VehicleService.php
│       ├── LeadService.php
│       └── DashboardService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── docker/
│   ├── Dockerfile
│   ├── nginx/default.conf
│   └── postgres/
├── routes/
│   └── api.php
├── tests/Feature/
│   ├── AuthTest.php
│   ├── VehicleTest.php
│   ├── LeadTest.php
│   └── DashboardTest.php
├── docker-compose.yml
├── .env
└── README.md
```

---

## 🚀 Guia de Instalação

### 1. Clone o projeto

```bash
git clone https://github.com/seu-usuario/concessionaria.git
cd concessionaria
```

### 2. Configure o ambiente

```bash
cp .env.example .env
```

### 3. Suba os containers

```bash
docker compose up -d --build
```

### 4. Execute as migrações

```bash
docker compose exec app php artisan migrate
```

### 5. Popule o banco (opcional)

```bash
docker compose exec app php artisan db:seed
```

### 6. Acesse a aplicação

```
http://localhost:8000
```

### Credenciais Padrão

| Campo | Valor |
|-------|-------|
| Email | admin@concessionaria.com |
| Senha | password |

---

## 📡 Endpoints

### 🔐 Autenticação

| Método | Endpoint | Descrição | Auth |
|--------|----------|-----------|----------|------|
| POST | `/api/auth/login` | Login de usuário | Não |
| POST | `/api/auth/logout` | Logout | Sim |
| GET | `/api/auth/me` | Dados do usuário | Sim |

### 🚗 Veículos

| Método | Endpoint | Descrição | Auth |
|--------|----------|-----------|----------|------|
| GET | `/api/vehicles` | Listar veículos | Não |
| GET | `/api/vehicles?type=car` | Filtrar por tipo | Não |
| GET | `/api/vehicles?max_price=80000` | Filtrar por preço | Não |
| GET | `/api/vehicles/{id}` | Ver veículo | Não |
| POST | `/api/vehicles` | Criar veículo | Sim |
| PUT | `/api/vehicles/{id}` | Atualizar veículo | Sim |
| DELETE | `/api/vehicles/{id}` | Excluir veículo | Sim |

### 👥 Leads

| Método | Endpoint | Descrição | Auth |
|--------|----------|-----------|----------|------|
| POST | `/api/leads` | Criar lead | Não |
| GET | `/api/leads` | Listar leads | Sim |
| GET | `/api/vehicles/{id}/leads` | Leads por veículo | Sim |

### 📊 Dashboard

| Método | Endpoint | Descrição | Auth |
|--------|----------|-----------|----------|------|
| GET | `/api/dashboard` | Métricas gerais | Sim |

---

## 📝 Exemplos de Requisições

### Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@concessionaria.com", "password": "password"}'
```

**Resposta:**
```json
{
  "message": "Login realizado com sucesso",
  "token": "1|xxxxxxxxxx",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@concessionaria.com"
  }
}
```

### Listar Veículos

```bash
curl http://localhost:8000/api/vehicles
```

### Filtrar Veículos

```bash
# Por tipo
curl "http://localhost:8000/api/vehicles?type=car"

# Por preço máximo
curl "http://localhost:8000/api/vehicles?max_price=50000"
```

### Criar Lead

```bash
curl -X POST http://localhost:8000/api/leads \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João Silva",
    "email": "joao@example.com",
    "phone": "(11) 99999-9999",
    "vehicle_id": 1,
    "message": "Tenho interesse neste veículo"
  }'
```

### Dashboard

```bash
curl http://localhost:8000/api/dashboard \
  -H "Authorization: Bearer SEU_TOKEN"
```

**Resposta:**
```json
{
  "summary": {
    "total_vehicles": 20,
    "total_leads": 50,
    "avg_price": 45200.50
  },
  "most_requested_vehicle": {
    "id": 3,
    "model": "Honda Civic",
    "leads_count": 12
  },
  "leads_by_type": {
    "car": 35,
    "motorcycle": 15
  },
  "insights": [
    "Carros recebem mais leads que motos"
  ]
}
```

---

## 🧪 Testes

Execute os testes automatizados:

```bash
docker compose exec app php artisan test
```

**Resultado esperado:**
```
Tests: 17 passed (27 assertions)
```

### Cobertura

- ✅ Login e autenticação
- ✅ CRUD de veículos
- ✅ Filtros (type, max_price)
- ✅ Création de leads
- ✅ Dashboard com métricas
- ✅ Validações

---

## 📬 Postman Collection

Importe o arquivo `postman_collection.json` no Postman para testar todos os endpoints.

```
Collection → Import → Select File → postman_collection.json
```

---

## ✨ Diferenciais

| Diferencial | Descrição |
|-------------|-----------|
| **Service Layer** | Lógica de negócio isolada dos controllers |
| **Cache** | Dashboard com cache de 60 segundos |
| **Eager Loading** | Otimização de consultas com with() e withCount() |
| **Form Requests** | Validações robustas e tipadas |
| **API Resources** | Padronização de respostas JSON |
| **Docker** | Ambiente completo e reproduzível |
| **Testes** | Cobertura de funcionalidades principais |
| **Clean Code** | Código organizado e legível |

---

## 📄 Banco de Dados

### Tabela: vehicles

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | PK |
| type | enum | car, motorcycle |
| brand | varchar(50) | Marca |
| model | varchar(100) | Modelo |
| year | integer | Ano |
| price | decimal | Preço |
| color | varchar(30) | Cor |
| mileage | integer | Quilometragem |

### Tabela: leads

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | PK |
| name | varchar(100) | Nome |
| email | varchar(150) | Email |
| phone | varchar(20) | Telefone |
| vehicle_id | bigint | FK |
| message | text | Mensagem |

---

## 📚 Documentação Complementar

Consulte a documentação oficial das tecnologias utilizadas:
- Laravel Framework
- Laravel Sanctum
- Docker Compose

---

## 👨‍💻 Autor

**Seu Nome**
- Email: seu.email@exemplo.com
- GitHub: github.com/seu-usuario
- LinkedIn: linkedin.com/in/seu-perfil

---

<p align="center">
 Feito com ❤️ usando Laravel
</p>