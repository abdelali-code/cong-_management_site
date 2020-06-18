<?php 
    class employerModel extends Database {
        public function __construct() {
            parent :: __construct();
 
        }
        public function addConger($data) {
            // get the current date;
            $currentDate = date("Y-m-d");
            $dateBegin = "2000-01-01";
            $errMess = [];
            $employerId = $_SESSION['userid'];

            if (empty($data['demandeType'])){
                $errMess['demandeType'] = "type field is required";  
            }
            else {
                $demandeType = $data['demandeType'];
                if ($demandeType == '1') {
                    $demandeType = "congé annuel";
                }elseif ($demandeType == '2') {
                    $demandeType = "permission absence";
                }else {
                    $demandeType = "congé maladie";
                }
            }
            // date begin
            if (empty($data['dateb'])) {
                $errMess['dateBegin'] = "date de début field is required";
            }
            elseif($data['dateb'] < $currentDate) {
                $errMess['dateBegin'] = "date de début must be greater than current date";
            }            
            else {
                $dateBegin = $data['dateb'];
            }

            // date end of conge
            if (empty($data['datef'])) {
                $errMess['dateEnd'] = "date de fin field is required"; 
            }
            elseif($data['datef'] <=  $dateBegin) {
                $errMess['dateEnd'] = "date de fin must be greater than de début";
            }
            else {
                $dateEnd = $data['datef'];
            }


            // if all field is entred 
            if (count($errMess) == 0) {
                // get the number of jour between two dates;
                $date1 = new DateTime($dateBegin);
                $date2 = new DateTime($dateEnd);
                $number_de_jour = (int)$date2->diff($date1)->format('%a');

                // now we are ready to insert those data into database;
                $query1 = "INSERT INTO conge(type, date_debut, date_retour, nombre_jour) VALUES(:type, :date_debut, :date_retour, :nombre_jour)";
                $stm1 = $this->db->prepare($query1);
                $stm1->execute(array(":type"=>$demandeType, ":date_debut"=>$dateBegin, ":date_retour"=>$dateEnd, ":nombre_jour"=>$number_de_jour));

                // if we successufy insert demande
                // get the id of the inserted demande;
                $demande_id = $this->db->lastInsertId();
                if ($stm1) {
                    $query2 = "INSERT INTO demande(user_cin, conge_numero) VALUES(:usercin, :congenumber)";
                    $stm2 = $this->db->prepare($query2);
                    $stm2->execute(array(":usercin"=>$employerId, ":congenumber"=>$demande_id));

                    // if we add a demande redirect tot list of demande;
                    if ($stm2) {
                        header("Location:".BASE_URL."/home/demandeStatus");
                    }
                    else {
                        echo "something goes wrong";
                    }
                }
                else {
                    echo "something goes wrong";
                }
            } 
            else {
                // there is error must handle it on front end;
             return $errMess;
                
            }
        }

        // load all the demande for a given employer from database
        public function loadDemande() {
            $employerId = $_SESSION['userid'];
            $stm = $this->db->prepare("SELECT conge.*, demande.decision FROM demande, conge WHERE conge_numero = numero AND user_cin = '$employerId'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }

        // function to generate a pdf file
        public function generatePdf($num) {
            require_once("lib/fpdf/fpdf.php");
            $this->pdf = new FPDF();
            // if number == 1 generate a bulletien de paie;
            if ($num == 1) {
                $this->pdf->AddPage();
                $this->pdf->SetFont('Arial','B',16);
                $this->pdf->Cell(70);
                $this->pdf->SetTextColor(60, 164, 255);
                $this->pdf->Cell(40,10,'Bulletien de paie');
                $this->pdf->Ln(20);
                $this->pdf->SetTextColor(0, 0, 0);
                $this->pdf->SetFont('Arial','',14);
                $this->pdf->Cell(40,10,'Name : '.Session::get('username'));
                $this->pdf->Ln();
                $this->pdf->Cell(40, 10,'porte la CIN num : '.Session::get("userid"));
                $this->pdf->Ln(30);
                $this->pdf->Cell(40, 10,'Nous sommes l\'entreprise yxz nos declare que le monsieur '.Session::get('username'));
                $this->pdf->Output();
            }
            // generate .......
            elseif ($num == 2) {
                $this->pdf->AddPage();
                $this->pdf->SetFont('Arial','B',16);
                $this->pdf->Cell(70);
                $this->pdf->SetTextColor(60, 164, 255);
                $this->pdf->Cell(40,10,'certificat de .....');
                $this->pdf->Ln(20);
                $this->pdf->SetTextColor(0, 0, 0);
                $this->pdf->SetFont('Arial','',14);
                $this->pdf->Cell(40,10,'Name : '.Session::get('username'));
                $this->pdf->Ln();
                $this->pdf->Cell(40, 10,'porte la CIN num : '.Session::get("userid"));
                $this->pdf->Ln(30);
                $this->pdf->Cell(40, 10,'Nous sommes l\'entreprise yxz nos declare que le monsieur '.Session::get('username'));
                $this->pdf->Output();
            }
        }

    }
?>