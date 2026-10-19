<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Proprietários</title>
    </head>
    <body>
        <h1>Lista de Proprietários</h1>

        <form method="POST" action="<?= base_url('proprietario') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($proprietario as $PRO): ?>
                <tr>
                    <td><?= $PRO['PRO_NOME'] ?></td>
                    <td><?= $PRO['PRO_DATA_NASCIMENTO'] ?></td>
                    <td><a href="<?= base_url('proprietario/editar/'.$PRO['PRO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('proprietario/excluir/'.$PRO['PRO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('proprietario/novo') ?>"><button>Cadastrar proprietario</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>