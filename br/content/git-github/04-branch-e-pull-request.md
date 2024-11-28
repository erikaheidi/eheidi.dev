---
title: Trabalhando com Branches e Pull Requests
description: Aprenda a trabalhar com branches e como criar, aprovar, a fazer o merge de pull requests no GitHub.
tags: git, iniciantes
index: 4
cover_image: https://cdn.erikaheidi.com/git-github/ptbr04.png
---

## Git Branches: Visão Geral

As “branches” (do inglês *branch*: galho ou ramificação) são um recurso essencial do sistema de controle de versão Git. Elas permitem que desenvolvedores trabalhem em diferentes versões de um projeto simultaneamente sem afetar a sua branch principal, e sem intereferir no trabalho uns dos outros. Ao criar uma branch para cada tarefa ou nova feature, pessoas desenvolvedoras podem trabalhar de forma independente, submetendo as alterações de volta à branch principal quando estiverem prontas. As branches também facilitam o tracking ou rastreamento de alterações e a reversão (rollback) para versões anteriores do código, se necessário.

![Working with Git Branches, a visual representation of branching](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/klq8rssetaq7arzgtwkr.png)

Até agora, trabalhamos apenas na branch **main**. É uma convenção usar a **main** como branch padrão, onde a versão mais atualizada de um projeto pode ser encontrada. O desenvolvimento ativo normalmente ocorre em branches separadas que posteriormente são “mergeadas” na main. Novas versões (releases) de software também são normalmente baseados na branch principal, embora seja possível manter várias branches com diferentes versões de um software.

## O Workflow do Pull Request

No capítulo anterior desta série, você clonou um repositório Git remoto, fez alterações e enviou as alterações de volta diretamente para a branch principal **main**. Em um fluxo de trabalho colaborativo, você faria alterações em uma branch separada (por exemplo, `readme-updates`), enviaria essa branch para o repositório remoto através de um **push** e, em seguida, abriria um **pull request** (**PR**) para solicitar que sua branch `readme-updates` fosse mergeada com a branch principal. Outro colaborador poderia então revisar seu pull request antes que as alterações fossem mescladas. O GitHub oferece várias ferramentas e até mesmo assistência de IA para revisões de pull requests, o que pode ser muito útil ao trabalhar em equipe.

Se você está apenas começando e trabalha sozinho em um projeto, pode se perguntar por que deveria se preocupar com pull requests. Aqui estão algumas razões pelas quais se torna vantajoso praticar este fluxo de trabalho como pessoa iniciante:

* Melhor compreensão de como funcionam branches e merges
* Preparação para contribuir com código em projetos existentes
* Familiarização com o processo de revisão e aprovação de pull requests

Sem dúvida, o GitHub se destaca como a principal plataforma de compartilhamento de código do mercado, tornando imperativo que você se familiarize com seus fluxos de trabalho e recursos diversos. É muito provável que você precise usar essa plataforma eventualmente, seja para trabalho ou para fins acadêmicos. Portanto, começar cedo pode lhe dar uma vantagem que outros não têm.

## Criando o seu Primeiro Pull Request

Agora, vamos repetir o que fizemos no artigo anterior, onde enviamos algumas alterações para o README do seu perfil diretamente da sua máquina local. Desta vez, no entanto, trabalharemos em uma branch separada e enviaremos essa branch para o upstream. Em seguida, você abrirá um pull request para aprender como isso funciona.

Se, por algum motivo, você não tiver o projeto em sua máquina local, comece clonando o repositório. Você pode obter a URL SSH para o repositório na página do projeto no GitHub, clicando no botão verde com a legenda "Code". A URLs SSH em Git seguem este padrão: `git@github.com:username/repository.git`. Depois de obter essa URL, execute `git clone` em seu diretório home e, em seguida, acesse a pasta recém-criada:

```
git clone git@github.com:boredcatmom/boredcatmom.git
cd boredcatmom
```

Se você seguiu os guias anteriores, deve ter um único arquivo `README.md` em seu repositório. Agora você criará uma nova branch baseada na **main** antes de começar a fazer alterações em seu arquivo. Para fazer isso, execute o seguinte comando:

```
git checkout -b readme-updates
```

```
Switched to a new branch 'readme-updates'
```

O comando `git checkout` é usado para alternar entre branches. Para criar uma nova branch, use o parâmetro `-b`. Se o branch já existir, use apenas `git checkout nome-da-branch` para fazer a troca.

Agora faça algumas alterações no arquivo. Quando terminar, prossiga com o fluxo de trabalho de adicionar arquivos ao stage e commitar as alterações:

```
git add README.md
git commit -m "updted"
```

```
[readme-updates 8c8f620] updted
 1 file changed, 1 insertion(+), 1 deletion(-)
```

Agora, envie as alterações para o upstream. Em vez de fazer o push para a branch `main`, você enviará seus commits para uma branch com o mesmo nome da sua branch local:

```
git push origin readme-updates
```

Você deve obter um output similar ao seguinte:

```
Enumerating objects: 5, done.
Counting objects: 100% (5/5), done.
Delta compression using up to 8 threads
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 1.31 KiB | 1.31 MiB/s, done.
Total 3 (delta 1), reused 0 (delta 0), pack-reused 0
remote: Resolving deltas: 100% (1/1), completed with 1 local object.
remote:
remote: Create a pull request for 'readme-updates' on GitHub by visiting:
remote:  	https://github.com/boredcatmom/boredcatmom/pull/new/readme-updates
remote:
To github.com:boredcatmom/boredcatmom.git
 * [new branch]  	readme-updates -> readme-updates
```

Como você pode notar no output do comando, há uma URL especial que você pode acessar para criar um pull request baseado nessa branch. Você também pode simplesmente acessar a página do seu repositório no GitHub e uma caixa de diálogo proeminente aparecerá perguntando se você deseja criar uma pull request com base na nova branch que acabou de ser enviada:

![Repository with unmerged changes](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/ck0dlhi5gjuhazihz3sa.png)

Clique em “Compare & pull request” para abrir o formulário do pull request. Você verá uma página como essa:  

![pull request form](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/7jompe69vo31bnzbdbrz.png)

A caixa de seleção na parte superior da tela permite que você selecione a branch de origem e a branch de destino para o pull request. Normalmente você não precisará mudar isso. O formulário de PR usa sua mensagem de commit como título e tem uma área de texto para você descrever as alterações que está propondo e adicionar qualquer informação relevante para ajudar a testar e revisar o pull request.

A área inferior do formulário de pull request mostra uma visualização **diff** das alterações neste branch em comparação com a `main`. As linhas destacadas em vermelho são linhas removidas e as linhas destacadas em verde são novas adições ao arquivo.

Clique no botão verde “Create pull request” para criar o PR. Você será redirecionado para a página do pull request recém-criado:

![pull request page](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/9av2km6epjp5ozttq63z.png)

Parabéns! 🎉 Você criou o seu primeiro pull request.

### Revisando um Pull Request

O processo de revisão de um pull request varia muito dependendo do projeto, empresa e/ou equipe. Em geral, você deve acessar a aba "Files changed" da página do pull request, onde poderá encontrar todos os arquivos alterados com um diff completo que permite visualizar rapidamente o que foi alterado naquele PR.

A interface do GitHub permite fazer comentários e sugestões diretamente na aba "Files Changed". Clique no sinal de `+` azul que aparece em cada linha (quando você passa o mouse sobre aquele pequeno espaço entre o número da linha e o início da linha) para abrir o formulário de comentários/sugestões:

![suggesting changes](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/j6oj0zjevmlohiffl1nz.png)

Para aprovar ou solicitar alterações em um pull request, clique no botão verde "Review Changes" no canto superior direito para acessar o formulário de aprovação de PR. Como os autores de PR não podem aprovar seus próprios pull requests, você não poderá usar o formulário para revisar seu próprio PR, pois pode fazer o merge diretamente na branch principal quando estiver pronto.

![pr approval](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/fxpbmqevkymn3upjphav.png)

O GitHub possui configurações de segurança que permitem “travar” a branch main e só permitir alterações via pull request, que só podem ser aceitos mediante aprovação de um dos colaboradores do projeto. Essas restrições são muito úteis para aumentar a segurança e a confiabilidade tanto em projetos corporativos quanto em projetos de código aberto, garantindo um processo de revisão cuidadosa antes de permitir que mudanças sejam aplicadas à branch principal. Naturalmente, esse workflow requer que múltiplas pessoas estejam trabalhando em um projeto, já que o autor de um pull request não pode aprovar o seu próprio PR.

### Fazendo o Merge de um Pull Request

Quando o PR estiver pronto para ser mergeado e não houver problemas como conflitos de alterações, você pode clicar no botão verde "Merge pull request" e o GitHub fará o merge do pull request em sua branch **main**.

![merging a pull request](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/74uidz3cgezltccvx3bx.gif)

### Atualizando sua Cópia Local do Repositório

Quando pull requests são mergeados através da interface do GitHub, um novo commit é criado na branch principal, carregando as alterações que foram assimiladas. Sua cópia local do repositório estará desatualizada, com a branch **main** ainda apontando para um commit anterior. Você deve fazer um *pull* para trazer as alterações para sua cópia l ocal do repositório.

Para começar, faca o switch para a branch `main`:

```
git checkout main
```

O comando seguinte fará o download das alterações mais recentes da branch `main`, sincronizando sua cópia local do repositório com o que está disponível no GitHub:

```
git pull origin main
```

Isso vai garantir que quaisquer alterações adicionais feitas por outros autores ou diretamente da interface do GitHub sejam puxadas para o seu repositório local. Você deve receber um output semelhante a este:

```
remote: Enumerating objects: 1, done.
remote: Counting objects: 100% (1/1), done.
remote: Total 1 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
Unpacking objects: 100% (1/1), 885 bytes | 885.00 KiB/s, done.
From github.com:boredcatmom/boredcatmom
 * branch        	main   	-> FETCH_HEAD
   26edb28..d42543d  main   	-> origin/main
Updating 26edb28..d42543d
Fast-forward
 README.md | 2 +-
 1 file changed, 1 insertion(+), 1 deletion(-)
```

Se você executar `git log`, poderá confirmar que a sua branch local **main** agora aponta para o commit mais recente do repositório, que foi o merge executado diretamente pela interface do GitHub com a aprovação do pull request que trouxe as alterações da branch `readme-updates`.

```
commit d42543de4d1ed7ec2c96c35500986ac882b94f3d (HEAD -> main, origin/main, origin/HEAD)
Merge: 26edb28 8c8f620
Author: boredcatmom <boredcatmom@hotmail.com>
Date:   Tue Nov 19 15:20:33 2024 +0100

	Merge pull request #1 from boredcatmom/readme-updates
    
	Updated
```

É importante manter a sua branch main sempre atualizada com o que está disponível upstream, para evitar conflitos de merge e outros problemas.

### Enviando Pull Requests para Projetos de Terceiros

Ao trabalhar em projetos de outras pessoas em plataformas como o GitHub, você geralmente precisará fazer um **fork** (do inglês fork \= bifurcar) do repositório para sua conta antes de poder fazer alterações. Isso ocorre porque você não tem acesso direto de **escrita** no repositório original.

Fazer um fork de um repositório cria uma cópia do repositório original em sua conta. Você pode então fazer alterações em sua cópia do projeto sem afetar o original. Quando terminar de fazer alterações, você pode enviar um pull request para o repositório original. Isso notificará o proprietário do repositório original de que você tem alterações que gostaria que eles considerassem mergear no repositório de origem.

Para mais informações sobre o processo de fazer o fork de um repositório, acesse a [documentação oficial do GitHub](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/working-with-forks/fork-a-repo).

## Apêndice: Conflitos de Merge e Erros Comuns

Apesar de seus comandos aparentemente simples, o Git pode ser bastante complicado às vezes. Sua complexidade decorre da intrincada rede de branches, commits e merges que ele gerencia. Vamos revisar problemas comuns neste breve apêndice.

### Conflitos de Merge

Um conflito de merge ocorre quando você tenta fazer o merge de duas branches que têm alterações conflitantes no mesmo arquivo. Isso pode acontecer quando vários desenvolvedores estão trabalhando no mesmo arquivo ao mesmo tempo e fazem alterações que se sobrepõem. Embora seja um pouco irritante, conflitos de merge são uma ocorrência muito comum no mundo Git, então não há nada a temer.

Quando ocorre um conflito de merge, o Git interrompe o processo de merge e exibe uma mensagem indicando quais arquivos têm conflitos. Você precisará resolver os conflitos manualmente antes de poder continuar com o merge. Conflitos de merge também impedem que os mantenedores usem a interface do GitHub para fazer merge de pull requests, exigindo intervenção manual.

O Git adiciona marcadores especiais em arquivos conflitantes para que você possa identificar as diferenças e escolher qual versão manterá. Depois de terminar as alterações, você pode continuar com o processo de merge.

A [documentação oficial do GitHub](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/addressing-merge-conflicts/about-merge-conflicts) contém informações detalhadas e várias dicas para auxiliar na resolução de conflitos de merge.

### Erros Comuns ao Trabalhar com o Git

Todos nós já cometemos esses erros antes, e nada garante que não vamos cometê-los novamente\! Esses erros comuns podem causar problemas como conflitos de merge, inconsistência de dados ou riscos de segurança.

* **Enviar para a branch errada:** Se você tentar enviar sua branch local para uma branch remota que não corresponde ao seu histórico, provavelmente receberá uma mensagem de erro de escrita ou poderá acabar com vários conflitos de merge.
* **Esquecer de adicionar arquivos à área de staging:** Você só pode criar um commit se tiver arquivos em staging. Além disso, esteja atento ao que você está adicionando ao repositório. Você pode usar um arquivo `.gitignore` para listar arquivos que devem ser ignorados pelo Git.
* **Excluir ou sobrescrever arquivos acidentalmente:** Pode acontecer de você excluir um arquivo local por engano e acidentalmente confirmar essa alteração no repositório. Por isso é importante prestar atenção ao que está em stage (com `git status`) antes de criar seus commits.
* **Fazer commit acidental de arquivos com informações confidenciais:** Isso pode representar um sério risco de segurança para um projeto ou usuário. Arquivos com informações confidenciais, como senhas e tokens, nunca devem ser enviados para o repositório. Adicione todos os arquivos com dados confidenciais ao seu `.gitignore`.
* **Enviar alterações locais sem antes fazer pull das alterações remotas:** O resultado mais provável de enviar alterações locais sem antes fazer pull das atualizações é um conflito de merge. Lembre-se sempre de atualizar suas branches locais antes de fazer um push para a origem.
* **Esquecer de enviar as alterações para o repositório remoto:** Às vezes, simplesmente esquecemos de enviar as alterações para o repositório. Não é um grande problema, mas é uma coisa muito comum de acontecer 🙂

## Conclusão

Neste guia, você aprendeu sobre branches e o poderoso fluxo de trabalho do Pull Request. Viva\! Agora você tem as ferramentas básicas para começar a construir sua presença no GitHub e contribuir para projetos de código aberto, se isso for algo do seu interesse. Programar definitivamente pode ser mais divertido com amigos e, felizmente para nós, o GitHub é uma excelente plataforma para construirmos projetos juntos.

Com isso, nosso Curso Relâmpago de Git e GitHub chega ao fim. Aqui estão alguns recursos que você pode consultar se quiser saber mais sobre Git e GitHub:

* [Documentação Oficial do GitHub](https://docs.github.com/en)
* [Documentação Oficial do Git](https://git-scm.com/doc)
* [Learn Git Branching](https://learngitbranching.js.org/) - ferramenta educacional interativa
