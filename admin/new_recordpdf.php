<?php 
 $title = 'Record Company'; 
include "config.php";
include 'header.php';


    /* Function code start */
 
    function convert_number_to_words($number) {
        
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );
        
        if (!is_numeric($number)) {
            return false;
        }
        
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
    
        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
        
        $string = $fraction = null;
        
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }
        
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        
        return $string;
    }

        
    /* Function code end */
  
    function IND_money_format($num){
        $nums = explode(".",$num);
        if(count($nums)>2){
            return "0";
        }else{
        if(count($nums)==1){
            $nums[1]="00";
        }
        $num = $nums[0];
        $explrestunits = "" ;
        if(strlen($num)>3){
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); 
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; 
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++){

                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; 
                }else{
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash.".".$nums[1]; 
        }
    }
        
        if(($_POST))
            {
                //echo "<pre>"; print_r($_POST);
                $comp_name = $_POST['companies'];
            	 $emp_name = $_POST['emp_name'];
            	 
            	$query = "select * from companies where comp_name='".$_POST['companies']."'";
                $get1 = mysqli_query($con_exp,$query);
                $result1 = mysqli_fetch_assoc($get1);
    
    
                if(($_POST['letterhead'])=='letterhead'){
                    $hederlogo=  $result1['comp_letterhead_header'];
                    $footerlogo= $result1['comp_letterhead_footer'];  
                }else{
                    $hederlogo= "";
                    $footerlogo= "";
                } 
    
                //  echo "<pre>"; print_r($footerlogo); die;
    
	            $hr_name  = $result1['hr_name'];
	            $comp_address = 'address';
	            //echo "<pre>"; print_r($result1); die;
                $img = $result1['comp_logo'];
                $img_tag = "<img src='http://exp.cromacampus.com/uploads/".$img."' alt='' width='350' height='150' style=\"background:#fff;\" >";
                
                
                if(@$_POST['b1'] == 'Compensation Letter')
                	{
                        //echo "<pre>"; print_r($_POST); die;
                        setlocale(LC_MONETARY, 'en_IN');	  
                        //$month_of_salary_slip = $_REQUEST['month_of_salary_slip'];
                        $month_of_salary_slip = $_REQUEST['slipsyear'];
                	 
                	   	$query = "select * from companies where comp_name='".$_POST['companies']."'";
                        $get1 = mysqli_query($con_exp,$query);
                        $result1 = mysqli_fetch_assoc($get1);
                       // $hederlogo=  $result1['comp_letterhead_header'];
                      //  $footerlogo= $result1['comp_letterhead_footer'];
                        
                        /*if(($_POST['letterhead'])=='letterhead'){
                                $hederlogo=  $result1['comp_letterhead_header'];
                                $footerlogo= $result1['comp_letterhead_footer'];  
                            }else{
                                $hederlogo= " ";
                                $footerlogo= " ";
                            }  
                        */
                   
                       // echo "<pre>"; print_r($result1); die;
                	  
                		 $ctc2 = $_POST['ctc2'];
                		 $basicctc2 = $ctc2 * 40/100;
                		 $hractc2 = $ctc2 * 20/100;
                		 $lta_ctc2 = 12000;
                		 $cumm_exp_ctc2 = 12000;
                		 $medi_reiub_ctc2 = 15000;
                		 $spec_allowance_ctc2 = $ctc2 -($basicctc2 + $hractc2 + $lta_ctc2 + $cumm_exp_ctc2 + $medi_reiub_ctc2);
                		 $newhractc2 = $hractc2 + ($spec_allowance_ctc2);
                		//echo "<pre>"; print_r($spec_allowance_ctc2);
                	  
                			$newctc = $_POST['newctc'];
                            $basic_pay_new_ctc = $newctc * 40/100;
                            $hra_new_ctc = $newctc * 20/100;
                            $lta_new_ctc = 12000;
                            $commun_new_ctc = 12000;
                            $medi_reibu_new_ctc = 15000;
                            $spec_allow_new_ctc = $newctc - ($basic_pay_new_ctc + $hra_new_ctc + $lta_new_ctc + $commun_new_ctc + $medi_reibu_new_ctc);
                            $newhra1 = $hra_new_ctc + ($spec_allow_new_ctc);
                	  
                		
                			$total_ctc = $basicctc2 + $hractc2 + $spec_allowance_ctc2 + $lta_ctc2 + $cumm_exp_ctc2 + $medi_reiub_ctc2;
                			//echo "<pre>"; print_r($total_ctc); 
                
                			$total_new_ctc = $basic_pay_new_ctc + $hra_new_ctc + ($spec_allow_new_ctc) + $lta_new_ctc + $commun_new_ctc + $medi_reibu_new_ctc;
                			//echo "<pre>"; print_r($total_new_ctc); 
                		
                		/*  $total_ctc = $_REQUEST['basic_pay_ctc2'] + $_REQUEST['hra_ctc2'] + $_REQUEST['spec_allowance_ctc2'] + $_REQUEST['lta_ctc2'] + $_REQUEST['cumm_exp_ctc2'] + $_REQUEST['medi_reiub_ctc2'];
                
                			$total_new_ctc = $_REQUEST['basic_pay_new_ctc'] + $_REQUEST['hra_new_ctc'] + $_REQUEST['spec_allow_new_ctc'] + $_REQUEST['lta_new_ctc'] + $_REQUEST['commun_new_ctc'] + $_REQUEST['medi_reibu_new_ctc'];
                            */
                			setlocale(LC_MONETARY, 'en_IN');
                
                
                			if($_REQUEST['newdesignation'] != $_REQUEST['designation'])
                			{
                				$add_lines = " you has been confirmed as <strong>".$_REQUEST['newdesignation']."</strong> and also ";
                			}else{
                				$add_lines = ' ';
                			}
                
                			$html = "
                
                			<p style=\"font-size:14px; line-height:17px;\"><strong>".date('d-M, Y',strtotime("+10 days",strtotime($_REQUEST['appraisaldate'])))."</strong></p>
                			
                			<p style=\"font-size:14px; line-height:17px;\"><strong>".$_REQUEST['gender']." ".$emp_name."<br>(Emp ID :".$_REQUEST['emp_id'].")</strong></p>
                			
                			<p style=\"font-size:14px; line-height:17px;\"><strong>Sub: Compensation Revision ".date("Y", strtotime($_REQUEST['doj']))."-".date('y', strtotime('+1 year', strtotime($_REQUEST['doj'])))."</strong></p>
                			<br><br>
                			<p style=\"font-size:14px; line-height:17px; text-align:justify;\"><strong>Dear ".$emp_name.",</strong><br>
                			The past year has been an incredibly demanding and yet rewarding year for <strong>".$_REQUEST['companies']."</strong> In appreciation of your capabilities, commitment and performance, we are pleased to inform that".$add_lines."your Total Cost to Company (CTC) has been revised to <strong>Rs.".$_REQUEST['newctc']." /-</strong> per annum with effect from <strong>".date("d-M, Y", strtotime($_REQUEST['appraisaldate'])).".</strong>
                			</p>
                			
                			<p style=\"font-size:14px; line-height:17px; text-align:justify;\">
                			We have enclosed the details of your revised compensation package in the Annexure1. This communication regarding your compensation andemployee benefits supersedes all previous communication on the subject. Please note any information related to your salary is strictly confidential between you and the organization and you are requested totreat the same accordingly.
                			</p>
                			
                			<p style=\"font-size:14px; line-height:17px; text-align:justify;\">
                			In the near term and long term, we need to embark upon ways and means to sustain the success that wehave achieved. Increasing Costs continue to be a concern area and all of us need to work on improvingour operating efficiencies. The internal and external challenges that face us in the near future can affectour performance baselines and influence our future growth and we need to collectively work to manage it.
                			</p>
                		
                			<p style=\"font-size:14px; line-height:17px;\">
                			Thank you once again for your contribution and commitment in the year <strong>".date('Y', strtotime('-1 year', strtotime($_REQUEST['doj'])))."-".date("y", strtotime($_REQUEST['doj'])).".</strong>
                			</p>
                			
                			<p style=\"font-size:14px; line-height:17px;\">
                			I look forward to working, winning and achieving new milestones together in the coming year.
                			<p>
                
                			<p style=\"font-size:14px; line-height:17px;\">
                			<strong>With Best Wishes<br>
                			For: ".$_REQUEST['companies']."</strong>
                			</p>
                
                			<p style=\"font-size:14px; line-height:17px;\">
                			<strong>".$hr_name."<br>
                			(Manager– Human Resources)</strong>
                			</p>
                			<div></div><div></div><div></div><div></div><div></div>
                			<div></div><div></div><div></div><div></div><div></div>
                			<div></div><div></div><div></div><div></div><div></div>
                			<table style=\"border:1px solid #000;border-spacing:10px;\">
                			<tr style=\"font-size:22px; color:#fff; background-color:#000; padding:10px;\">
                			<td style=\"text-align:center;\"><strong>Annexure 1 - ".$_REQUEST['gender']." ".$emp_name." (".$_REQUEST['emp_id'].")</strong></td>
                			</tr>
                			<tr style=\"font-size:18px; color:#fff; background-color:#333; padding:10px;\">
                			<td style=\"text-align:center;\"><strong>Salary Structure with effect from ".date("d-M, Y", strtotime($_REQUEST['doj']))."</strong></td>
                			</tr>
                			<tr style=\"font-size:14px; color:#000; padding:10px; border:1px solid #000;\">
                			<td><strong>Designation:</strong> ".$_REQUEST['newdesignation']."</td>
                			</tr>
                			</table>
                			<div></div>
                			<table style=\"border:1px solid #000;\">
                          
                			<tr style=\"font-size:18px; color:#fff; background-color:#333; padding:10px;\">
                			<td style=\"border:1px solid #000; width:335px; text-align:left; \">Details</td>
                			<td style=\"border:1px solid #000; width:155px; text-align:right; \">Current</td>
                			<td style=\"border:1px solid #000; width:155px; text-align:right;\">Revised</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Total Cost to Company (CTC - Rs. Per Annum)</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$_REQUEST['ctc2']."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$_REQUEST['newctc']."</td>
                			</tr>
                
                			</table>
                
                			<div></div>
                			<table style=\"border:1px solid #000; \">
                
                			<tr style=\"font-size:18px; color:#fff; background-color:#333; padding:10px;\">
                			<td style=\"border:1px solid #000; width:335px; text-align:left; \">Components</td>
                			<td style=\"border:1px solid #000; width:155px; text-align:right; \">Rs. Per Annum</td>
                			<td style=\"border:1px solid #000; width:155px; text-align:right;\">Rs. Per Annum</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Basic Pay</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$basicctc2."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$basic_pay_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">House Rent Allowance (HRA)</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$hractc2."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$hra_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Special Personal Allowance</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$spec_allowance_ctc2."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$spec_allow_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">LTA</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$lta_ctc2."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$lta_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Communication Expenses</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$cumm_exp_ctc2."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$commun_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Medical Reimbursement</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$medi_reiub_ctc2."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$medi_reibu_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\"><strong>Total Cost to Company (CTC)</strong></td>
                			<td style=\"border:1px solid #000; text-align:right; \"><strong>".$total_ctc."</strong></td>
                			<td style=\"border:1px solid #000; text-align:right; \"><strong>".$total_new_ctc."</strong></td>
                			</tr>
                
                			</table>
                
                			<p style=\"font-size:14px; line-height:17px;\">For computation of the above, the year considered will be financial year. Tax liability, if any will be to the employee's account.</p>
                
                			<p style=\"font-size:14px; line-height:17px;\">Management appreciates your continued services and commitment towards organizational success.</p>
                
                			<p style=\"font-size:14px; line-height:17px;\">Other terms and conditions of your appointment will remain unchanged and will be as per your Appointment Letter and any subsequent changes notified by the management.</p>
                			<br><br>
                			<div></div>
                			<table>
                			<tr>
                			<td><strong>With Best Wishes</strong></td>
                			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Employee Name:</strong></td>
                			</tr>
                			<tr>
                			<td><strong>For: ".$_REQUEST['companies']."</strong></td>
                			<td><strong>Employee Signature:</strong></td>
                			</tr>
                			</table>
                			<br><br>
                
                			<table>
                			<tr>
                			<td><strong>".$hr_name."</strong></td>
                			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date:</strong></td>
                			</tr>
                			<tr>
                			<td><strong>Manager– Human Resources</strong></td>
                			<td>&nbsp;</td>
                			</tr>
                			</table>
                			<br><br>
                		
                			";
                			require_once('tcpdf/config/lang/eng.php');
                			require_once('tcpdf/tcpdf.php');
                			
                			
                			class MYPDF extends TCPDF {
                			var $xfootertext  = '';
                			var $xheadertext  = '';
                				public function Footer() {
                				$this->SetX(1000);
                				$this->SetY(-40);
                				//$this->Image($this->xfootertext,0,745,598,98, '', '', '', true, 300, '', false, false, 0);
                				$this->Image($this->xfootertext,0,772,598,70, '', '', '', true, 300, '', false, false, 0);
                				$this->Cell(0, 10, ''.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
                				 
                				//$this->writeHtml($this->xfootertext,true); 
                				}
                				public function Header() {
                					$this->SetY(10);
                					$this->SetY(10);
                					 $this->Image($this->xheadertext,0,0,600,100, '', '', '', true, 300, '', false, false, 0);
                					//$this->writeHtml($this->xheadertext,true);
                
                				}
                			}
                			//$file_name = ucwords($name[0])."_".ucwords($name[2])."_Compensation_Letter.pdf";
                			$file_name = $emp_name."_Appraisal_Letter.pdf";
                
                			$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'px', 'A4', true, 'UTF-8', false);
                			$pdf->SetMargins(40, 130,-1,true);
                			$pdf->SetPrintHeader(true);
                			$pdf->SetPrintFooter(true);
                			$pdf->SetAutoPageBreak(true, 50); 
                			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                			$pdf->setLanguageArray($l);
                			$pdf->SetFont('times', '', 12);
                			$pdf->xfootertext = $footerlogo;
                			$pdf->xheadertext = $hederlogo;
                			$pdf->AddPage();
                
                			$pdf->writeHTML($html, true);
                			ob_end_clean();
                			$pdf->Output($file_name, 'D');
                
                    }
                      
                    if($_POST['b1'] == 'Salary Slip')
                        {
                    //echo "<pre>"; print_r($_REQUEST); 
                    //echo "<pre>"; print_r($result1); die; 
                    $query = "select * from companies where comp_name='".$_POST['companies']."'";
                    $get1 = mysqli_query($con_exp,$query);
                    $result1 = mysqli_fetch_assoc($get1);
                    if(($_POST['letterhead'])=='letterhead'){
                            $tableheading = "";
                            $size = 190;
                        }else{
                           
                            $tableheading = "<table><tr><td style=\"border:1px solid #000; text-align:center; width:60%; height:100px; margin-top:50px;\"><div></div><span style=\"font-size:26px;\">".$_REQUEST['companies']."</span><br><span style=\"font-size:13px;\">(".$result1['company_address2'].")</span></td><td style=\"border:1px solid #000; text-align:center; width:40%; height:100px; padding-top:20px;\"><div></div><img src=\"/admin/".$result1['comp_logo']."\" height=\"70px\" width=\"150px\" style=\"margin-top:50px;\"></td></tr></table>";
                            $size = 100;
                        } 
                    //echo "<pre>"; print_r($result1); die;
                   $img = $result1['comp_logo']; 
            	    $hr_name  = $result1['hr_name'];
            		//echo "<pre>"; print_r($_POST);
            	    setlocale(LC_MONETARY, 'en_IN');	  
            	    //$month_of_salary_slip = $_REQUEST['month_of_salary_slip'];
            	    $month_of_salary_slip = $_REQUEST['slipsyear'];
            	    //$month_of_salary_slip =  implode(" ","month_chk");
            	    $newctc = $_REQUEST['newctc'];
            	    $net_pay = $_REQUEST['netpay'];
            	    //$net_pay =   (int)$_REQUEST['netpay'];
            	    $monthctc =  (int)$newctc/12;
            	    $basic =  $monthctc * 40/100;
            	    $hra = $monthctc * 20/100;
            		//$lta =  $_REQUEST['lta_new_ctc']/12;
            		//  $cumm_exp_ctc = $_REQUEST['cumm_exp_ctc']/12;
            		// $medi_reiub_ctc = $_REQUEST['medi_reiub_ctc']/12;
            	  
            	    $lta =  12000/12;
            	    $cumm_exp_ctc = 12000/12;
            	    $medi_reiub_ctc = 15000/12;
            	    $special = $monthctc - ($basic + $hra + $lta + $cumm_exp_ctc + $medi_reiub_ctc);
            	    $total_deductions = $monthctc - $net_pay;
            	  
            			/* $newctc = $_POST['newctc'];
                        $basic_pay_new_ctc = $newctc * 40/100;
                        $hra_new_ctc = $newctc * 20/100;
                        $lta_new_ctc = 12000;
                        $commun_new_ctc = 12000;
                        $medi_reibu_new_ctc = 15000;
                        $spec_allow_new_ctc = $newctc - ($basic_pay_new_ctc + $hra_new_ctc + $lta_new_ctc + $commun_new_ctc + $medi_reibu_new_ctc);
                        $newhra1 = $hra_new_ctc + ($spec_allow_new_ctc); */
            	  
            	
            /* Function code start */
               $number= $net_pay;
               $data = convert_number_to_words($number); //echo $data;
            /* Function code end */
            
            $html = "";
                  
            if(isset($_POST['month_chk']) && is_array($_POST['month_chk'])){
            	$all_sal_month = $_POST['month_chk'];
            
            	foreach($all_sal_month as $sal_month) {
            
            if($sal_month == "January") {
            		  $totalDays = 31;
            	  } else if($sal_month == "February") {
            		   $totalDays = 28;
            	  } else if($sal_month == "March") {
            		   $totalDays = 31;
            	  } else if($sal_month == "April") {
            		  $totalDays = 30;
            	  } else if($sal_month == "May") {
            		  $totalDays = 31;
            	  } else if($sal_month == "June") {
            		  $totalDays = 30;
            	  } else if($sal_month == "July") {
            		  $totalDays = 31;
            	  } else if($sal_month == "August") {
            		  $totalDays = 31;
            	  } else if($sal_month == "September") {
            		  $totalDays = 30;
            	  } else if($sal_month == "October") { 
            	  $totalDays = 31;
            	  } else if($sal_month == "November") {
            		  $totalDays = 30;
            	  } else { $totalDays = 31; }
             
             
             
            		  $html .= "<p>
            ".$tableheading."
            <table cellpadding=\"5\">
            <tr >
            <td style=\"border:1px solid #000; text-align:center; font-size:16px; font-weight:bold;\"><u>Salary slip for the month of ".$sal_month." ".$month_of_salary_slip."</u></td>
            </tr>
            </table>
            
            <table cellpadding=\"4\">
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; font-weight:bold;\"> Employee Code</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; \"> ".$_REQUEST['emp_id']."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; font-weight:bold;\"> Employee Name</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> ".$emp_name."</td>
            </tr>
            
            <tr>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Date of Joining</td>
            <td style=\"border:1px solid #000; text-align:left; \"> ".date("d-M, Y", strtotime($_REQUEST['doj']))."</td>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Bank</td>
            <td style=\"border:1px solid #000; text-align:left; \"> N.A</td>
            </tr>
            
            <tr>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Department</td>
            <td style=\"border:1px solid #000; text-align:left; \"> ".$_REQUEST['emp_department']."</td>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Bank A/C No.</td>
            <td style=\"border:1px solid #000; text-align:left; \"> N.A</td>
            </tr>
            
            <tr>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> PF No.</td>
            <td style=\"border:1px solid #000; text-align:left; \"> N.A</td>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Pay Mode</td>
            <td style=\"border:1px solid #000; text-align:left; \"> ".$_REQUEST['paymode']."</td>
            </tr>
            
            <tr>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Designation</td>
            <td style=\"border:1px solid #000; text-align:left; \"> ".$_REQUEST['newdesignation']."</td>
            <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Net Pay (INR)</td>
            <td style=\"border:1px solid #000; text-align:left; \"> INR ".round($_REQUEST['netpay'])."</td>
            </tr>
            
            </table>
            
            <table cellpadding=\"4\">
            <tr>
            <td style=\"border:1.5px solid #000; \"> <strong>Days Payable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> &nbsp;".$totalDays."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>LWP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> &nbsp; 0</td>
            </tr>
            
            <tr>
            <td style=\"border:1.5px solid #000; font-weight:bold;\"> Earnings</td>
            </tr>
            </table>
            
            <table cellpadding=\"4\">
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; font-weight:bold;\"> Pay Components</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; font-weight:bold; \"> Amount (Rs.)</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; font-weight:bold;\"> Amount Paid (Rs.)</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Basic</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; \"> ".round($basic,2)."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\"> ".round($basic,2)."</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> HRA</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; \">".round($hra,2)."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\"> ".round($hra,2)."</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Special Personal Allowance</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; \"> ".round($special,2)."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\"> ".round($special,2)."</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> LTA</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; \">".round($lta,2)."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">".round($lta,2)."</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Communication Expenses</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; \">".round($cumm_exp_ctc,2)."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">".round($cumm_exp_ctc,2)."</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Medical</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; \"> ".round($medi_reiub_ctc,2)."</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">".round($medi_reiub_ctc,2)."</td>
            </tr>
            
            </table>
            
            <table cellpadding=\"4\">
            <tr>
            <td style=\"border:1.5px solid #000; font-weight:bold;\"> Total Earnings: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".round($monthctc,2)."</td>
            </tr>
            
            <tr>
            <td style=\"border:1.5px solid #000; font-weight:bold;\"> Deductions</td>
            </tr>
            </table>
            
            <table cellpadding=\"4\">
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; width:400px;\"><strong> Components</strong></td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center; width:194px;\"><strong>Amount (Rs.)</strong></td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> PF (Employee's Contribution)</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">0.00</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Tax Deducted At Source</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">0.00</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Professional Tax</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">0.00</td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> Others</td>
            <td valign=\"middle\" style=\"border:1px solid #000; text-align:center;\">".round($total_deductions,2)."</td>
            </tr>
            </table>
            
            <table cellpadding=\"4\">
            
            <tr>
            <td valign=\"middle\" style=\"border:1.5px solid #000; text-align:left;\"><strong> Total Deductions : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INR ".round($total_deductions,2)."</strong></td>
            </tr>
            
            <tr>
            <td valign=\"middle\" style=\"border:1.5px solid #000; text-align:left;\"><strong> Net Amount Pay : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INR ".$_REQUEST['netpay']."</strong><br> <span style=\"font-size:13px;\">(".ucwords($data)." Only)</span></td>
            </tr>
            
            </table>
            
            </p>";
            	
            	}
            } 
            //echo $_REQUEST['comp_address2'];
            //echo "<pre>";print_r($html);echo "</pre>";
            	require_once('tcpdf/config/lang/eng.php');
            	require_once('tcpdf/tcpdf.php');
            	
            		class MYPDF extends TCPDF {
            			public $xfootertext  = '';
            			public $xheadertext  = '';
            			public function Footer() {
            				$this->SetX(1000);
            				$this->SetY(-40);
            				//$this->Image($this->xfootertext,0,745,598,98, '', '', '', true, 300, '', false, false, 0);
            				$this->Image($this->xfootertext,0,772,598,70, '', '', '', true, 300, '', false, false, 0);
            				$this->Cell(0, 10, ''.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
            				//$this->writeHtml($this->xfootertext,true); 
            			}
            			public function Header() {
            				$this->SetY(10);
            				$this->SetX(10);
                            $this->Image($this->xheadertext,0,0,600,100, '', '', '', true, 300, '', false, false, 0);
            				//$this->writeHtml($this->xheadertext,true);
            			}
            		}
            		//$file_name = ucwords($name[0])."_".ucwords($name[2])."_Salary_Slip.pdf";
            		$file_name = $emp_name."_Salary_Slip.pdf";
            		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'px', 'A4', true, 'UTF-8', false);
            		$pdf->SetMargins(60, 100,-1,true);
            		$pdf->SetPrintHeader(true);
            		$pdf->SetPrintFooter(true);
            
            		$pdf->SetAutoPageBreak(true, $size); 
            		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            		$pdf->setLanguageArray($l);
            		//$font1 = $pdf->addTTFfont('tcpdf/fonts/Garamond_Regular.ttf', 'TrueTypeUnicode', '', 32);
            		$pdf->SetFont('times', '', 12);
            		$pdf->xfootertext = $footerlogo;
            		$pdf->xheadertext = $hederlogo;
            		$pdf->AddPage();
            		$pdf->writeHTML($html, true);
            		ob_end_clean();
            		$pdf->Output($file_name, 'D');
            	}  
                
        
            }



    ?>