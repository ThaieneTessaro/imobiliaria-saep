<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendamentoModel;
use App\Models\ImovelModel;
use App\Models\ProprietarioModel;


class AgendamentoController extends BaseController
{
    // Exibe a listagem de agendamentos
    public function index()
    {
        // Instancia o Model de agendamento
        $model = new AgendamentoModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o termo digitado
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os agendamentos juntamente com
            // informações do imovel e do responsável
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTO.*,
                    IMOVEL.IMO_NOME,
                    PROPRIETARIO.PRO_NOME'
                )

                // Relaciona o agendamento ao imovel
                ->join(
                    'IMOVEL',
                    'IMOVEL.IMO_ID = AGENDAMENTO.FK_IMO_ID'
                )

                // Relaciona o agendamento ao PROPRIETARIO
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = AGENDAMENTO.FK_PRO_ID'
                )

                // Agrupa as condições utilizadas na pesquisa
                ->groupStart()

                    // Pesquisa pelo nome do imovel
                    ->like('IMOVEL.IMO_NOME', $pesquisar)

                    // Pesquisa pelo nome do PROPRIETARIO
                    ->orLike('PROPRIETARIO.PRO_NOME', $pesquisar)

                    // Pesquisa pelo servico
                    ->orLike('AGE_SERVICO', $pesquisar)

                    // Pesquisa pelo status
                    ->orLike('AGE_STATUS', $pesquisar)

                ->groupEnd()

                // Ordena os agendamentos pela data e hora
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os agendamentos
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTO.*,
                    IMOVEL.IMO_NOME,
                    proprietario.PRO_NOME'
                )

                // Relaciona o imovel ao agendamento
                ->join(
                    'IMOVEL',
                    'IMOVEL.IMO_ID = AGENDAMENTO.FK_IMO_ID'
                )

                // Relaciona o responsável ao agendamento
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = AGENDAMENTO.FK_PRO_ID'
                )

                // Ordena pela data e hora do agendamento
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }

        // Carrega a View com os agendamentos encontrados
        return view('sistema/agendamento/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo agendamento
    public function novo()
    {
        // Instancia o Model de imovel
        $imovelModel = new imovelModel();

        // Instancia o Model de responsável
        $proprietarioModel = new proprietarioModel();

        // Busca todos os imovels para preencher o SELECT
        $dados['imovel'] = $imovelModel->findAll();

        // Busca todos os responsáIMOs para preencher o SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Carrega o formulário
        return view(
            'sistema/agendamento/novo_agendamento',
            $dados
        );
    }


    // Insere um novo agendamento
    public function inserir()
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_SERVICO' => $this->request->getPost('servico'),
            'AGE_STATUS' => $this->request->getPost('status'),

            // imovel escolhido no formulário
            'FK_IMO_ID' => $this->request->getPost('imovel'),

            // Responsável escolhido no formulário
            'FK_PRO_ID' => $this->request->getPost('proprietario')
        ];

        // Insere o agendamento no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia os três Models necessários
        $agendamentoModel = new AgendamentoModel();
        $imovelModel = new imovelModel();
        $proprietarioModel = new proprietarioModel();

        // Busca o agendamento pelo ID
        $dados['agendamento'] = $agendamentoModel->find($id);

        // Busca os imovels para preencher o SELECT
        $dados['imovel'] = $imovelModel->findAll();

        // Busca os responsáIMOs para preencher o SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Carrega a View de edição
        return view(
            'sistema/agendamento/editar_agendamento',
            $dados
        );
    }


    // Atualiza um agendamento
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_SERVICO' => $this->request->getPost('servico'),
            'AGE_STATUS' => $this->request->getPost('status'),
            'FK_IMO_ID' => $this->request->getPost('imovel'),
            'FK_PRO_ID' => $this->request->getPost('proprietario')
        ];

        // Atualiza o agendamento no banco
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento atualizado com sucesso!');
    }


    // Exclui um agendamento
    public function excluir($id)
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Exclui o agendamento pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}