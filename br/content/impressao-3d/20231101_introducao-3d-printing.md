---
title: Uma Introdução à Impressão 3D
published: true
description: A impressão 3D refere-se a uma variedade de processos nos quais uma máquina controlada por computador cria objetos tridimensionais unindo ou solidificando material, tipicamente camada por camada, até que o objeto inteiro esteja completo.
cover_image: https://cdn.erikaheidi.com/3dprinting/introduction.png
tags: 3dprinting, beginners, openscad
---

## Introdução
A impressão 3D refere-se a uma variedade de processos nos quais uma máquina controlada por computador cria objetos tridimensionais unindo ou solidificando material, tipicamente camada por camada, até que o objeto inteiro esteja completo. A impressão 3D também costuma ser chamada de _fabricação aditiva_ (additive manufacturing).

{% youtube V2tHqbPjb3k?si=eiXa_MB30R12pTlT&amp;clip=Ugkx1FfVL_tkjF0-mnH2j2imywWUwNncWvLv&amp;clipt=EPbhBRimzAc %}

Embora os primeiros anos da tecnologia parecessem indicar que a impressão 3D era um processo caro e adequado apenas para protótipos estéticos, a tecnologia por trás da impressão 3D aditiva evoluiu em uma escala impressionante nos últimos anos, diminuindo barreiras e tornando-a mais popular e acessível para usuários finais.

## Por que Impressão 3D?
A impressão 3D abre um novo mundo para pessoas que gostam de projetos DIY (do it yourself, ou "faça você mesmo") e para criadores porque reduz as barreiras em torno da criação de protótipos originais. Mas a impressão 3D não é útil apenas para criar protótipos; você pode usá-la para consertar coisas em sua casa, criar ferramentas úteis e adaptadores com diferentes materiais, decorar, e criar brinquedos divertidos e originais para seus filhos.

A parte mais empolgante é que você pode baixar milhares de modelos existentes gratuitamente em sites como [Printables](https://printables.com/@erikaheidi), e você sempre pode criar seus próprios designs exclusivos com software 3D e até mesmo usando código!

![Printables models](https://cdn.erikaheidi.com/blog/3dprinting/erikaheidi_printables.png)
_Alguns dos meus modelos [disponíveis gratuitamente no Printables.com](https://www.printables.com/@erikaheidi/collections/1180456). Todos esses foram criados com o Nomad Sculpt._

## Como Funciona
Existem diferentes métodos de impressão 3D, mas vamos focar na impressão 3D FDM porque é a mais popular atualmente.
FDM significa Modelagem por Fusão e Deposição (Fused Deposition Modeling), o que na prática quer dizer que um fluxo contínuo de material derretido (geralmente um filamento de plástico) é extrudado através de um bico de impressão e se solidifica imediatamente, fundindo-se com as camadas já existentes na placa de impressão.

É um processo lento, mas os resultados podem ser impressionantes. O seguinte vídeo em timelapse dá uma ideia melhor de como funciona. Essa impressão levou cerca de 20 horas para ser completada na Prusa MK3S:
[Link para o vídeo em timelapse]

## Escolhendo uma Impressora 3D
Existem muitos fabricantes oferecendo impressoras 3D em diferentes faixas de preço, de algumas centenas a alguns milhares de dólares (ou reais!). Dito isso, para nossa primeira impressora 3D, escolhemos a Prusa MK3 em kit, e ficamos muito felizes com ela. Esse modelo parou de ser comercializado recentemente, em favor do novo modelo [MK4](https://www.prusa3d.com/product/original-prusa-mk4-2/?p2p=%40erikaheidi) que acabamos adquirindo também. Mas dessa vez, escolhemos a impressora montada, pois queríamos a conveniência de uma experiência "plug and play", e foi realmente isso que tivemos - com a impressora montada, só precisamos tirar da caixa e ligar na tomada. Ela passou por um processo de autocalibramento, e já estava pronta pra imprimir em pouco tempo.

Outra opção popular da mesma fabricante é a [Prusa Mini](https://www.prusa3d.com/product/original-prusa-mini-kit-2/?p2p=%40erikaheidi), que tem uma área de impressão menor e um custo mais acessível.

## Kit ou Montada?
Se você quer algo “plug and play”, pode considerar comprar uma impressora já montada. Elas são mais caras, mas você economiza muito tempo e esforço – mesmo com a melhor documentação, para iniciantes ainda é um pouco difícil montar tudo corretamente.

Mas definitivamente é possível montar você mesmo, com paciência e seguindo as instruções atentamente. Se você quer economizar algum dinheiro e não está com pressa (ou seja: você terá tempo e paciência para montar tudo com cuidado), recomendo optar pelo kit.

Como mencionei anteriormente, para nossa primeira impressora, escolhemos a Prusa MK3. A melhor coisa sobre montar o kit é que isso te ensina bastante sobre a máquina. Você passa a ter um entendimento melhor de como ela funciona, mecanicamente falando. Se algo quebrar ou se algo não parecer certo, você estará melhor equipado para entender o que aconteceu e talvez consertar.

Por outro lado, quando tivemos a chance de atualizar para o modelo mais recente, decidimos pela impressora pré-montada para economizar tempo e ter a garantia de que tudo está otimizado de fábrica para os melhores resultados possíveis.

![Original Prusa MK4 assembled printer](https://cdn.erikaheidi.com/blog/3dprinting/mk4.jpg)
_Ela veio assim na caixa!_

## Filamento para Impressão 3D

Para imprimir algo com uma impressora 3D, você precisará de filamento para impressão 3D. Estes são normalmente vendidos em rolos e medidos em peso (rolos de 1 kg, rolos de 500 g...). Existem muitas marcas e materiais diferentes, sendo o PLA o mais popular.

O PLA normalmente é o material mais simples de imprimir. Outros materiais, como o ABS, podem ser bastante difíceis de imprimir, exigindo condições especiais como uma temperatura ambiente estável e uma base de impressão muito quente. Uma outra vantagem do PLA é a diversidade em opções de cores e acabamentos (perolado, glitter, fosco...), que é sempre bem maior do que outros tipos de filamento.

![3D Printing filament](https://cdn.erikaheidi.com/blog/3dprinting/filament.jpg)

Outra boa opção que imprime com facilidade e oferece uma resistência muito maior que o PLA é o PETG. O PETG é adequado para coisas que não devem quebrar facilmente e para peças que devem suportar temperaturas mais altas ou simplesmente ficar expostas ao ar livre.

Outros materiais incluem filamento flexível, filamento com infusão de cobre (também outros metais), fibra de carbono e muito mais. Estes são normalmente mais difíceis de imprimir e servem a propósitos especiais.

## Software para Design 3D
Para criar modelos originais, precisamos de um software de design 3D - há muitos para escolher. Desde softwares do tipo CAD como o [FreeCAD](https://www.freecad.org/), passando por softwares de modelagem mais "artítica" como o [Nomad Sculpt](https://nomadsculpt.com/), e até os mais complexos como o [Blender](https://www.blender.org/), que também pode ser usado para animação.

![FreeCad interface](https://cdn.erikaheidi.com/blog/3dprinting/freecad.png)
_O FreeCAD permite criar objetos parametrizados usando variáveis e funções._

Ainda mais interessante é usar **código** para criar modelos 3D. Você pode fazer isso com o [OpenScad](https://openscad.org/), um software de código aberto para a criação de modelos 3D através de programação. Isso permite que você crie objetos 3D personalizáveis!

## Software de Impressão 3D
A impressão 3D requer um software especial para transformar os arquivos STL que baixamos de sites como o [Printables](https://printables.com) em código GCODE, que é compreendido pela sua impressora 3D. O processo de transformar um STL em GCODE é chamado de "slicing" ou fatiamento. Um programa popular de fatiamento é o Slic3r. Existe também o PrusaSlicer para quem possui impressoras Prusa, originais ou derivadas.

![PrusaSlicer](https://cdn.erikaheidi.com/blog/3dprinting/slicer.png)
_O PrusaSlicer é o software de fatiamento para impressoras Prusa. O software de fatiamento (slicing) tem esse nome pois divide o modelo em várias camadas (layers) que vão variar de espessura dependendo da qualidade da impressão._


## Concluindo

A impressão 3D está cada vez mais acessível, criando um novo mundo de possibilidades para designers e _makers_. Sites como o [Printables](https://printables.com) oferecem uma grande biblioteca de modelos gratuitos, e criam uma experiência mais comunitária com recompensas e badges que incentivam a participação dos usuários postando seus _makes_ e também modelos ou variações (que são chamadas de _remix_). 

Gostou de algo em particular, ou gostaria de saber mais sobre um dos tópicos desse post? Manda sua pergunta ou sugestão [lá no Xwitter](https://twitter.com/erikaheidi) :) 
