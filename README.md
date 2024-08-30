
# Teste para Lumiun

### Sobre

Construi este projeto com base no teste apresentado pela empresa Lumiun. Sua principal funcionalidade é um CRUD que simula o controle de domínios dentro de uma rede.

Utilizei com stack a principal utilizada no ambiente de trabalho, sendo: TALL.
- TailwindCSS
- Alpine.js
- Laravel
- Livewire

Como diferencial, implementei a Clean Architecture, separando o código em camadas como Services, onde apliquei as regras de negócio, e Repository, responsável pelo acesso direto ao banco de dados.

Além disso, usei o Docker como ferramenta de ambientação, optando por não utilizar o Laravel Sail devido a algumas configurações pessoais.

Seguinto com os pacotes do Laravel, utilizei como pacote de autenticação o JetStream, devido ao seu alto nível de segurança.

Configurei o MySQL como banco de dados principal e um container com Redis como banco de memória, devido à sua alta velocidade e bom desempenho.

Adotei a arquitetura Livewire, que favorece o desenvolvimento com componentes. Como destaque, utilizei uma ferramenta de UI Open Source para facilitar a criação dos componentes: [TALL Stack UI](https://tallstackui.com/).

### Passo a passo de Instalação
Para este projeto funcionar precisar ter instalados como pré requisitos:
- Node.js
- Docker

Clone Repositório
```sh
git clone https://github.com/MarcelSecco1/test-lumiun.git
```

```sh
cd test-lumiun/
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Instale as dependências Node
```sh
npm install
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec app bash
```


Instale as dependências do composer
```sh
composer install
```

Gerar a key do projeto Laravel e rodar as migrations
```sh
php artisan key:generate
php artisan migrate
```

Saia do container
```sh
exit
```
Gere o build das dependências Node
```sh
npm run build
```

Por fim, basta acessar o projeto:
[http://localhost:8989](http://localhost:8989)
