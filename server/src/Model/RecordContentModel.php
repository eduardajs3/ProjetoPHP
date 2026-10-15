<?php

namespace App\App\Model;

use PDO;
use PDOException;

class RecordContentModel
{
    private $id;
    private $pacient_id;
    private $nutritionist_id;
    private $doc_orientation;
    private $doc_plano_alimentar;
    private $doc_receita;
    private $doc_suplementacao;
    private $consulta_id;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getPacientId()
    {
        return $this->pacient_id;
    }
    public function setPacientId($pacient_id)
    {
        $this->pacient_id = $pacient_id;
    }
    public function getNutritionistId()
    {
        return $this->nutritionist_id;
    }
    public function setNutritionistId($nutritionist_id)
    {
        $this->nutritionist_id = $nutritionist_id;
    }
    public function getDocOrientation()
    {
        return $this->doc_orientation;
    }
    public function setDocOrientation($doc_orientation)
    {
        $this->doc_orientation = $doc_orientation;
    }
    public function getDocPlano_alimentar()
    {
        return $this->doc_plano_alimentar;
    }
    public function setDocPlano_alimentar($doc_plano_alimentar)
    {
        $this->doc_plano_alimentar = $doc_plano_alimentar;
    }
    public function getDocReceita()
    {
        return $this->doc_receita;
    }
    public function setDocReceita($doc_receita)
    {
        $this->doc_receita = $doc_receita;
    }
    public function getDocSuplementacao()
    {
        return $this->doc_suplementacao;
    }
    public function setDocSuplementacao($doc_suplementacao)
    {
        $this->doc_suplementacao = $doc_suplementacao;
    }
    public function getConsultaId()
    {
        return $this->consulta_id;
    }
    public function setConsultaId($ConsultaId)
    {
        $this->consulta_id = $ConsultaId;
    }
}
