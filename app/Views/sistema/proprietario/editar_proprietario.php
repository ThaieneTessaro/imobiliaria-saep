<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Proprietário</title>
    </head>
    <body>
        <h1>Editar Proprietário</h1>

        <form action="<?= base_url('proprietario/atualizar/'.$proprietario['PRO_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $proprietario['PRO_NOME'] ?>" required>
            <br><br>
            <label>Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $proprietario['PRO_DATA_NASCIMENTO'] ?>" required>
            <br><br>
            <input type="submit" id="editar_proprietario" name="editar_proprietario" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('proprietario') ?>"><button>Voltar</button></a>
    </body>
</html>