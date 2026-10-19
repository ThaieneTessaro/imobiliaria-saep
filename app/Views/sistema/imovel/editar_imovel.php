<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Imóveis</title>
    </head>
    <body>
        <h1>Editar Imóveis</h1>

        <form action="<?= base_url('imovel/atualizar/'.$imovel['IMO_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $imovel['IMO_NOME'] ?>" required>
            <br><br>
            <label>Data de Construção:</label><br>
            <input type="date" id="data_construcao" name="data_construcao" value="<?= $imovel['IMO_DATA_CONSTRUCAO'] ?>" required>
            <br><br>

            <label>proprietario:</label><br>
            <select id="proprietario" name="proprietario" required>
                <?php foreach($proprietario as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $imovel['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <input type="submit" id="editar_imovel" name="editar_imovel" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('imovel') ?>"><button>Voltar</button></a>
    </body>
</html>