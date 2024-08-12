# Documentação do Projeto Test Corelab Backend

## Requisitos

-   Docker: Versão 27.1.1, build 6312585
-   docker-compose: Versão 1.29.2, build desconhecido
-   Laravel: Versão 11.20.0
-   PHP: Versão 8.3

## Instruções de Inicialização

1.  Clonagem do Projeto

Clone o repositório do projeto e navegue até o diretório do mesmo.

2.  Execução do Script de Inicialização

Execute o script ./tools/start no terminal. Este script realizará as seguintes etapas:

```bash
cp .env.example .env
sleep 5
./docker/bin/sail build --no-cache
./docker/bin/sail up -d
./docker/bin/sail down
sleep 5
./docker/bin/sail up -d
sleep 5
./docker/bin/sail composer install
./docker/bin/sail artisan migrate:fresh --seed

```

Ao final do processo, será exibida a mensagem:

```bash
echo -e "\n\e[32mFinalizado com sucesso!\e[0m"

```

<strong>Atenção:</strong> Este script deve ser executado apenas na primeira vez que o projeto for configurado.

3. Execução Posterior

Para iniciar o projeto novamente depois da configuração inicial, utilize o script ./tools/up:

```bash
./docker/bin/sail up -d && ./docker/bin/sail bash
```

### Configuração do Ambiente

-   Variável SOCKETIO_URL

No arquivo .env.example, há uma variável chamada SOCKETIO_URL:

```
SOCKETIO_URL=http://127.0.0.1:3000
```

Importante: O valor http://127.0.0.1:3000 deve ser substituído pelo IP da máquina para que o backend possa se comunicar corretamente com o socket configurado no frontend.
