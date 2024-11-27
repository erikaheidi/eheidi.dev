---
title: Trabalhando com Repositórios no GitHub
description: Aprenda a criar e gerenciar repositórios no GitHub, e a clonar repositórios existentes.
tags: git, iniciantes
index: 3
cover_image: https://cdn.erikaheidi.com/git-github/ptbr03.png
---
Em uma parte anterior desta série, você viu como criar uma conta no GitHub e como personalizar o seu perfil enviando um arquivo README para um repositório especial com o mesmo nome do seu usuário. Fizemos tudo isso através da interface web do GitHub.

Continuando com a nossa série, no tutorial de hoje você vai aprender a trabalhar com repositórios GitHub na sua máquina local, familiarizando-se com o workflow de **pull** \- **commit** \- **push**, usando o seu repositório especial como exemplo. Você fará o download (**pull**) do seu repositório, fará alterações no seu README, e em seguida fará o **commit** e logo em seguida o **push** dessas alterações para o repositório remoto no GitHub.

## Criando uma Chave SSH

Para aumentar a segurança ao trabalhar com repositórios Git remotos, é recomendável configurar uma chave SSH para a comunicação com o GitHub. Se você já tiver uma chave SSH configurada para o seu usuário, pode pular para a próxima etapa.

Você pode criar uma nova chave SSH executando o seguinte comando no seu terminal, substituindo “your\_email@example.com” pelo seu endereço de e-mail real:

```
ssh-keygen -t ed25519 -C "your_email@example.com"
```

Você será solicitado a fornecer o local para salvar sua chave SSH, e uma senha. Você pode usar o local padrão `~/.ssh/id_ed25519`. A senha adiciona maior segurança à sua chave, portanto, não é recomendado deixá-la em branco. Você será solicitado a fornecer essa senha de tempos em tempos para desbloquear sua chave SSH.

Você pode verificar se a chave foi criada observando seu diretório `~/.ssh`:

```
ls -la ~/.ssh
```

```
-rw-------  1 erika erika  464 Sep 23 19:48 id_ed25519
-rw-r--r--  1 erika erika  102 Sep 23 19:48 id_ed25519.pub
```

O arquivo `id_ed25519.pub` é a parte pública da sua chave SSH. Você usará o conteúdo deste arquivo para configurar sua chave SSH no GitHub. O arquivo `id_ed25519` sem extensão é a parte privada da sua chave SSH e **nunca deve ser compartilhada**.

## Adicionando uma Chave SSH à sua Conta no GitHub

Para adicionar sua chave SSH à sua conta no GitHub, acesse o menu “SSH and GPG Keys” nas suas configurações de usuário (menu “Settings” ao clicar no seu avatar no canto superior direito).

![Accessing your SSH and GPG Keys on GitHub](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/pm8xyc09rybcjnvvi2du.png)

Clique no botão "Nova Chave SSH". Na tela que aparece, você será solicitado a fornecer um título para sua chave e o conteúdo da chave pública. Deixe o tipo de chave como "Chave de Autenticação". Se você criou sua chave SSH seguindo as instruções deste guia, você pode obter o conteúdo da chave pública com o seguinte comando:

```
cat ~/.ssh/id_ed25519.pub
```

Copie todo o conteúdo do output e cole no campo “Key” do formulário:  

![Adding a new SSH key to GitHub](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/u9dtpxvqzs2ceqnhayvz.png)

Clique em “Add SSH Key” para confirmar.

Com a chave adicionada, você agora já pode fazer pull (download) de repositórios do GitHub via SSH.

## Clonando um Repositório do GitHub

Agora você vai fazer o download do seu repositório para a sua máquina local, o que lhe permitirá editar o seu arquivo README offline usando um editor de código ou texto da sua preferência. Acesse o seu profile no GitHub e procure pelo seu repositório especial, aquele com o mesmo nome do seu usuário. Você também pode acessar esse repositório diretamente pelo endereço `https://github.com/usuario-login/usuario-login`, onde `usuario-login` é o seu login ou *username* no GitHub.

Clique no botão verde com título “Code”, depois clique na aba “SSH” e selecione o endereço que aparece no campo de texto \- esse enredeço deve começar com `git@`.

![Obtaining the URL of a repository in order to clone it locally](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/hr5swgbqv7ro1wv2n3os.png)

Depois, accesse o seu terminal e faça o clone do repositório na sua máquina local:

```
git clone git@github.com:boredcatmom/boredcatmom.git
```

Você pode ser solicitado a prover a senha para desbloquear a sua chave SSH. Quando o clone for bem sucedido, você deve obter um output similar a este:

```
Cloning into 'boredcatmom'...
remote: Enumerating objects: 3, done.
remote: Counting objects: 100% (3/3), done.
remote: Compressing objects: 100% (2/2), done.
remote: Total 3 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
Receiving objects: 100% (3/3), done.
```

Agora você já pode acessar o repositório diretamente do seu terminal, ou através de um editor de código.

```
❯ ls boredcatmom
README.md
```

## Enviando Alterações para o Repositório Remoto com Git Push

Após finalizar as alterações no seu arquivo README.md, é hora de commitar suas mudanças e depois fazer um push dessas alterações para o repositório remoto. Vamos rever o workflow Git:

[The Git Workflow](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/el6koh0tmntr45en1aca.png)

O processo é similar ao que fizemos no primeiro artigo da série, quando iniciamos um repositório Git vazio e commitamos um arquivo nele. Para ver o status atual do repositório:

```
git status
```

Isso deve indicar que o arquivo `README.md` foi modificado, mas ainda não foi preparado para commit. Para adicionar o arquivo ao estágio de commit, você usuará `git add`:

```
git add README.md
```

Para commitar suas mudanças, use `git commit`:

```
git commit -m "updating readme"
```

Agora você pode finalmente enviar as mudanças para o repositório remoto com um `git push`:

```
git push origin main
```

Você deve obter output similar a este:

```
Enumerating objects: 5, done.
Counting objects: 100% (5/5), done.
Delta compression using up to 8 threads
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 1.36 KiB | 1.36 MiB/s, done.
Total 3 (delta 1), reused 0 (delta 0), pack-reused 0
remote: Resolving deltas: 100% (1/1), completed with 1 local object.
To github.com:boredcatmom/boredcatmom.git
   691417c..26edb28  main -> main
```

Agora, se você fizer um reload do seu profile no GitHub, ele deve refletir as mudanças feitas localmente em seu README.md.

Parabéns\! Você fez o seu primeiro push para um repositório remoto. Agora você já sabe como clonar  um repositório, fazer alterações, e enviar as atualizações de volta para o repositório remoto.

## Criando Repositórios e Conectando Repositórios Locais ao GitHub

Lembre-se do repositório local `testgit` da primeira parte desta série? Aquele repositório não estava conectado a nenhum repositório remoto, então não havia para onde enviar (push). Agora que você tem sua conta GitHub configurada, você pode criar um repositório vazio e conectá-lo ao seu repositório `testgit` local. Em vez de clonar o repositório remoto localmente, você irá configurar seu repositório local existente para usar o repositório remoto GitHub como **upstream**. No contexto do Git e do GitHub, "upstream" ou "origin" refere-se ao repositório original ou principal a partir do qual seu repositório local foi criado e para onde as alterações devem ser enviadas. É por isso que executamos `git push origin main` quando queremos enviar alterações para o branch **main** remota.

Acesse a página principal do GitHub, o seu dashboard. Clique no botão com o sinal `+`, no canto superior direito da tela, e selecione “New repository” para criar um novo repositório.

![Creating a new repository on GitHub](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/ixi69q846zded1cjsxw2.png)

Você será redirecionado para um formulário para criar um novo repositório. Escolha um nome para ele – não precisa ser o mesmo nome do seu repositório git local. Adicione uma descrição se desejar e deixe todos os outros campos desmarcados. Clique no botão verde “Criar repositório” quando estiver pronto.

![Creating a new repository on GitHub - filling the form](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/cj7h0lu5ive8cgb3iin0.png)

Assim que o repositório for criado, e por estar vazio, ele mostrará informações sobre como conectar este repositório à sua configuração Git local. Pegue a URL SSH do repositório, precisaremos dela para configurar seu repositório `testgit` local.  

![New repository page - get SSH URL](https://dev-to-uploads.s3.amazonaws.com/uploads/articles/jn57o8plkbekbhnfw72c.png)

Vá para o terminal e acesse o diretório do repositório que criamos no primeiro artigo dessa série:

```
cd ~/testgit
```

Agora você executará um comando que conectará este repositório a um repositório remoto que agora será a **origem**.

```
git remote add origin git@github.com:boredcatmom/sandbox.git
```

Este comando não fornecerá nenhum output. Para atualizar o repositório remoto e configurar seu repositório local para rastrear a branch principal remota como seu *upstream*, execute:

```
git push -u origin main
```

```
Enumerating objects: 3, done.
Counting objects: 100% (3/3), done.
Writing objects: 100% (3/3), 1.24 KiB | 1.24 MiB/s, done.
Total 3 (delta 0), reused 0 (delta 0), pack-reused 0
To github.com:boredcatmom/sandbox.git
 * [new branch]  	main -> main
branch 'main' set up to track 'origin/main'.
```

Se você recarregar a página do seu repositório no GitHub, agora ele deve ter um único arquivo `readme.txt` que diz “Git Crash Course”. Você copiou efetivamente seu repositório local e todo o seu histórico para o repositório remoto criado no GitHub.

## Conclusão

Neste artigo, você aprendeu como clonar repositórios e enviar suas alterações de volta para o GitHub e também aprendeu como conectar um repositório git local a um repositório GitHub remoto.

Na próxima parte desta série, aprenderemos sobre branches do Git e como colaborar com outros desenvolvedores e trabalhar juntos no mesmo repositório.
