# Monitoramento-de-Redes
Sistema para monitoramento de redes - Roteadores

O sistema funciona da seguinte forma:
São cadastrados cada roteador e suas respectativas localizacoes - Neste caso, utilizei o Google MAPS para ilustrar isso.
Este cadastro é realizado num arquivo XML.

O arquivo tarefa.php funciona como um processo realizado em backend e estará sempre incrementando este arquivo XML que é utilizando pela pagina de monitoramento.

A imagem "tarefa-linux" mostra como criar esse tipo de rotina num servidor linux (CentOS). Neste protótipo, a atualizacao do arquivo XML é realizada de 1 em 1 minuto - Executando um comando ping e verificando se o roteador está ativo - Pode ser quaquer coisa que possua um número IP.

O arquivo index.php utiliza o XML para cadastrar os pontos no MAPS e informar, através de um icone (positivo.png ou negativo.png), se o hst encontra-se ativo.

Uma proposta de implementacao seria cadastrar essas informacoes num banco e gerar uma estatistica de quanto tempo o host está ativo antes de uma desconexao.

Então... É isso!!! 
