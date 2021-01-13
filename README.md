# Sistema Confluencia

## Confluencia

Sistema feito em Laravel, é o sistema principal que exibe na tela e também executa as principais funções de tratamento das estratégias

### Endpoints

/ : Chama a função index em ValoresController. Carrega a tela principal em que será mostrada toda a confluencia
/import: Chama a função import em ValoresController. 
/start-import/{source}: Chama a função start_import em ValoresController. 
/candles-data/{source}/{moeda}: Chama a função candles_data em ValoresController. 
/resultado-data/{source}/{moeda}: Chama a função resultado_data em ValoresController.
/processa-estrategia/{source}/{moeda}: Chama a função resultado_data em ValoresController. Chama a função que vai executar o job para processar estrategia 

### Funções em ValoresController

index(): Usa PairsClass e Model Estrategias
candles_data($source,$moeda): Usa as classes Candles<$source>
resultado_data($source, $moeda): Usa as classes Resultado<$source>
import(): Usa as classes PairClass
start_import($source): Usa as classes Input<$source>

### Caminho para estrategia

BeginStrategyProcess (Job) ->  StrategyProcess($this->moeda, $this->source)->run(datahora) -> StrategyRun())->run($candles_list, $dthr, $action)
                                 |-> StrategyDefinition($est->alias, $this->moeda, $dthr, $this->source), PrepareStrategyProcess->makePreparation