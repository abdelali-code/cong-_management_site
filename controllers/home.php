<?php 
    class Home extends ControllerConfig {
        public function __construct() {
            parent::__construct();
            // Session::init();
            $this->model = $this->loadModel("employer");
        }
        public function get() {
            $this->view->render("employes/home");
        }
        public function demandeConge() {
            if (isset($_POST['demandeConge'])) {
                $this->view->errMess =  $this->model->addConger($_POST);
            }
            $this->view->render("employes/demandeConge");
        }
        public function demandeStatus() {
            $demandeList = $this->model->loadDemande();
            $this->view->demandeList = $demandeList;
            $this->view->render("employes/demandeStatus");
        }

        // impremer les fichier 
        public function imprimer($num=null) {
            if(isset($num)) {
                $this->model->generatePdf($num);
            }
            $this->view->render("employes/imprimer");
        }
    }
?>