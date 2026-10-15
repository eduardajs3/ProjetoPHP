# Fluxora

Sistema completo para nutricionistas e pacientes, com gerenciamento de agenda, pacientes, reuniões, prontuários, comunicação e videoconferência.

## Visão geral

A Fluxora é uma plataforma desenvolvida para auxiliar nutricionistas na gestão de atendimento clínico e operacional. O produto combina uma aplicação web moderna com uma API em PHP para oferecer recursos como:

- cadastro e autenticação de nutricionistas e pacientes;
- gerenciamento de pacientes e histórico médico;
- agenda e eventos de consulta;
- reuniões com participantes e agendamento de atendimentos;
- lembretes/notificações;
- upload de avatar e documentos;
- comunicação entre paciente e nutricionista;
- videoconferência integrada.

## Stack tecnológica

### Frontend
- React
- Vite
- Tailwind CSS
- React Router
- Axios
- Stream.io Video SDK
- Lucide React

### Backend
- PHP
- SQLite (configurável para MySQL/Oracle/PostgreSQL)
- JWT para autenticação
- PHPMailer para envio de e-mails
- AWS SDK e dotenv

## Estrutura do projeto

```text
.
├── front/                  # Aplicação web em React
│   ├── public/
│   ├── src/
│   ├── .env.example
│   ├── package.json
│   ├── vite.config.js
│   └── ...
├── server/                 # API em PHP
│   ├── src/
│   ├── composer.json
│   ├── .env.example
│   └── ...
├── Readme.md
└── ...
```

## Funcionalidades principais

### Para nutricionistas
- cadastro e login da conta profissional;
- criação e atualização de perfil;
- cadastro de pacientes;
- gestão de agenda e eventos;
- criação de reuniões e participação de pacientes;
- acompanhamento de prontuários e documentos;
- envio de notificações;
- acesso à videoconferência.

### Para pacientes
- cadastro e autenticação;
- confirmação de e-mail;
- visualização de agenda e compromissos;
- participação em reuniões;
- acompanhamento de registros do nutricionista;
- comunicação com a equipe.

## Pré-requisitos

Antes de iniciar, certifique-se de ter instalado:

- Node.js 18+
- npm
- PHP 8+
- Composer
- SQLite3 (para o banco local)

## Configuração do ambiente

### 1) Backend (PHP)

Acesse a pasta `server` e instale as dependências:

```bash
cd server
composer install
```

Crie o arquivo `.env` baseado no exemplo:

```bash
cp .env.example .env
```

Configure as variáveis conforme necessário, incluindo:

```env
JWT_SECRET_KEY=sua_chave_secreta
PROVIDER_PASSWORD=sua_senha_do_provedor
PROVIDER_HOST=seu_host
```

Crie ou inicialize o banco SQLite local:

```bash
sqlite3 src/dev.sqlite < src/Database/init.sql
```

### 2) Frontend (React)

Acesse a pasta `front` e instale as dependências:

```bash
cd front
npm install
```

Crie o arquivo `.env` baseado no exemplo:

```bash
cp .env.example .env
```

Exemplo de configuração:

```env
STREAM_KEY=sua_chave_stream
STREAM_SECRET=seu_secret_stream
```

## Como executar

### Backend

```bash
cd server
php -S localhost:8000 src/index.php
```

### Frontend

Em outro terminal:

```bash
cd front
npm run dev
```

A aplicação normalmente ficará disponível em:

- Frontend: http://localhost:5173
- API: http://localhost:8000

## Banco de dados

O projeto utiliza SQLite por padrão, com configuração localizada em `server/src/Database/ConfigConnection.php` e schema em `server/src/Database/init.sql`.

A estrutura inicial inclui tabelas para:

- nutricionistas;
- pacientes;
- eventos;
- reuniões;
- pacientes participantes;
- prontuários médicos;
- notificações;
- mensagens de chat.

## Fluxo de uso

1. Cadastre um nutricionista;
2. Faça login na plataforma;
3. Cadastre pacientes;
4. Crie eventos e reuniões;
5. Acompanhe prontuários e notificações;
6. Conduza atendimentos e videoconferências.

## Observações

- O arquivo `front/.env` e `server/.env` são locais de ambiente e não devem ser versionados sem necessidade.
- O projeto já contém uma base local em `server/src/dev.sqlite`, mas é recomendável validar o schema antes de usar em produção.
- Este README foi estruturado para facilitar onboarding do projeto e execução local.

## Licença

Este projeto está sob a licença MIT.
