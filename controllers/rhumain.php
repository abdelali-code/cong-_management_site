<?php 
    class Rhumain extends ControllerConfig {
        public function __construct() {
            parent::__construct();
            $this->model = $this->loadModel("rhumain");
        }
        public function get() {
            $demande = $this->model->loadDemande();
            $this->view->demandes = $demande;
            $this->view->render('rhumain/home');
        }
        // accept demande
        public function acceptDemande() {
            if (isset($_POST['numero'])) {
                $this->model->acceptDemande($_POST['numero']);
            }
        }
        // refuser un demande
        public function refuseDemande() {
            if (isset($_POST['numero'])) {
                $this->model->refuseDemande($_POST['numero']);
            }
        }
    }
?>