<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ImovelModel extends Model
{
    protected $table = 'IMOVEL'; // nome da tabela
    protected $primaryKey = 'IMO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela PACIENTE do banco
        'IMO_NOME',
        'IMO_DATA_CONSTRUCAO',
        'FK_PRO_ID'
    ];
}