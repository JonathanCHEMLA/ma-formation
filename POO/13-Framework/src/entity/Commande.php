<?php
//src/Entity/Commande.php

namespace Entity;

class Commande
{
    private $id_commande;
    private $id_membre;
    private $montant;
    private $date_enregistrement;
    private $etat;

    /**
     * @return mixed
     */
    public function getId_commande()
    {
        return $this->id_commande;
    }

    /**
     * @param mixed $id_commande
     */
    public function setId_commande($id_commande)
    {
        $this->id_commande = $id_commande;
    }

    /**
     * @return mixed
     */
    public function getId_membre()
    {
        return $this->id_membre;
    }

    /**
     * @param mixed $id_membre
     */
    public function setId_membre($id_membre)
    {
        $this->id_membre = $id_membre;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getDate_enregistrement()
    {
        return $this->date_enregistrement;
    }

    /**
     * @param mixed $date_enregistrement
     */
    public function setDate_enregistrement($date_enregistrement)
    {
        $this->date_enregistrement = $date_enregistrement;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }
}