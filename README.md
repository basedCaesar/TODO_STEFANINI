# TODO Stefanini

Uma interface simples usando **Vue.js**, e uma API REST em **Laravel**, que justas formam uma bela aplicação de Lista de Tarefas. 

## Índice:

1. **[Introdução](#introdução)**
2. **[Tech Stack](#Tech-Stack)**
3. **[Instalação](#instalação)**
4. **[Documentação da API](#documentação-da-api)**

## Introdução:

TODO Stefanini é um simple sistema de gerenciamento de tarefas, que permite o usuário criar, alterar e editar
tarefas. Além disso, a aplicação contém também a função de Dark Mode e a função de gerar um pdf com suas tarefas.
Tech Stack

## Tech Stack:
Ferramentas e versões usadas no projeto:

### Front-end

- Vue.js
- Tailwind CSS
- Mitt
- PdfMake
- Axios
### Back-end

- PHP 8.3
- Laravel 11.0.7
- MySql 8.0
- Composer 2.6.5

### Utilitários

- Editor De Texto:  **[Visual Studio Code](https://code.visualstudio.com/)**
- Banco De Daddos: MySqlWorkBench
- API Client : **[Insonia](https://insomnia.rest/)**
  
## Instalação:

### Pré-requisitos

- Node.js
- NPM
- PHP 8.3
- MySQL 8.0
- Composer 2.6.5

### Clonando o Repositório

```bash

# Clone este repositório
$ git clone https://github.com/basedCaesar/TODO_STEFANINI

# Navegue até a pasta 
$ cd TODO_STEFANINI
```
### Front-end(Vue)

```bash

# Navegue até a pasta que contém o front-end
$ cd front-end
$ cd front-end-todo

# Instale as dependências
$ npm install

# Execute a aplicação
$ npm run dev

#clique no link do servidor que foi gerado

```

### Backend (Laravel + MySql)
```bash

# Navegue até a pasta que contém o back-end
$ cd back-end

# Instale as dependências
$ composer install

# Mude o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente.
# Crie uma base de dados chamado todo

# Gere uma chave de aplicativo.
$ php artisan key:generate

# Execute as migrations
$ php artisan migrate

# Execute a aplicação em modo de desenvolvimento
$ php artisan serve

#click no link do servidor que foi gerado
```

## Documentação da API:

### End points da API

| Método    | URL                 | Descrição                  |
| ---------- | ------------------- | ---------------------------- |
| `GET`    | api/v1/tarefas           | Lista todas as  tarefas   |
| `POST`   | api/v1/tarefas            | Cria uma nova tarefa        |
| `PUT`    | api/v1/tarefas/{id}  | Altera uma tarefa específica |
| `GET`    | api/v1/tarefas/{id} | Lista uma tarefa específica |
| `DELETE` | api/v1/tarefas/{id}        | Deleta uma tarefa específica         |

### GET Lista de Tarefas

- **URL:** `api/v1/tarefas`
- **Método:** GET
- **Descrição:** Lista todas as  tarefas.
- **Parâmetros:**
- **Resposta:**
  ```json
  {
	"data": [
		{
			"id": ,
			"titulo": "",
			"descricao": "",
			"status": ""
		}
	]
}

### POST Nova Tarefa

- **URL:** `api/v1/tarefas`
- **Método:** POST
- **Descrição:** Cria uma nova tarefa.
- **Parâmetros:**
  - `titulo`: Título que será atribuido a nova tarefa. **[Required]**
  - `descricao`: Descrição que será atribuida a nova tarefa. **[Nullable]**
- **Resposta:**
  ```json
  {
			"Tarefa Criada"
  }
  ```

  ### PUT Altera Tarefa

- **URL:** `api/v1/tarefas/{id}`
- **Método:** PUT
- **Descrição:** Altera uma tarefa específica.
- **Parâmetros:**
  - `titulo`: Título que será atribuido a tarefa atualizada. **[Required]**
  - `descricao`: Descrição que será atribuida a tarefa atualizada. **[Nullable]**
  - `status`: Status que será atribuido a tarefa atualizada.**[Required]**
- **Resposta:**
  ```json
  {
			"Tarefa Alterada"
  }
  ```

  ### GET Tarefa Específica

- **URL:** `api/v1/tarefas/{id}`
- **Método:** GET
- **Descrição:** Lista uma tarefa específica.
- **Parâmetros:**
- **Resposta:**
  ```json
  {
	"data": [
		{
			"id": ,
			"titulo": "",
			"descricao": "",
			"status": ""
		}
	]
}

 ### DELETE Deleta Tarefa

- **URL:** `api/v1/tarefas/{id}`
- **Método:** DELETE
- **Descrição:** DELETA uma tarefa específica.
- **Parâmetros:**
- **Resposta:**
  ```json
  {
			"Tarefa Apagada"
  }
  ```
