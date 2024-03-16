---
title: Configurando Obsidian para Planejamento de Conteúdo e Gerência de Projetos
published: true
description: Obsidian é um aplicativo flexível de escrita em markdown. Neste post, eu compartilho minha configuração e meus templates personalizados para planejamento de conteúdo e gerenciamento simples de projetos.
tags: tutorial, obsidian, productivity, tools
cover_image: https://dev-to-uploads.s3.amazonaws.com/uploads/articles/p4kfuwpib4h2vtmdv57o.png
---

_Originally published on [dev.to](https://dev.to/erikaheidi/setting-up-obsidian-for-content-planning-and-project-management-38f1)._

[Obsidian](https://obsidian.md/) é um aplicativo de escrita criado para permitir anotações offline/privadas no formato Markdown, em uma interface que lembra bastante os nossos IDEs de programação. É super flexível, com uma boa variedade de plugins desenvolvidos pela comunidade que você pode utilizar para personalizar o Obsidian de acordo com suas preferências.

Recentemente comecei a usar o Obsidian no trabalho para notas diárias e semanais e está sendo muito útil para me manter organizada. Agora estou configurando o Obsidian no meu notebook pessoal pra me ajudar a organizar idéias e projetos paralelos. Nesse post, vou compartilhar minha configuração e meus templates personalizados para facilitar esse processo.

## 1. Instalando o Obsidian

O primeiro passo é instalar o Obsidian no seu computador. Acesse a [página de downloads](https://obsidian.md/download) para baixar e instalar a versão indicada para o seu sistema.

## 2. Personalizando a Aparência do Obsidian

Assim que instalar o Obsidian, ao abri-lo pela primeira vez, você verá uma tela como essa, pedindo para criar um novo "Vault" ou usar um diretório existente como "Vault". Um "Vault" é basicamente a pasta onde seus documentos em Markdown vão ficar.

![Getting started with Obsidian](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/dqmcwl0r9h98c5h5gsa4.png)

Você pode especificar onde criar seu Vault. Eu criei uma pasta chamada "My Projects" dentro da minha pasta "Documents" e usei ela. Após confirmar a localização do seu Vault, você verá a interface padrão do Obsidian.

![Obsidian interface](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/ufwk9w3n6qo1b5anuvm4.png)

Eu prefiro temas escuros, então mudei em  **Settings -> Appearance -> Base color scheme**.

![Changing to a dark color theme in Obsidian](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/ap4valpccqvjbjn8rmu1.png)

Na mesma tela mais embaixo, eu aumentei um pouco o zoom da interface em **Advanced -> Zoom Level**.

![Increasing interface zoom level in Obsidian](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/sxhkge8d3gub6coq2val.png)

Ainda na janela de **Settings**, busque por **Community Plugins-> Turn on Community Plugins** para habilitar plugins contribuídos pela comunidade. Precisaremos dessa configuração habilitada para podermos instalar alguns plugins que serão usados nesse tutorial, e nos permitirão fazer melhor proveito do Obsidian para planejamento e gerência de tasks.

![Enabling community plugins on Obsidian](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/67j9to7i7tx2rdd2gvq0.png)

Do jeito que está, seu Obsidian já é funcional, e você já pode começar a organizar diretórios e arquivos markdown dentro ro seu Vault. No próximo passo, vamos instalar alguns plugins para ajudar com planejamento de conteúdo e gerência de tasks e projetos.

## 3. Instalando os plugins Templater e Tasks

O Obsidian possui uma grande coleção de plugins criados pela comunidade para atender a várias necessidades dos usuários. Para este guia, instalaremos o [Templater](https://github.com/SilentVoid13/Templater) e o [Tasks](https://github.com/obsidian-tasks-group/obsidian-tasks), dois plugins que podem ser realmente poderosos quando combinados para criar notas e listas de tarefas.

### 3.1 Templater

_Templater define uma linguagem de templates que permite inserir variáveis e resultados de funções em suas notas. Ele também permitirá que você execute código JavaScript manipulando essas variáveis e funções._

Usaremos o Templater para configurar alguns templates padrão por pasta. Assim, quando você criar um novo conteúdo do tipo "tutorial", ele usará automaticamente o template designado. Faremos o mesmo para projetos.

Primeiro, crie uma nova pasta para seus templates em seu Vault. Você pode chamá-la de "Templates". Em seguida, vá para **Configurações -> Templater** e defina a localização da pasta de templates para o diretório recém-criado. Habilite também a opção **Trigger Templater on new file creation** (Acionar o Templater na criação de novos arquivos).

![Setting up Obsidian Templater plugin](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/gq3z9ziuljmg2343sjx9.png)

Agora você pode começar a criar templates para diferentes tipos de conteúdo, projetos, etc., e combinar cada template com uma pasta de conteúdo. Vamos configurar dois templates neste guia: **Project** e **Content**.

Crie um novo arquivo na sua pasta de templates e chame-o de "Project". Você pode usar o seguinte modelo como base, personalizando-o para melhor atender às suas necessidades:

```markdown
---
name: Nome do Projeto
createdAt: <% tp.date.now() %> 
description: Um projeto para fazer X em Z
tags:
  - tag1
  - tag2
  - tag3
---

## A Fazer
- [ ] Tarefa 01 ⏫
- [ ] Tarefa 02
- [ ] Tarefa 03

## Marcos

- Marco 1
- Marco 2
- Marco 3

## Ideias
- Ideia 01
- Ideia 02
- Ideia 03
```

Crie outro arquivo chamado "Content" - esse será o seu template de conteúdo. Você pode usar o modelo seguinte como base:

```markdown
---
title: Como Fazer Alguma Coisa
description: Aprenda como fazer alguma coisa no Linux
tags:
  - tag1
  - tag2
  - tag3
---

## Introdução

Introduza o assunto.

## 1. Fazendo a primeira coisa

Explique como realizar a primeira etapa.

## 2. Fazendo a segunda coisa

Explique como realizar a segunda etapa.

## 3. Fazendo a terceira coisa

Explique como realizar a terceira etapa.

## Conclusão

Faça um resumo rápido, observações finais e como aprender mais.

---

### Checklist de Lançamento de Conteúdo

- [ ] Conteúdo publicado no DEV
- [ ] Conteúdo compartilhado no X/Twitter
- [ ] Conteúdo compartilhado no LinkedIn
- [ ] Vídeo curto publicado no Reels (Instagram)
- [ ] Vídeo curto publicado no YouTube Shorts
- [ ] Vídeo longo compartilhado no YouTube

```

Após configurar os dois modelos, crie uma pasta "Projeto" para salvar as páginas do seu projeto e uma pasta "Conteúdo" para salvar as páginas do tutorial. Em seguida, vá para **Configurações -> Templater** e navegue até **Folder Templates** para configurar os tipos de conteúdo de Projeto e Tutorial. Agora você deve associar cada pasta ao seu modelo correspondente.

![Setting up Obsidian with folder templates](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/gc5u2cd6jaxrf24pymiu.png)

Depois de aplicar as alterações, verifique se tudo funciona como esperado clicando com o botão direito do mouse na pasta de conteúdo ou projeto e criando uma nova nota lá. A nova nota deve ser criada usando o template designado.

### 3.2 Tasks

O plugin **Tasks** é muito poderoso porque permite criar listas de tarefas elaboradas e pesquisar/filtrar tarefas de todo o seu Vault para serem listadas em um único documento. Você pode, por exemplo, listar todas as suas tarefas pendentes de todos os seus projetos, usando vários filtros para destacar apenas o que é relevante ou de alta prioridade.

Como você deve ter notado, na etapa anterior em que configuramos os modelos do Templater adicionamos uma lista **A FAZER** ao template `Project` e uma **Checklist para Lançamento de Conteúdo** no template `Tutorial`. Podemos destacar essas tarefas em outro documento markdown que podemos usar para ter uma visão geral de alto nível de todas as suas tarefas em aberto.

Crie um novo arquivo na raiz do seu vault e chame-o de "Tasks". Copie o seguinte conteúdo para este arquivo:

~~~

### Projects
```tasks
not done
filter by function task.file.folder === "Projects/"
```


###  Content
```tasks
not done
filter by function task.file.folder === "Content/"
```
~~~

Agora, quando você mudar do modo de **edição** para o modo de **leitura**, você obterá duas listas com suas tarefas **TO DO** das pastas "Projects" e "Content", semelhante a isto:

![Showing all TO DO tasks in Obsidian](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/rouj0qavzntad8ygt8v9.png)

Você pode criar várias páginas como essa com diferentes filtros de busca para lhe dar visibilidade completa sobre seus planos e tarefas. Aqui eu também criei uma página "Completed Work" (trabalho concluído) para mostrar as tarefas que estão marcadas como "concluídas". Para isso, você pode usar uma consulta simples como a seguinte:

~~~
```tasks
done
```
~~~

Confira a documentação do [plugin Tasks](https://github.com/obsidian-tasks-group/obsidian-tasks) para saber mais sobre as poderosas funcionalidades de busca fornecidas pelo plugin.

## Considerações Finais

O Obsidian é uma poderosa aplicação de escrita de texto que permite que os usuários a personalizem de acordo com suas necessidades específicas. Com alguns plugins, você pode transformar seu Obsidian em um poderoso auxiliar para planejar e gerenciar conteúdo, novas idéias e projetos.

Neste guia, vimos como criar uma configuração básica usando os plugins Templater e Tasks para ajudá-lo a acompanhar suas tarefas de criação de conteúdo e outros projetos em geral. Com base no que você aprendeu aqui, você pode personalizar ainda mais suas pastas e templates de uma forma que melhor se adapte às suas necessidades.
