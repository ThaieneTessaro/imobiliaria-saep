<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Imóvel</title>
    </head>
    <body>
        <h1>Novo Imóvel</h1>
        <form action="<?= base_url('imovel/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>
            
            <label>Data de Construção:</label><br>
            <input type="date" id="data_construcao" name="data_construcao" required>

            <br><br>

            <label>Proprietário:</label><br>
            <select id="proprietario" name="proprietario" required>
                <option value="">Selecione um proprietário</option>
                <?php foreach($proprietario as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>">
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <input type="submit" id="cadastrar_imovel" name="cadastrar_imovel" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('imovel') ?>"><button>Voltar</button></a>
    </body>
</html>