---
title: Introdução ao Controle de Versão com Git
description: Aprenda o básico sobre controle de versão e como começar a usar o Git
tags: git, iniciantes
index: 1
cover_image: https://dev-to-uploads.s3.amazonaws.com/uploads/articles/7zbul4bobq09n75li77j.png
---

O Git é um sistema de controle de versão que permite rastrear alterações no código, colaborar com outras pessoas e gerenciar múltiplas versões de um projeto. Ao dominar o Git na linha de comando, pessoas desenvolvedoras ganham flexibilidade para executar várias tarefas com eficiência, como criar e alternar entre branches, resolver conflitos de merge e gerenciar repositórios remotos.

Neste guia, os iniciantes podem aprender sobre controle de versão e como começar a usar o Git. Para acompanhar, você precisará de acesso a um terminal e privilégios administrativos para instalar o Git.

## Visão geral

Em poucas palavras, o controle de versão é um sistema que permite rastrear alterações em arquivos ao longo do tempo. Isso possibita, dentre outras coisas:

* **Colaboração**: o controle de versão permite que várias pessoas trabalhem nos mesmos arquivos sem sobrescrever as alterações umas das outras.
* **Histórico**: o controle de versão mantém um histórico de todas as alterações feitas nos arquivos, para que você possa ver quem fez uma alteração, quando a fez e por quê.
* **Reversão / Rollback:** o controle de versão permite que você reverta para uma versão anterior de um projeto caso algo não funcione como esperado.

O Git é uma ferramenta popular de controle de versão amplamente utilizada para desenvolvimento de software, mas que também pode ser usada para qualquer tipo de projeto que envolva o gerenciamento de vários arquivos. O Git foi projetado para ser eficiente, flexível e fácil de usar. É uma ferramenta poderosa que pode ajudá-lo a gerenciar seus projetos com mais eficácia.

## Instalando e Configurando o Git

A [documentação oficial do Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) possui instruções detalhadas de como instalar o Git em todos os sistemas suportados. No Ubuntu, você pode usar o seguinte comando para instalar o Git:

```
sudo apt update && sudo apt install git
```

Para verificar se a instalação foi be sucedida, execute:

```
git --version
```

Após confirmar a instalação, você deve configurar o Git com seu nome e emaill:

```
# Configurando nome
git config --global user.name "Your Name"

# Configurando email
git config --global user.email "your@email.com"

# Configurando a branch padrão
git config --global init.defaultBranch "main"
```

Agora você já pode começar a usar o Git\!

## Pequeno Glossário Git

Os comandos e termos usados pelo Git são geralmente usados sem tradução, ou de forma “abrasileirada” pela comunidade desenvolvedora no Brasil, então aqui vai um pequeno glossário para facilitar o entendimento por parte de pessoas iniciantes:

* **stage** ou **staging** : aqui ficam os arquivos que estão marcados para serem “commitados”
* **stagear**: ato de adicionar arquivos no stage.
* **commit**: um registro de um ponto específico na linha de tempo de um projeto.
* **commitar**: ato de criar um commit.
* **push, pushar:** do inglês “empurrar” (push), o ato de enviar alterações previamente commitadas para o repositório remoto de origem.
* **pull**: do inglês “puxar” (pull), o ato de buscar as atualizações mais recentes de um projeto em sua origem.
* **branch**: uma versão ou bifurcação do projeto, baseada em um commit de origem.
* **fork**: uma cópia completa do projeto, normalmente utilizada quando precisamos enviar um pull request para um repositório onde não temos permissões de escrita.
* **merge**, **mergear**: incorporar alterações de outra branch na sua branch atual.
* **pull request**: parte do processo para sugerir alterações ou contribuir código para um projeto.

## O Workflow Git Básico

O fluxo de trabalho básico do Git envolve um ciclo de fazer alterações em arquivos, adicionar essas alterações à área de staging, commitá-las ao seu repositório local e, em seguida, enviá-las para um repositório remoto (push).

Adicionar as alterações à área de staging permite que você agrupe alterações relacionadas antes de commitá-las. Commitar as alterações cria um registro instantâneo do seu projeto em um ponto específico no tempo, juntamente com uma mensagem descrevendo as alterações. Enviar as alterações para um repositório remoto as torna disponíveis para outros colaboradores e faz um backup do seu trabalho caso algo aconteça ao seu repositório local.

Esse ciclo permite rastrear alterações, colaborar com outras pessoas e reverter facilmente o projeto para versões anteriores.

![asd](https://cdn.erikaheidi.com/git-github/gitflow_ptbr.png)

A imagem mostra uma analogia para o fluxo de trabalho do Git usando cartas. Quando você está trabalhando no conteúdo da sua carta, você tem alterações “unstaged”. Quando estiver pronto, você adicionará a carta a um envelope, e isso é o equivalente a adicionar arquivos à sua área de staging. Finalmente, você irá commitar suas alterações fechando a carta e colocando nela um selo. Depois de tudo isso, você ainda precisa enviar suas alterações para o repositório remoto, que é o equivalente a colocar sua carta em uma caixa de correio.

## Criando o seu Primeiro Repositório Git

Agora veremos alguns comandos básicos de Git para demonstrar esse workflow na prática.

Primeiramente, crie um diretório de testes e accesse-o:

```
mkdir testgit && cd testgit
```

O comando a seguir irá inicializar um repositório Git vazio:

```
git init
```

Você deverá obter output similar a este:

```
Initialized empty Git repository in /home/erika/testgit/.git/
```

Todos os arquivos nesse diretório agora estão sendo trackeados pelo Git. Crie um novo arquivo para que possamos fazer um commit de teste:

```
echo "Git Crash Course" > readme.txt
```

Se você checar o status do repositório agora, irá notar o novo arquivo `readme.txt` listado como “untracked”:

```
git status
```

Você obterá um output similar a este:

```
On branch main

No commits yet

Untracked files:
  (use "git add <file>..." to include in what will be committed)
	readme.txt

nothing added to commit but untracked files present (use "git add" to track)
```

Como a mensagem sugere, você pode adicionar arquivos para serem commitados posteriormente com o comando `git add`:

```
git add readme.txt
```

Se você executar o comando `git status` novamente, irá notar que o arquivo `readme.txt` agora está sendo listado na área de “staged”. Isso significa esse arquivo agora faz parte das mudanças que serão commitadas. O output também indica que se trata de um arquivo novo, sem histórico prévio para o Git:

```
On branch main

No commits yet

Changes to be committed:
  (use "git rm --cached <file>..." to unstage)
	new file:   readme.txt
```

Para commitar as mudanças, você pode usar o seguinte comando, que cria um  novo commit com a mensagem especificada pelo parâmetro `-m`:

```
git commit -m "first commit"
```

Você obterá output similar a este:

```
[main (root-commit) 8e822c2] first commit
 1 file changed, 1 insertion(+)
 create mode 100644 readme.txt
```

Parabéns\! 🎉 Você acabou de criar o seu primeiro commit. Você pode verificar todas as mudanças recentes no seu repositório com o comando `git log`:

```
git log
```

Você deverá obter um output similar a este, mostr ando o seu primeiro commit no repositório:

```
commit 8e822c2c3b8b2872da87c6716f426282bb8a6340 (HEAD -> main)
Author: Erika Heidi <erika@erikaheidi.com>
Date:   Thu Nov 14 19:30:35 2024 +0100

	first commit
(END)
```

Para sair, pressione a tecla **`q`**.

Vale lembrar que todas essas mudanças estão sendo trackeadas apenas localmente. Não há repositório remoto linkado com esse repositório local, então tudo está rodando apenas na sua máquina local. Se você apagar o diretório `testgit`, nada será salvo. Em um cenário mais realista, você estaria executando um comando adicional para enviar esses commits para um repositório remoto. Você vai aprender como fazer isso em um outro artigo dessa série.

## Conclusão

Nesse artigo você aprendeu o básico sobre Git, incluindo como inicializar um repositório em sua máquina local, como adicionar arquivos ao staging, e como commitar suas alterações. No próximo artigo dessa série, vamos criar uma conta no GitHub e customizar o seu profile com um README usando a pŕopria interface do GitHub para criar arquivos e repositórios.
