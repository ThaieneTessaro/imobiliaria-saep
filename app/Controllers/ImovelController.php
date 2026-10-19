<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietarioModel;
use App\Models\ImovelModel;

// Vincula o imovel com seu respectivo proprietario (FK_PRO_ID)
class ImovelController extends BaseController
{
    // Exibe a listagem de imovel
    public function index()
    {
        // Instancia o Model de imovel
        $model = new ImovelModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os imovels juntamente com o nome do proprietario
            // responsável por cada imovel
            $dados['imovel'] = $model
                ->select('IMOVEL.*, PROPRIETARIO.PRO_NOME')

                // Relaciona imovel com proprietario pela chave estrangeira
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = IMOVEL.FK_PRO_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pelo nome
                    ->like('IMO_NOME', $pesquisar)

                    // Pesquisa pela data de fabricao
                    ->orLike('IMO_DATA_CONSTRUCAO', $pesquisar)

                    // Também permite pesquisar pelo nome do proprietario
                    ->orLike('PROPRIETARIO.PRO_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os imovels
            // juntamente com o nome dos respectivos responsaIMOs
            $dados['imovel'] = $model
                ->select('IMOVEL.*, PROPRIETARIO.PRO_NOME')
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = IMOVEL.FK_PRO_ID'
                )
                ->findAll();
        }

        // Carrega a View de imovel
        return view('sistema/imovel/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo imovel
    public function novo()
    {
        // Instancia o Model de proprietario
        $proprietarioModel = new proprietarioModel();

        // Busca todos os proprietario cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Carrega o formulário de cadastro do veículo
        return view('sistema/imovel/novo_imovel', $dados);
    }


    // Insere um novo imovel
    public function inserir()
    {
        // Instancia o Model de imovel
        $model = new imovelModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'IMO_NOME' => $this->request->getPost('nome'),
            'IMO_DATA_CONSTRUCAO' => $this->request->getPost('data_construcao'),

            // Guarda o ID do proprietario escolhido no formulário
            // como chave estrangeira do imovel
            'FK_PRO_ID' => $this->request->getPost('proprietario')
        ];

        // Insere o imovel no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imovel'))
            ->with('success', 'imovel cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de imovel
        $imovelModel = new imovelModel();

        // Instancia o Model de proprietario
        $proprietarioModel = new proprietarioModel();

        // Busca o imovel que será editado
        $dados['imovel'] = $imovelModel->find($id);

        // Busca todos os responsáIMOs para preencher o SELECT
        $dados['proprietario'] = $proprietarioModel->findAll();

        // Carrega a View de edição
        return view('sistema/imovel/editar_imovel', $dados);
    }


    // Atualiza um imovel
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new imovelModel();

        // Recupera os novos dados do formulário
        $dados = [
            'IMO_NOME' => $this->request->getPost('nome'),
            'IMO_DATA_CONSTRUCAO' => $this->request->getPost('data_construcao'),

            // Guarda o ID do proprietario escolhido no formulário
            // como chave estrangeira do imovel
            'FK_PRO_ID' => $this->request->getPost('proprietario')
        ];

        // Atualiza o imovel pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imovel'))
            ->with('success', 'imovel atualizado com sucesso!');
    }


    // Exclui um imovel
    public function excluir($id)
    {
        // Instancia o Model
        $model = new imovelModel();

        // Exclui o veículo pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imovel'))
            ->with('success', 'imovel excluído com sucesso!');
    }
}