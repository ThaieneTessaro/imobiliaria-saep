<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Agendamento</title>
    </head>
    <body>
        <h1>Novo Agendamento</h1>

        <form action="<?= base_url('agendamento/inserir') ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" required>
            <br><br>

            <label>Serviço:</label><br>
            <input type="text" id="servico" name="servico" placeholder="Servico..." required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" placeholder="Status..." required>
            <br><br>

            <label>Proprietário:</label><br>
            <select id="proprietario" name="proprietario" required>
                <option value="">Selecione um proprietario</option>
                <?php foreach($proprietario as $PRO): ?>
                    <option value="<?= $PRO['PRO_ID'] ?>">
                        <?= $PRO['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Imóvel:</label><br>
            <select id="imovel" name="imovel" required>
                <option value="">Selecione um imóvel</option>
                <?php foreach($imovel as $IMO): ?>
                    <option value="<?= $IMO['IMO_ID'] ?>">
                        <?= $IMO['IMO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="cadastrar_agendamento" name="cadastrar_agendamento" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('agendamento') ?>"><button>Voltar</button></a>
    </body>
</html>