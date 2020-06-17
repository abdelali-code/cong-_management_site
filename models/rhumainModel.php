<?php 
    class RhumainModel extends Database {
        public function __construct() {
            // Session::init();
            parent :: __construct();
        }
        public function loadDemande() {
            $stm = $this->db->prepare("SELECT users.firstName, users.lastName, users.CIN, demande.decision, conge.*
             from (users JOIN demande ON(users.CIN = demande.user_cin)) JOIN conge ON (conge.numero=demande.conge_numero)
              WHERE decision = 'not yet'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }
        // accept demande 
        public function acceptDemande($numero) {
            $query = "UPDATE demande, conge SET decision = 'accepté' WHERE conge_numero = numero AND numero = $numero";
            $stm = $this->db->prepare($query);
            $stm->execute();

            if ($stm) {
                echo true;
            }else {
                echo false;
            }
        }

        // refuser a demande
        public function refuseDemande($numero) {
            $query = "UPDATE demande, conge SET decision = 'refusé' WHERE conge_numero = numero AND numero = $numero";
            $stm = $this->db->prepare($query);
            $stm->execute();

            if ($stm) {
                echo true;
            }else {
                echo false;
            }
        }
    }
?>