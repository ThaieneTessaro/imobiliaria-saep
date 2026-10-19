<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietarioModel;

class ProprietarioController extends BaseController
{
    // Exibe a listagem de proprietario
    public function index()
    {
        // Instancia o Model responsável pela tabela proprietario
        $model = new ProprietarioModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca responsaveis que possuem o termo informado
            // no nome ou data de nascimento
            $dados['proprietario'] = $model
                ->like('PRO_NOME', $pesquisar)
                ->orLike('PRO_DATA_NASCIMENTO', $pesquisar)
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os responsaveis cadastrados
            $dados['proprietario'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os responsáveis encontrados
        return view('sistema/proprietario/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo proprietario
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/proprietario/novo_proprietario');
    }


    // Insere um novo proprietario no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new proprietarioModel();

        // Recupera os valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento')
        ];

        // Insere o novo proprietario no banco
        $model->insert($dados);

        // Redireciona para a listagem de proprietario
        return redirect()
            ->to(base_url('proprietario'))
            ->with('success', 'proprietario cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um proprietario
    public function editar($id)
    {
        // Instancia o Model
        $model = new proprietarioModel();

        // Busca o proprietario pelo ID recebido na URL
        $dados['proprietario'] = $model->find($id);

        // Carrega a View de edição enviando os dados do proprietario
        return view('sistema/proprietario/editar_proprietario', $dados);
    }


    // Atualiza os dados de um proprietario
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new proprietarioModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento')
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietario'))
            ->with('success', 'proprietario atualizado com sucesso!');
    }


    // Exclui um proprietario
    public function excluir($id)
    {
        // Instancia o Model
        $model = new proprietarioModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietario'))
            ->with('success', 'proprietario excluído com sucesso!');
    }
}