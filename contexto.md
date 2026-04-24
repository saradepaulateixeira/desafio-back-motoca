# Contexto do Projeto - API Concessionária

## Objetivo do Projeto

Desenvolver uma **API REST para uma concessionária de veículos** com as seguintes funcionalidades:
- Gerenciar veículos disponíveis (CRUD)
- Gerenciar leads de clientes interessados
- Fornecer métricas via dashboard
- Autenticação com Laravel Sanctum

## Stack Tecnológica

- **PHP 8.4** (Laravel 13.x)
- **PostgreSQL** 16
- **Docker** + Docker Compose
- **Nginx**
- **Laravel Sanctum** (autenticação)

## Estrutura do Banco de Dados

### Tabela: vehicles
| Campo | Tipo | Descrição |
|-------|------|----------|
| id | bigint | PK |
| type | enum(car, motorcycle) | Tipo do veículo |
| brand | varchar(50) | Marca (default: Honda) |
| model | varchar(100) | Modelo (obrigatório) |
| year | integer | Ano (>= 2000) |
| price | decimal(12,2) | Preço (> 0) |
| color | varchar(30) | Cor |
| mileage | integer | Quilometragem |
| timestamps | timestamps | created_at, updated_at |

### Tabela: leads
| Campo | Tipo | Descrição |
|-------|------|----------|
| id | bigint | PK |
| name | varchar(100) | Nome do cliente |
| email | varchar(150) | Email (válido) |
| phone | varchar(20) | Telefone |
| vehicle_id | bigint | FK para vehicles |
| message | text | Mensagem opcional |
| timestamps | timestamps | created_at, updated_at |

### Relacionamento
- Vehicle hasMany Leads
- Lead belongsTo Vehicle

## Funcionalidades Implementadas

### Autenticação
- POST `/api/auth/login` - Login
- POST `/api/auth/logout` - Logout (auth)
- GET `/api/auth/me` - Dados do usuário (auth)

### Veículos
- GET `/api/vehicles` - Listar (público, paginado)
- GET `/api/vehicles?type=car|motorcycle` - Filtrar por tipo
- GET `/api/vehicles?max_price=80000` - Filtrar por preço máx
- GET `/api/vehicles/{id}` - Ver veículo específico
- POST `/api/vehicles` - Criar (auth)
- PUT `/api/vehicles/{id}` - Atualizar (auth)
- DELETE `/api/vehicles/{id}` - Deletar (auth)

### Leads
- POST `/api/leads` - Criar lead (público)
- GET `/api/leads` - Listar leads (auth)
- GET `/api/vehicles/{id}/leads` - Leads por veículo

### Dashboard
- GET `/api/dashboard` - Métricas (auth)
  - total_vehicles
  - total_leads
  - avg_price
  - most_requested_vehicle
  - leads_by_type
  - insights

## Estrutura de Arquivos

```
/home/sara/teste-backend-motoca/
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
│   │   ├── 2026_04_23_201600_create_vehicles_table.php
│   │   └── 2026_04_23_201601_create_leads_table.php
│   └── seeders/
│       ├── VehicleSeeder.php (20 veículos)
│       ├── LeadSeeder.php (50 leads)
│       └── DatabaseSeeder.php
├── docker/
│   ├── Dockerfile
│   ├── nginx/default.conf
│   └── postgres/
│       ├── postgresql.conf
���       └── pg_hba.conf
├── routes/
│   └── api.php
├── tests/Feature/
│   ├── AuthTest.php
│   ├── VehicleTest.php
│   ├── LeadTest.php
│   └── DashboardTest.php
├── docker-compose.yml
├── .env
├── .env.example
├── .env.testing
├── postman_collection.json
└── README.md
```

## Credenciais

- **Email:** admin@concessionaria.com
- **Senha:** password

## Comandos Úteis

```bash
# Subir containers
docker compose up -d --build

# Rodar migrations
docker compose exec app php artisan migrate

# Rodar seeders
docker compose exec app php artisan db:seed

# Executar testes
docker compose exec app php artisan test

# Acessar container
docker compose exec app sh
docker compose exec postgres psql -U concessionaria -d concessionaria

# Ver logs
docker compose logs -f app
```

## Testes com curl

```bash
# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@concessionaria.com","password":"password"}'

# Listar veículos
curl http://localhost:8000/api/vehicles

# Filtrar por tipo
curl "http://localhost:8000/api/vehicles?type=car"

# Filtrar por preço
curl "http://localhost:8000/api/vehicles?max_price=50000"

# Criar veículo (auth)
curl -X POST http://localhost:8000/api/vehicles \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TOKEN" \
  -d '{"type":"car","model":"Civic","year":2024,"price":89900}'

# Criar lead (público)
curl -X POST http://localhost:8000/api/leads \
  -H "Content-Type: application/json" \
  -d '{"name":"João","email":"joao@teste.com","phone":"11999999999","vehicle_id":1}'

# Dashboard
curl http://localhost:8000/api/dashboard \
  -H "Authorization: Bearer TOKEN"
```

## Conexão com Banco de Dados

```
Host: localhost
Porta: 5432
Database: concessionaria
Usuário: concessionaria
Senha: secret
```

## Decisões Técnicas

1. **Dockerfile:** PHP-FPM 8.4 com extensões pgsql, gd, zip
2. **Cache:** Implementado com Cache::remember no Dashboard
3. **Pagination:** 15 itens por página
4. **Validações:** Form Requests com regras completas
5. **Service Layer:** Lógica de negócio isolada dos controllers

---

**Status:** Projeto completo e funcionando
**Data:** 24/04/2026