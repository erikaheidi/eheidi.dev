---
title: Docker para Iniciantes
description: Aprenda o básico de como usar o Docker para ambientes de desenvolvimento baseados em conteiners
tags: docker, containers, iniciantes
index: 20
cover_image: https://cdn.erikaheidi.com/blog/docker-para-iniciantes.png
---

_Nota: ao longo desse artigo você verá palavras intencionalmente não traduzidas, como "container". O intuito é facilitar a memorização dos termos originais para quando você precisar fazer buscas no Google, ler documentação, etc._

O Docker é um software usado para criar e rodar _Linux containers_. Diferente de máquinas virtuais, containers não emulam um sistema operacional completo, usando o sistema operacional da máquina host para prover um sistema de arquivos isolado que consume menos recursos que máquinas virtuais tradicionais, mas ainda provê uma runtime (ambiente de execução) completamente funcional baseada em um sistema operacional da sua escolha como base.

![Visão geral do modelo usado por containers](https://cdn.erikaheidi.com/blog/container-model-graph.png)

Os passos necessários para recriar uma imagem de container Docker são definidos em um [Dockerfile](https://docs.docker.com/engine/reference/builder/#dockerfile-reference). Esse arquivo contém instruções especiais para instalar pacotes, criar usuários, e rodar comandos arbitrários de sistema. Esses passos serão executados em sequência para construir uma imagem. Pense em imagens de containers como um ISO de um sistema operacional pré-instalado e pronto para ser executado por um software compatível.

## Baixando Imagens de um Registry
Imagens de container podem ser hospedadas em um repositório remoto (geralmente chamado "registry"), permitindo assim que a imagem seja compartilhada com vários usuários e todos tenham a mesma experiência com aquele ambiente, independente do sistema operacional que estão utilizando na máquina host. Essa é uma das maiores vantagens de se utilizar Docker para ambientes de desenvolvimento em times. O registry padrão é o do [Docker Hub](https://hub.docker.com), mas existem outros, e é possível hospedar o seu próprio registry também. Ao utilizar images que não estão no Docker Hub, você precisa especificar a URL completa do registry e imagem.

O command `docker pull` é usado para baixar imagens de um registry remoto. Não é obrigatório rodar esse comando cada vez que você for rodar uma imagem, já que o `pull` acontece automaticamente na primeira vez que você roda uma imagem que ainda não existe em seu sistema local. Porém, se você já tem uma cópia local da imagem, ela pode ficar desatualizada, então você precisará rodar o commando `pull` com alguma frequência para manter a sua versão local da imagem atualizada.

```shell
docker pull registry/image
```
Por exemplo, o comando seguinte fará o download da imagem [cgr.dev/chainguard/php](https://edu.chainguard.dev/chainguard/chainguard-images/reference/php), que é uma imagem de PHP para a linha de comando produzida pela [Chainguard](https://chainguard.dev):

```shell
docker pull cgr.dev/chainguard/php
```
```shell
Using default tag: latest
latest: Pulling from chainguard/php
1e4853eb9712: Pull complete 
Digest: sha256:387acb900179de11ca5a56c3ebbb6f29d2df88cb488d50fc9736ab085f27520d
Status: Downloaded newer image for cgr.dev/chainguard/php:latest
cgr.dev/chainguard/php:latest
```

Para verificar as imagens disponíveis localmente, incluindo informações sobre quando a imagem foi criada e o seu tamanho, você pode usar o comando `docker image ls`:

```shell
❯ docker image ls
REPOSITORY                      TAG          IMAGE ID       CREATED        SIZE
cgr.dev/chainguard/php          latest       9f9471bacf3f   7 days ago     39.9MB
cgr.dev/chainguard/php          latest-dev   e391b4b68dc9   12 days ago    63.2MB
cgr.dev/chainguard/wolfi-base   latest       b5f493ef67c4   4 months ago   12.9MB
```

## Executando Containers

O comando `docker run` é usado para executar o _entrypoint_ (ponto de entrada) definido em seu Dockerfile. Dependendo da imagem e como ela é utilizada, você pode precisar passar parâmetros adicionais ao comando.

```shell
docker run registry/image
```

Por exemplo, o comando seguinte irá executar a imagem PHP que baixamos na seção anterior, com o parâmetro `--version` para obter a versão do PHP que está disponível naquela imagem:

```shell
docker run cgr.dev/chainguard/php --version
```
```shell
PHP 8.2.12 (cli) (built: Nov 15 2023 15:30:03) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.2.12, Copyright (c) Zend Technologies
```

### Executando Containers em Modo Interativo
Muitas das imagens de container rodam apenas um comando e são terminadas após a execução do mesmo. É o caso, por exemplo, das imagens PHP para linha de comando, que têm a finalidade de rodar scripts. Não há interação uma vez que o processo de execução é iniciado.

Algumas imagens esperam algum tipo de interação com o usuário. Esse é normalmente o caso de imagens que rodam uma aplicação interativa, como o `bash`. Nesses casos, você precisa adicionar o parâmetro `-it` ao executar o seu `docker run`:

```shell
docker run -it registry/image
```

O comando seguinte irá executar a imagem [wolfi-base](https://edu.chainguard.dev/chainguard/chainguard-images/reference/wolfi-base), que roda o `bash` como entrypoint, de forma interativa:

```shell
docker run -it cgr.dev/chainguard/wolfi-base
```
Ao rodar esse comando, você vai aterrissar diretamente na shell do container, podendo executar comandos normalmente como se fosse a sua máquina local.

### Rodando containers efêmeros
Para remover um container imediatamente após ele ser terminado, adicione o parâmetro `-rm` ao rodar `docker run`:

```shell
docker run --rm registry/image
```

Essa funcionalidade é útil para rodar comandos rápidos que não geram nenhum output relevante que precise ser compartilhado ou persistido, como o nosso primeiro exemplo quando checamos a versão do PHP disponível na imagem. Poderíamos reescrever aquele comando da seguinte forma:

```shell
docker run --rm cgr.dev/chainguard/php --version
```

E isso evitará que o Docker mantenha o estado desse container, o que é bom para salvar recursos da máquina.

## Verificando o status de containers
Para ter uma lista completa de containers ativos e inativos, você pode rodar:

```shell
docker ps -a
```

_Nota: Quando o parâmetro `-a` não é incluído, o Docker vai listar apenas os containers que estão em execução._

Output esperado:

```shell
CONTAINER ID   IMAGE                    COMMAND                CREATED          STATUS                      PORTS     NAMES
26272c21399c   cgr.dev/chainguard/php   "/bin/php --version"   10 minutes ago   Exited (0) 10 minutes ago             musing_hermann
```

A primeira vez que executamos o comando para obter a versão do PHP, não usamos o parâmetro `--rm`. Como consequência, o Docker salvou o estado desse container, mesmo estando inativo.

## Usando Compartilhamentos (Volume Shares)
Ao rodar ambientes de desenvolvimento, é crucial que você seja capaz de editar um código na sua máquina local, enquanto pode visualizar e testar as mudanças usando o ambiente em containers. Para facilitar esse processo, você pode usar [Docker Volumes](https://docs.docker.com/storage/volumes/). Volumes são usados para compartilhar o conteúdo de uma pasta da sua máquina host com um local predefinido dentro do container.

O comando seguinte cria um _volume share_ (ou compartilhamento, para simplificar) que compartilha o conteúdo de PASTA_LOCAL na máquina host com a PASTA_REMOTA dentro do container:

```shell
docker run -v PASTA_LOCAL:PASTA_REMOTA registry/image
```

### Caso de Uso e Exemplo

Imagine que você quer executar um script PHP sem ter a necessidade de instalar o PHP (ou qualquer outra linguagem) no seu sistema. Você precisa ser capaz de fazer mudanças nos arquivos localmente enquanto testa os scripts em um ambiente isolado.

Crie um diretório no seu home para acompanhar essa pequena demo:

```shell
mkdir ~/docker-demo
cd ~/docker-demo
```

Em seguida, crie um arquivo chamado `demo.php` e adicione o seguinte conteúdo:

```php
<?php
echo "Testing Docker PHP Dev Env";
print_r($argv);
```
Não esqueça de salvar o arquivo antes de fechar.

Agora você pode usar o Docker junto a uma imagem PHP para executar esse código. Para que o container tenha acesso ao seu script, você precisará criar um volume share:

```shell
docker run --rm -v ${PWD}:/app cgr.dev/chainguard/php demo.php
```
A variável shell `${PWD}` contém o diretório atual, de onde você está executando o comando. O volume vai compartilhar a pasta atual com a localização `/app` dentro do container. Essa pasta é o _workdir_ (diretório de trabalho) definida pela imagem que estamos usando (outras imagens podem ter um local diferenciado como workdir). Com os arquivos compartilhados no diretório workdir, você pode se referir ao seu script simplesmente como `demo.php`.
 
## Liberando Componentes Inativos

Alguns componentes não são removidos quando um container é terminado; é o caso de compartilhamento de volumes. Images e suas inúmeras camadas também podem ocupar bastante espaço no seu sistema, na casa dos gigabytes. 

O comando `docker prune` pode ser usado para limpar componentes e recursos que não estão mais sendo utilizados, liberando espaço em disco. Por exemplo, para liberar volumes inativos:

```shell
docker volume prune
```
```
WARNING! This will remove anonymous local volumes not used by at least one container.
Are you sure you want to continue? [y/N] 
```

A mesma lógica se aplica a `images` e `networks`. Para fazer uma limpeza completa no sistema, você pode usar o comando `system prune`:

```shell
docker system prune
```
Você vai ver um aviso pedindo comfirmação sobre o que será removido. Tecle `y` para confirmar.

```shell
WARNING! This will remove:
  - all stopped containers
  - all networks not used by at least one container
  - all dangling images
  - all dangling build cache

Are you sure you want to continue? [y/N] 
```

Recursos não utilizados vão acumulando com o tempo, então é interessante rodar esse comando com alguma frequência. Dependendo de como você está usando o Docker, você pode liberar bastante espaço em disco com esse comando.

## Recursos para Aprender Mais
O artigo [What are Containers](https://edu.chainguard.dev/software-security/what-are-containers/) da Chainguard Academy oferece uma excelente visão geral sobre containers e imagens. Para mais especificações técnicas e documentação de referência, visite a [documentação oficial do Docker](https://docs.docker.com/get-started/overview/), que cobre todos os componentes do ecossistema Docker.

## Bonus: Docker Cheat Sheet
![Docker Cheat Sheet](https://cdn.erikaheidi.com/blog/docker-cheat-sheet.png)
