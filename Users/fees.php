<?php 
session_start();
require 'fpdf/fpdf.php';

if(isset($_SESSION['total'])){
    
    //Set all the variables
    $memId = $_SESSION['memId'];
     $paymentType = $_SESSION['paymentType'];
     $paymentDate = $_SESSION['paymentDate'];
    $firstname = $_SESSION['mfirstname'];
    $lastname = $_SESSION['mlastname'];
    $mobile = $_SESSION['mmobile'];
    $address = $_SESSION['maddress'];
    $gapfee = $_SESSION['gapfee'];
    $discount = $_SESSION['discount'];
    $total = $_SESSION['total'];
    $actual = $_SESSION['actual'];
    $recieptno = $_SESSION['recieptno'];
    $locker = $_SESSION['locker'];
    $admfee = $_SESSION['admfee'];
    $validUntil = $_SESSION['validUntil'];
    $balance = $_SESSION['balance'];
    $deposit = $_SESSION['deposit'];
    $email = $_SESSION['memail'];
    
$pdf = new FPDF('P','mm',"A4");
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

//Library Copy

$pdf->Cell(125,5,"Library Name",0,0);
$pdf->Cell(29,5,"Date",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$paymentDate,0,1);$pdf->SetFont('Arial','B',14);

//Starting Library Details
$pdf->Cell(125,5,"Street Address",0,0);
$pdf->Cell(29,5,"Valid Until",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$validUntil,0,1);$pdf->SetFont('Arial','B',14);
$pdf->Cell(125,5,"Dhankwadi,Pune 411042",0,0);
$pdf->Cell(29,5,"Reciept #",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$recieptno,0,1);$pdf->SetFont('Arial','B',14);
$pdf->Cell(125,5,"Phone - ",0,0);
$pdf->Cell(29,5,"Member ID",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$memId,0,1);$pdf->SetFont('Arial','B',14);

//Break Line
$pdf->Cell(189,3,"",0,1);

//Bill To   

//Member Name and Data
$pdf->SetFont('Arial',"",14);
$pdf->Cell(189,5,$firstname." ".$lastname,0,1,"L");
$pdf->Cell(189,5,$email,0,1,"L");
$pdf->Cell(189,5,$mobile,0,1,"L");

//Break Line
$pdf->Cell(189,3,"",0,1);
//Desription of Fees

$pdf->SetFont('Arial','B',14);
$pdf->Cell(189,6,"Description",1,1);
$pdf->SetFont('Arial','',14);
$pdf->Cell(125,6,"Admission Fee",1,0);
$pdf->Cell(64,6,"Rs ".$admfee."/-",1,1,"C");
$pdf->Cell(125,6,"Deposit Fee",1,0);
$pdf->Cell(64,6,"Rs ".$deposit."/-",1,1,"C");
$pdf->Cell(125,6,$paymentType." Months Fee",1,0);
$pdf->Cell(64,6,"Rs ".$actual."/-",1,1,"C");
$pdf->Cell(125,6,"Gap/Fine Fee",1,0);
$pdf->Cell(64,6,"Rs ".$gapfee."/-",1,1,"C");
$pdf->Cell(125,6,"Locker Rent",1,0);
$pdf->Cell(64,6,"Rs ".$locker."/-",1,1,"C");
$pdf->Cell(125,6,"Discount",1,0);
$pdf->Cell(64,6,"Rs ".$discount."/-",1,1,"C");$pdf->SetFont('Arial','B',14);
$pdf->Cell(125,6,"Total Payable",1,0);
$pdf->Cell(64,6,"Rs ".$total."/-",1,1,"C");$pdf->SetFont('Arial','',14);
$pdf->Cell(125,6,"Balance",1,0);
$pdf->Cell(64,6,"Rs ".$balance."/-",1,1,"C");
$pdf->SetFont('Arial','B',14);    
    
//Break Line
$pdf->Cell(189,5,"",0,1);

//Sign and Stamp
$pdf->Cell(63,12,"",1,0);
$pdf->Cell(63,12,"",0,0);
$pdf->Cell(63,12,"",1,1);

$pdf->Cell(63,7,"Library Stamp",0,0,"C");
$pdf->Cell(63,7,"",0,0,"C");
$pdf->Cell(63,7,"Member Sign",0,1,"C");
$pdf->SetFont('Arial','',10);
$pdf->Cell(189,3,"",0,1);
$pdf->Cell(63,3,"No Refund",0,0,"C");
$pdf->Cell(63,3,"No Transfer",0,0,"C");
$pdf->Cell(63,3,"No Extension",0,0,"C");

    
//Break Line
$pdf->Cell(189,8,"",0,1);
$pdf->SetFont('Arial','B',14);   

//Member Copy

$pdf->Cell(125,5,"Library Name",0,0);
$pdf->Cell(29,5,"Date",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$paymentDate,0,1);$pdf->SetFont('Arial','B',14);

//Starting Library Details
$pdf->Cell(125,5,"Street Address",0,0);
$pdf->Cell(29,5,"Valid Until",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$validUntil,0,1);$pdf->SetFont('Arial','B',14);
$pdf->Cell(125,5,"Dhankwadi,Pune 411042",0,0);
$pdf->Cell(29,5,"Reciept #",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$recieptno,0,1);$pdf->SetFont('Arial','B',14);
$pdf->Cell(125,5,"Phone - ",0,0);
$pdf->Cell(29,5,"Member ID",0,0); $pdf->SetFont('Arial',"",14);
$pdf->Cell(35,5,$memId,0,1);$pdf->SetFont('Arial','B',14);

//Break Line
$pdf->Cell(189,3,"",0,1);

//Bill To   

//Member Name and Data
$pdf->SetFont('Arial',"",14);
$pdf->Cell(189,5,$firstname." ".$lastname,0,1,"L");
$pdf->Cell(189,5,$email,0,1,"L");
$pdf->Cell(189,5,$mobile,0,1,"L");

//Break Line
$pdf->Cell(189,3,"",0,1);
//Desription of Fees

$pdf->SetFont('Arial','B',14);
$pdf->Cell(189,6,"Description",1,1);
$pdf->SetFont('Arial','',14);
$pdf->Cell(125,6,"Admission Fee",1,0);
$pdf->Cell(64,6,"Rs ".$admfee."/-",1,1,"C");
$pdf->Cell(125,6,"Deposit Fee",1,0);
$pdf->Cell(64,6,"Rs ".$deposit."/-",1,1,"C");
$pdf->Cell(125,6,$paymentType." Months Fee",1,0);
$pdf->Cell(64,6,"Rs ".$actual."/-",1,1,"C");
$pdf->Cell(125,6,"Gap/Fine Fee",1,0);
$pdf->Cell(64,6,"Rs ".$gapfee."/-",1,1,"C");
$pdf->Cell(125,6,"Locker Rent",1,0);
$pdf->Cell(64,6,"Rs ".$locker."/-",1,1,"C");
$pdf->Cell(125,6,"Discount",1,0);
$pdf->Cell(64,6,"Rs ".$discount."/-",1,1,"C");$pdf->SetFont('Arial','B',14);
$pdf->Cell(125,6,"Total Payable",1,0);
$pdf->Cell(64,6,"Rs ".$total."/-",1,1,"C");$pdf->SetFont('Arial','',14);
$pdf->Cell(125,6,"Balance",1,0);
$pdf->Cell(64,6,"Rs ".$balance."/-",1,1,"C");
$pdf->SetFont('Arial','B',14);

//Break Line
$pdf->Cell(189,5,"",0,1);

//Sign and Stamp
$pdf->Cell(63,12,"",1,0);
$pdf->Cell(63,12,"",0,0);
$pdf->Cell(63,12,"",1,1);

$pdf->Cell(63,7,"Library Stamp",0,0,"C");
$pdf->Cell(63,7,"",0,0,"C");
$pdf->Cell(63,7,"Member Sign",0,1,"C");
$pdf->SetFont('Arial','',10);
$pdf->Cell(189,3,"",0,1);
$pdf->Cell(63,3,"No Refund",0,0,"C");
$pdf->Cell(63,3,"No Transfer",0,0,"C");
$pdf->Cell(63,3,"No Extension",0,0,"C");

$pdf->output($recieptno."-".$mobile.".pdf",'I');
    
}
else {
    echo '<script>alert("Error generating pdf")</script>';
}
?>