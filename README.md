# Projeto-Integrador-Escoteiros

  Este projeto tem como objetivo principal, o controle de envios de tarefa requisitas pelos Escoteiros aos Lobinhos, como meio de suprir a grande demanda existente pelo Grupo de Escoteiros Guairacá - Foz do Iguaçu.
  
  O Sistema Web também ficará encarregado de registrar a presença dos Lobinhos, nos encontro realizados todo Sábado a tarde pelo grupo.

  Integrantes do grupo:

  -> Guillermo del Toro Trillo - 4° ano TDS - IFPR;
  -> Henry Gabriel Barros Szchaida - 4° ano TDS - IFPR;
  -> Marco Aurélio Dias Souza - 4° ano TDS - IFPR;
  -> Ricardo Augusto da Cruz Troche - 4° ano TDS - IFPR;


{
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

USAR ISSO NO TOPO DA PÁGINA PARA MOSTRAR ERROS
Filtro de encontros:

- Alcateias: coloca o nome da alcateia e busca somente os encontros com a alcateia definida

- Data: teremos dois valores, que definirão um periodo especifico. Tentaremos usar os valores que vem do input, mas se necessario, precisaremos formatar a data 
para o estilo norte americano, e depois de volta ao brasileiro mundial normal de toda a vida na hora de listar;

- input hidden que mantem os parametros da busca,  :D

input text name="filtro1"  value="$dados['filtro1']" 
input text name="filtro2"  value="$dados['filtro2']" 