---
title: Criando uma Pipeline de Automação para Documentação com Autodocs e GitHub Actions
published: true
description: Nesse tutorial você vai aprender como criar uma pipeline de automação para gerar documentos markdown com Autodocs, Minicli, e GitHub Actions
tags: tutorial, php, docs
cover_image: https://dev-to-uploads.s3.amazonaws.com/uploads/articles/9vbfuul6vi7q0w39fmoy.png
---

_Originally published on [dev.to](https://dev.to/erikaheidi/creating-an-automated-documentation-pipeline-in-php-with-autodocs-and-github-actions-1464)._

[Autodocs](https://github.com/erikaheidi/autodocs) é uma biblioteca PHP criada para facilitar a automação de documentação em formato markdown, baseada em templates. Quando combinada a uma aplicação [Minicli](https://docs.minicli.de), essa biblioteca fornece uma camada de abstração e estrutura para criação de pequenas "fábricas de documentação", aproveitando a infra fornecida pelo GitHub Actions.

Eu criei esse projeto em 2023 para me auxiliar no trabalho de documentar o [extenso catálogo de imagens de contêiner da Chainguard](https://edu.chainguard.dev/chainguard/chainguard-images/reference). Nosso workflow automatizado é responsável por manter milhares de páginas de documentação atualizadas diariamente.

Páginas são definidas como classes que seguem uma interface conhecida. Arquivos de dados em formato JSON são carregados automaticamente pela aplicação, um design desacoplado que facilita a implementação de Autodocs em workflows distribuídos.

Neste tutorial, vamos criar um aplicativo demo Autodocs para gerar READMEs pessoais no GitHub. Se você preferir pular o tutorial e ir direto para o código, você pode conferir o repositório com o demo completo aqui: https://github.com/erikaheidi/autodocs-demo.

## 1. Criando o App

Vamos começar criando o app de demonstração. Estamos usando o [template de Aplicativo Minicli](https://docs.minicli.dev/en/latest/getting_started/creating-apps/) para fornecer mais recursos e organização ao desenvolver o app.

```shell
composer create-project minicli/minicli autodocs-demo
```
Assim que o Composer terminar de instalar todas as dependências, você deverá ser capaz de acessar o diretório e executar um teste rápido:

```shell
cd autodocs-demo
./minicli
```

Você dever obter um output similar a este, indicando que a aplicação Minicli está rodando como esperado:

```shell
❯ ./minicli


███╗   ███╗██╗███╗   ██╗██╗ ██████╗██╗     ██╗
████╗ ████║██║████╗  ██║██║██╔════╝██║     ██║
██╔████╔██║██║██╔██╗ ██║██║██║     ██║     ██║
██║╚██╔╝██║██║██║╚██╗██║██║██║     ██║     ██║
██║ ╚═╝ ██║██║██║ ╚████║██║╚██████╗███████╗██║
╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝╚═╝ ╚═════╝╚══════╝╚═╝

Minimalist, dependency-free framework for building CLI-centric PHP applications

```

Agora você pode renomear o arquivo executável `minicli` para **autodocs** ou outro nome que represente melhor a sua aplicação:

```shell
mv minicli autodocs
```

Vamos agora incluir o Autodocs como dependência via Composer:

```shell
composer require erikaheidi/autodocs
```

Agora você possui todos os requisitos necessários para desenvolver sua aplicação Autodocs.

## 2. Configurando o Serviço Autodocs

Crie um novo arquivo de configuração para as settings do Autodocs. Esse arquivo deve ser colocado no diretório `config` da sua aplicação Minicli.

```shell
touch config/autodocs.php
```

O serviço Autodocs espera uma chave `autodocs` em sua configuração com alguns itens mandatórios:


- `templates_dir`: onde encontrar arquivos `.tpl` que podem ser usados como modelos de página. O uso de templates não é obrigatório, mas pode ser útil para facilitar atualizações de layout de conteúdo sem precisar alterar as classes de página.
- `cache_dir`: arquivos `.json` colocados neste diretório serão registrados automaticamente como um objeto `DataFeed` dentro do serviço principal Autodocs.
- `output`: local onde salvar as páginas criadas.
- `pages`:  uma lista com classes que devem ser registradas como _Reference Pages_ (ou Páginas de Documentação). Essas são as páginas de documentação que serão criadas a cada execução.
- `storage`: (Opcional) uma classe que implementa StorageInterface, capaz de manipular o acesso ao sistema de arquivos para salvar e recuperar arquivos. A classe padrão `FileStorage` é usada quando nenhuma opção é definida.

Para nossa demonstração, vamos criar um diretório storage para modelos, conteúdo e cache:

```shell
mkdir -p storage/cache storage/templates storage/content
```
Agora, abra o arquivo `config/autodocs.php` criado anteriormente, usando um editor de código da sua escolha. Copie a seguinte configuração para o este arquivo:

```php
<?php

declare(strict_types=1);

use Autodocs\Page\ExamplePage;

return [
    'autodocs' => [
        // Pages to Build
        'pages' => [
            ExamplePage::class
        ],
        // Build Output Folder
        'output' => envconfig('AUTODOCS_OUTPUT', __DIR__.'/../storage/content'),
        // Cache Folder - where to look for cache json files
        'cache_dir' => envconfig('AUTODOCS_CACHE', __DIR__.'/../storage/cache'),
        // Templates directory
        'templates_dir' => envconfig('AUTODOCS_TEMPLATES', __DIR__.'/../storage/templates')
    ]
];

```
Salve o arquivo. Note que registramos uma `ExamplePage` que vem incluída com o Autodocs para testes. Vamos atualizar essa seção da configuração depois para incluir a página customizada que vamos criar.

## 3. Registrando o serviço Autodocs
Com a configuração criada, você já pode registrar o serviço Autodocs dentro da Aplicação Minicli.

Abra o arquivo `config/services.php` e certifique-se que ele tenha o conteúdo abaixo, incluindo o registro do serviço `autodocs`:

```php
<?php

declare(strict_types=1);

use Autodocs\Service\AutodocsService;

return [
    /****************************************************************************
     * Application Services
     * --------------------------------------------------------------------------
     *
     * The services to be loaded for your application.
     *****************************************************************************/

    'services' => [
        'autodocs' => AutodocsService::class,
    ],
];

```

Salve o arquivo. Com o serviço registrado, você já pode trabalhar no comando que fará o build da documentação.

## 4. Criando um Comando para "buildar" os Docs
Vamos criar um comando para construir nossa documentação automatizada customizada. Ele vai gerar todas as páginas definidas na seção `pages` do arquivo de configuração do Autodocs. Por enquanto, ela deve estar configurada para incluir apenas a "ExamplePage". Uma vez que esse exemplo simples seja construído, podemos começar a trabalhar em nossas páginas de documentação reais.

No Minicli, [criar um comando]https://docs.minicli.dev/en/latest/getting_started/creating-controllers/) é apenas uma questão de configurar algumas classes e diretórios em um formato pré-definido. Comece criando um diretório para seus comandos dentro de `app/Commands`:

```shell
mkdir app/Command/Build
```

Em seguida, criaremos o _Command Controller_ que será responsável por construir a documentação.

Crie um novo arquivo chamado `DefaultController.php` dentro do diretório `app/Command/Build` recém-criado. Nesta classe, vamos configurar um método que será chamado sempre que executarmos `./autodocs build`. 

```shell
touch app/Command/Build/DefaultController.php
```
Abra este arquivo no seu editor de PHP de preferência. Você pode começar copiando o seguinte esqueleto para a sua classe de controlador:

```php
<?php

declare(strict_types=1);

namespace App\Command\Build;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        //build command action
    }
}

```

No método `handle`, podemos acessar a aplicação, o contêiner de configuração e todos os serviços registrados. A lógica aqui dependerá das suas necessidades de documentação.

Para construir a `ExamplePage` que já vem incluída para testes, atualize seu método `handle` com o código a seguir:

```php
    public function handle(): void
    {
        /** @var AutodocsService $autodocs */
        $autodocs = $this->getApp()->autodocs;

        $this->info("Starting Build...");
        $autodocs->buildPages($this->getParam('pages') ?? "all");
        $this->info("Build finished. Output saved to " . $autodocs->config['output']);

    }
```
O código definido no método `handle` fará o build da `ExamplePage`, salvando o resultado na localização definida pela chave `output` na configuração do Autodocs.

Agora você pode fazer o build da documentação com o seguinte comando:

```shell
./autodocs build
```

Você deve obter um output similar a este:

```
❯ ./autodocs build

Starting Build...

Build finished. Output saved to /home/erika/Projects/autodocs-demo/config/../storage/content

```

Verifique a pasta definida como `output`, você deve encontrar um arquivo `example.md`. Isso foi apenas para testarmos o comando de `build` que criamos; ainda vamos definir uma página customizada para gerar nesse build.

## 5. Criando Páginas de Documentação

No passo anterior, criamos um comando de build e o usamos para compilar a `ExamplePage` que já vem incluída para testes. Essa é uma página realmente simples que basicamente exibe um título e uma descrição. Depois de dar uma olhada em como as páginas são definidas, vamos criar uma página personalizada para nosso aplicativo demo.


### 5.1 Páginas de Referência

Páginas de Referência são modelos que representam um documento e como ele deve ser construído. Elas devem extender a classe `ReferencePage` (ou implementar a interface `ReferencePageInterface`) e implementar os seguintes métodos:

- `loadData` - este método recebe um array opcional `$parameters` e deve carregar quaisquer dados adicionais necessários para construir a página.
- `getName` - deve retornar um identificador único que possa ser usado posteriormente para construir apenas este tipo de página.
- `getContent` - o conteúdo de fato que será salvo.
- `getSavePath` - o caminho onde salvar este arquivo, a ser usado pelo "builder" de páginas.

É mais fácil ver como funciona na prática, então vamos examinar o código da `ExamplePage`:

```php
<?php

declare(strict_types=1);

namespace Autodocs\Page;

use Autodocs\DataFeed\JsonDataFeed;

class ExamplePage extends ReferencePage
{
    public JsonDataFeed $dataFeed;
    public function loadData(array $parameters = []): void
    {
        $this->dataFeed = new JsonDataFeed();
        $this->dataFeed->loadFromArray([
            'title' => 'example',
            'description' => 'description'
        ]);
    }

    public function getName(): string
    {
        return "example";
    }

    public function getContent(): string
    {
        return $this->dataFeed->json['title'].' - '.$this->dataFeed->json['description'];
    }

    public function getSavePath(): string
    {
        return 'example.md';
    }
}

```

Este exemplo cria um `JsonDataFeed` e o carrega com dados estáticos. Outra opção seria ter os dados pré-definidos em arquivos de cache JSON que são automaticamente registrados pelo Autodocs - você só precisa colocar os arquivos no caminho definido pela opção de configuração `cache`.

A seguir, criaremos nossa própria página de documentação personalizada usando um `JsonDataFeed` simples. Para esta demonstração, vamos gerar uma página markdown que pode ser usada como seu README pessoal no GitHub (aquele que é renderizado no seu perfil).

### 5.2 Criando uma `ReadmePage`

A seguinte classe [ReadmePage](https://github.com/erikaheidi/autodocs-demo/blob/main/app/ReadmePage.php) carrega dados de um `JsonDataFeed` que foi pré-carregado pelo serviço Autodocs. Definiremos esse arquivo JSON na próxima etapa.

O método `getContent` usa a biblioteca [Stencil](https://docs.minicli.dev/en/latest/the_ecosystem/stencil/) para renderizar um template chamado `readme.tpl` com valores obtidos de um `JsonDataFeed`.

```php
<?php

declare(strict_types=1);

namespace App;

use Autodocs\DataFeed\JsonDataFeed;
use Autodocs\Page\ReferencePage;

class ReadmePage extends ReferencePage
{
    public JsonDataFeed $dataFeed;
    public function loadData(array $parameters = []): void
    {
        $this->dataFeed = $this->autodocs->getDataFeed('profile.json');
    }

    public function getName(): string
    {
        return "readme";
    }

    public function getContent(): string
    {
        return $this->autodocs->stencil->applyTemplate('readme', [
            'title' => $this->dataFeed->json['user'],
            'about' => $this->dataFeed->json['bio'],
            'projects_list' => $this->getProjects(),
        ]);
    }

    public function getProjects(): string
    {
        $content = "";
        foreach ($this->dataFeed->json['projects'] as $project => $info) {
            $content .= "- [{$project}]({$info['link']}): {$info['description']}\n"; // returns Markdown list
        }

        return $content;
    }

    public function getSavePath(): string
    {
        return 'README.md';
    }
}
```
copie esse conteúdo para o seu arquivo app/ReadmePage.php e salve. Mas não rode a compilação (build) ainda; nós ainda precisamos configurar a fonte de dados JSON e o arquivo de template usado pela classe ReadmePage.

### 5.3 Configurando o `profile.json`

Em seguida, criaremos um arquivo JSON simples com alguns dados para usarmos na construção da página Readme.

Crie um novo arquivo chamado `profile.json` no seu diretório `cache_path`:

```shell
touch storage/cache/profile.json
```
Open the file in your editor of choice. Copy the following JSON skeleton and update the data with your own info:

```json
{
  "user": "Erika Heidi",
  "bio": "Software and Documentation Engineer",
  "projects": {
    "minicli/minicli": {
      "description": "CLI framework for PHP",
      "link": "https://docs.minicli.dev"
     },
    "erikaheidi/autodocs": {
      "description": "Tiny framework for automating documentation",
      "link": "https://github.com/erikaheidi/autodocs/wiki"
    }
  }
}

```
Salve o arquivo quando finalizar a edição.

### 5.4 Preparando o template `readme.tpl`

Crie um novo arquivo para servir de template para o nosso Readme:

```shell
touch storage/templates/readme.tpl
```
Copie o seguinte conteúdo para este arquivo:

```tpl
## {{ title }}

{{ about }}

## My Projects

{{ projects_list }}

```
Salve o arquivo ao acabar.

### 5.5 Registrando a `ReadmePage` na Configuração do Autodocs

Agora você só precisa registrar sua página personalizada dentro da configuração do Autodocs. Edite o arquivo `config/autodocs.php` e altere a entrada `pages` para incluir a nova página. Você também pode remover a `ExamplePage` enquanto estiver fazendo isso. Deve ficar assim quando você terminar:

```php

    'autodocs' => [
        // Pages to Build
        'pages' => [
            ReadmePage::class
        ],
```
Salve o arquivo quando terminar.

### 5.6 Fazendo o Build da `ReadmePage`

Após registrar a página na configuração do Autodocs, você pode rodar novamente o comando `build` para gerar a sua nova `ReadmePage`:

```shell
./autodocs build
```
O output deve indicar se o build ocorreu com sucesso. Você deve encontrar um arquivo `readme.md` no seu diretório de output com o conteúdo similar a este:

```markdown
## Erika Heidi

Software and Documentation Engineer

## My PHP Projects

- [minicli/minicli](https://docs.minicli.dev): CLI framework for PHP
- [erikaheidi/autodocs](https://github.com/erikaheidi/autodocs/wiki): Tiny framework for automating documentation
```

## 6. Executando a Demo com GitHub Actions (Opcional)

Agora vamos criar um workflow para executar esse demo no GitHub Actions. Isso é opcional e requer que você configure seu próprio repositório com uma cópia do projeto. Você também pode fazer um fork do demo original: https://github.com/erikaheidi/autodocs-demo para sua conta do GitHub e alterar o arquivo de dados JSON para incluir suas próprias informações. Depois de configurar seu repositório, vá para `Configurações -> Ações -> Geral`, role até a parte inferior da página onde você encontrará a seção **Workflow Permissions**.

![enable workflows to create pull requests](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/2xza58bo7aos36ge7tcd.png)

Habilite as opções **Read and write permission** (permissões de leitura e escrita) e **Allow GitHub Actions to create and approve pull requests** (Permitir que GitHub Actions enviem Pull Requests) para que o workflow possa realizar alterações e criar um PR com os documentos gerados.

Nosso workflow irá:

- configurar algumas variáveis de ambiente que irão sobrescrever os valores de configuração padrão do Autodocs,
- fazer o checkout do repositório,
- instalar as dependências do Composer usando o cache quando disponível,
- construir a documentação,
- enviar um pull request apenas quando mudanças forem detectadas.

```yaml
name: Build Docs

on:
  workflow_dispatch:

env:
  AUTODOCS_OUTPUT: "${{ github.workspace }}"
  AUTODOCS_CACHE: "${{ github.workspace }}/storage/cache"
  AUTODOCS_TEMPLATES: "${{ github.workspace }}/storage/templates"
jobs:
  build:

    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v3

    - name: Cache Composer packages
      id: composer-cache
      uses: actions/cache@v2
      with:
        path: vendor
        key: ${{ runner.os }}-php-${{ hashFiles('**/composer.lock') }}
        restore-keys: |
          ${{ runner.os }}-php-

    # Install Dependencies
    - name: Install dependencies
      run: composer install --prefer-dist --no-progress

    # Build Docs
    - name: Run Autodocs
      run: ./autodocs build

    # Send a Pull Request
    - name: Create a PR
      uses: peter-evans/create-pull-request@v5
      id: cpr
      with:
        path: "${{ github.workspace }}"
        commit-message: Update content
        title: "[AutoDocs] Updated README"
        body: "README auto-update"
        labels: |
          documentation
          automated

```

Você pode salvar este arquivo em `.github/workflows/autodocs.yaml`. Não esqueça de fazer o commit e o push para o seu repositório. Assim que o arquivo estiver lá, acesse a aba **Actions** e selecione a ação **Build Docs** à esquerda. Este workflow não está configurado para ser executado automaticamente; em vez disso, ele usa o gatilho `workflow_dispatcher`, que só pode ser acionado a partir da página do repositório.

Clique no botão "Run Workflow" à direita e confirme a execução do workflow pela primeira vez. Se o build for bem-sucedido, você receberá um novo _pull request_ no seu repositório.

![Autodocs pull request](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/0b9ltxtdp379oox94q5i.png)

Baseado neste exemplo simplificado, você pode elaborar seu workflow para gerar automaticamente os dados do seu arquivo `profile.json` e manter seu README sempre atualizado. Que tal extrair seus posts mais recentes do DEV ou de um feed de blog? Mostre seus projetos favoritos ou destaque seus _sponsors_! O único limite é a sua imaginação :)

## Considerações Finais

A documentação é um organismo vivo, ela muda e evolui conforme os projetos crescem. Depois de alguns anos trabalhando na área de technical writing e documentação, acredito que uma boa documentação precisa de flexibilidade, contexto e intervenção humana. É difícil combinar esses elementos em um software único e pronto para criar documentos por mágica.

O Autodocs não gera documentos magicamente para você, essa nunca foi a intenção. Em vez disso, ele fornece uma camada bem fina de abstrações para lhe dar estrutura suficiente para projetar seus documentos super personalizados e também para expandir sua documentação usando uma abordagem distribuída para obtenção de dados.

Se você quiser ver uma implementação mais complexa para ter uma ideia do que o Autodocs é capaz, confira o projeto [Images Autodocs da Chainguard no GitHub]( https://github.com/chainguard-dev/images-autodocs).
