---
title: Guia de Instalação Ubuntu 24.04
description: Tutorial passo a passo de como instalar o Ubuntu 24.04
tags: ubuntu, iniciantes
index: 10
cover_image: https://onlinux.erikaheidi.com/ubuntu2404/ubuntu2404-guide.png
---

## Como instalar o Ubuntu 24.04 LTS (Noble Numbat)

O mais recente lançamento LTS (suporte de longo prazo) da distribuição Ubuntu Linux chama-se *Noble Numbat*. Neste guia passo a passo com prints de tela, veremos como instalar o Ubuntu 24.04 em um computador ou máquina virtual.

**Preparação**

Antes de prosseguir, certifique-se de baixar o arquivo ISO mais recente do Ubuntu 24.04 em sua [Página de Downloads](https://ubuntu.com/download/desktop).

**Faça backup primeiro!!!**

**Certifique-se** de fazer backup de todos os arquivos importantes se você estiver reinstalando seu sistema como um todo. Seu disco será apagado, portanto, você precisa salvar seus arquivos importantes em outro lugar. Minha ordem de prioridade pessoal ao criar backups é a seguinte:

*   Meu diretório `.ssh` contendo chaves SSH que podem ser configuradas em serviços como o GitHub
*   Meu arquivo `.shrc` ou `.zshrc` com aliases, caminhos e variáveis de ambiente personalizados
*   Minha pasta Documentos
*   Minha pasta Projetos (menos importante, pois tudo está no GitHub)
*   Minha pasta Vídeos e Imagens (só por precaução, já que não guardo fotos e vídeos pessoais aqui)


Isso dependerá inteiramente de como você usa este computador/sistema, mas não se esqueça desses arquivos ocultos e, especialmente, de suas chaves SSH.

**Instalando em um computador comum**

A maneira mais fácil de instalar o Ubuntu 24.04 em um computador comum (PC/Laptop) é usando um disco de inicialização. Você precisará de uma mídia removível para criar um disco de inicialização usando o arquivo ISO que você baixou. [Este guia](https://onlinux.systems/guides/20230515_how-to-create-a-ubuntu-2304-startup-disk-on-ubuntu-systems/) explica como criar tal disco em sistemas Ubuntu, e [este outro guia](https://ubuntu.com/tutorials/install-ubuntu-desktop#3-create-a-bootable-usb-stick) do blog do Ubuntu mostra como criar um disco inicializável em outros sistemas.

Assim que tiver o disco pronto, inicialize o computador com o disco e selecione "Try or Install Ubuntu" quando solicitado. Você entrará no programa de instalação.

**Instalando em uma Máquina Virtual**

Você pode usar este guia para instalar o Ubuntu 24.04 em uma VM do VirtualBox (ou similar). Na verdade, usei uma VM do VirtualBox para tirar os prints deste guia, depois de atualizar meu próprio laptop pessoal com o Ubuntu 24.04.

Para fazer isso, crie uma nova máquina virtual no VirtualBox e selecione o arquivo iso do Ubuntu 24.04 no campo "ISO Image". Em seguida, selecione a opção "Skip unattended installation" para instalar manualmente o Ubuntu 24.04 nesta VM. Se você deixar isso desmarcado, o VirtualBox fará uma instalação automática e pulará o assistente de instalação, portanto, ao iniciar a VM, você entrará em um sistema Ubuntu 24.04 pré-instalado.

![VirtualBox Setup](https://onlinux.erikaheidi.com/ubuntu2404/virtualbox.png)

Selecione pelo menos 1 GB de RAM e 10 GB de espaço em disco ao criar a VM. Assim que estiver pronto, você pode inicializar a VM. Selecione "Try or Install Ubuntu" quando solicitado. Você entrará no programa de instalação.

**Instalando o Sistema**

Para começar, selecione o idioma desejado para a instalação. Aqui vamos usar o inglês (English).
![Ubuntu 24.04 installation step 01](https://onlinux.erikaheidi.com/ubuntu2404/01.png)

A próxima etapa é escolher entre os recursos de acessibilidade, se necessário. Você pode selecionar recursos visuais/auditivos e também configurar as opções do ponteiro do mouse e do zoom. Clique em "avançar" quando estiver pronto.
![Ubuntu 24.04 installation step 02](https://onlinux.erikaheidi.com/ubuntu2404/02.png)

Agora você deve selecionar o layout e a variante do teclado. A escolha mais comum aqui é "Inglês (EUA)", mas você pode ter um layout de teclado diferente dependendo de onde mora. No meu caso, como costumo escrever também em português, para a variante do teclado selecionei "Inglês (EUA, alt international)" pois é o que funciona para mim. Você pode usar a caixa de entrada para testar seu teclado e garantir que quaisquer caracteres especiais funcionem conforme o esperado.
![Ubuntu 24.04 installation step 03](https://onlinux.erikaheidi.com/ubuntu2404/03.png)

O próximo passo é conectar-se à Internet, o que é opcional. No meu caso, eu estava instalando o Ubuntu em uma máquina virtual com o VirtualBox, então uma rede ainda não estava disponível e é por isso que escolhi "Não conectar à internet". Para instalações regulares de desktop, recomendo que você se conecte à sua rede para poder baixar atualizações e drivers de terceiros durante o processo de instalação.
![Ubuntu 24.04 installation step 04](https://onlinux.erikaheidi.com/ubuntu2404/04.png)

Em seguida, selecione "Install Ubuntu" para prosseguir com o processo de instalação. Se preferir experimentar o Ubuntu primeiro, sem fazer modificações no seu sistema atual, pode escolher "Try Ubuntu".
![Ubuntu 24.04 installation step 05](https://onlinux.erikaheidi.com/ubuntu2404/05.png)

Agora você deve selecionar "Interactive Installation" para prosseguir. A opção de instalação automatizada é para usuários avançados que já possuem um script para repetir o processo de instalação em várias máquinas. Clique em "next" para continuar.
![Ubuntu 24.04 installation step 06](https://onlinux.erikaheidi.com/ubuntu2404/06.png)

Aqui você pode escolher entre uma seleção padrão de aplicativos essenciais ou uma seleção extendida de aplicativos, incluindo ferramentas de office. Recomendo escolher a seleção padrão e instalar o que você precisa após a conclusão da instalação do sistema. Clique em "next" quando estiver pronto para prosseguir.
![Ubuntu 24.04 installation step 07](https://onlinux.erikaheidi.com/ubuntu2404/07.png)

Em seguida, você deve selecionar se deseja instalar software de terceiros, como drivers proprietários e formatos de mídia adicionais. Marque ambas as opções e continue clicando em "next".
![Ubuntu 24.04 installation step 08](https://onlinux.erikaheidi.com/ubuntu2404/08.png)

Agora você selecionará como deseja instalar o Ubuntu. Para instalações de sistema completo (recomendado), marque a primeira opção "Erase Disk and Install Ubuntu" (Apagar disco e instalar o Ubuntu). Antes de continuar, no entanto, recomendo fortemente habilitar a **criptografia de disco**, para uma camada adicional de segurança para seus arquivos e sistema. Clique no botão "Advanced Features" (Recursos avançados) e você verá uma janela pop-up com algumas opções a mais.
![Ubuntu 24.04 installation step 09](https://onlinux.erikaheidi.com/ubuntu2404/09.png)

Selecione "Use LVM and encryption" (Usar LVM e criptografia) e clique no botão "Ok" para confirmar. Em seguida, clique no botão "next" para continuar com a instalação.
![Ubuntu 24.04 installation step 10](https://onlinux.erikaheidi.com/ubuntu2404/10.png)

Em seguida, você será solicitado a fornecer uma senha para a criptografia do disco (caso você tenha selecionado esse recurso). Isso é **extremamente importante**, pois você não conseguirá acessar seus arquivos se esquecer a senha. Você será solicitado a fornecer essa senha toda vez que inicializar o sistema. Certifique-se de que seja uma senha forte e que você não esquecerá.
![Ubuntu 24.04 installation step 11](https://onlinux.erikaheidi.com/ubuntu2404/11.png)

Após configurar sua senha, clique em "Next" para continuar com a instalação.
![Ubuntu 24.04 installation step 12](https://onlinux.erikaheidi.com/ubuntu2404/12.png)

Em seguida, você será solicitado a configurar sua conta de usuário. Escolha um nome de usuário e um nome de host para este sistema e, em seguida, configure uma senha. Para aumentar a segurança, certifique-se de que a opção "Require my password to log in" (Exigir minha senha para fazer login) esteja selecionada. Clique no botão "Next" para continuar.
![Ubuntu 24.04 installation step 13](https://onlinux.erikaheidi.com/ubuntu2404/13.png)

Agora você será solicitado a selecionar seu fuso horário. Isso pode ser pré-selecionado para você com base na sua rede. Clique em "Next" para concluir o assistente de instalação.
![Ubuntu 24.04 installation step 14](https://onlinux.erikaheidi.com/ubuntu2404/14.png)

Agora você deverá ver a tela de instalação do Ubuntu 24.04, enquanto o programa de instalação copia todos os arquivos de origem e configura seu novo sistema.
![Ubuntu 24.04 installation step 15](https://onlinux.erikaheidi.com/ubuntu2404/15.png)

Quando a instalação terminar, você será solicitado a remover o disco de boot e reiniciar o computador. Assim que a inicialização for concluída, você será solicitado a fornecer a senha para descriptografar o disco e iniciar o Ubuntu. Em seguida, você acessará a tela de login, onde deverá fornecer a senha que você criou para seu usuário para fazer login. Seu Ubuntu foi instalado com sucesso! Agora você pode personalizar sua aparência e instalar novos softwares.
![Ubuntu 24.04 installation step 16](https://onlinux.erikaheidi.com/ubuntu2404/16.png)

**Personalizando a Aparência e a Dock**

Para personalizar seu papel de parede e outras configurações de aparência, clique com o botão direito do mouse na área de trabalho e escolha "Change Background" (Alterar Plano de Fundo) no menu. Nesta tela, você pode alterar o plano de fundo e o estilo do tema (claro/escuro e a cor de destaque).
![Ubuntu 24.04 installation step 17](https://onlinux.erikaheidi.com/ubuntu2404/17.png)

Para alterar a aparência da Dock, vá para o item "Ubuntu Desktop" no menu esquerdo. Eu, pessoalmente, prefiro ter a dock na parte inferior da tela e com a opção de ocultar automaticamente ativada. Estas são as minhas alterações:

- Auto-Hide Dock - habilitado
- Panel Mode - desabilitado
- Icon Size - tamanho máximo
- Position on Screen - Bottom

E este é o resultado final, do jeito que eu gosto =)

![Ubuntu 24.04 installation step 18](https://onlinux.erikaheidi.com/ubuntu2404/18.png)

A partir de agora, você pode começar a instalar novos programas. Além disso, não se esqueça de restaurar seus backups.
![Ubuntu 24.04 installation step 16](https://onlinux.erikaheidi.com/ubuntu2404/19.png)

**Recursos Adicionais Sugeridos (em inglês):**

- [Como Instalar e Configurar o Terminator + Oh My Zsh!](https://onlinux.systems/guides/20230523_how-to-install-and-set-up-terminator-and-oh-my-zsh-on-ubuntu-2304/) - este guia foi feito para o Ubuntu 23.04, mas ainda funciona perfeitamente no Ubuntu 24.04!
- [Guia de configuração inicial da área de trabalho para Ubuntu 23.04](https://onlinux.systems/guides/20230522_initial-desktop-setup-guide-for-ubuntu-2304/) - mais algumas dicas sobre por onde começar após uma nova instalação do Ubuntu.

