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
			//	echo "<pre>";print_r($_POST);die;
				$apraisalquery = "select * from appraisal_records where id='".$_POST['apprasal_id']."'";
                $resquery = mysqli_query($con_exp,$apraisalquery);
                $aprolresult = mysqli_fetch_assoc($resquery);
                //echo "<pre>"; print_r($aprolresult);
				
				$recordquery = "select * from emp_records where id='".$aprolresult['record_id']."'";
                $recordquery = mysqli_query($con_exp,$recordquery);
                $empresult = mysqli_fetch_assoc($recordquery);
				
               //echo "<pre>"; print_r($empresult);
              
            	 $emp_name = $empresult['emp_name'];
            	 //$comp_name = $empresult['emp_company'];
            	 
            	$query = "select * from companies where id='".$empresult['emp_company_id']."'";
                $get1 = mysqli_query($con_exp,$query);
                $result1 = mysqli_fetch_assoc($get1);
                    $comp_add = $result1['comp_address'];    
					$comp_name = $result1['comp_name'];
					$comp_stamp = $result1['comp_stamp'];
					$salary_stamp = $result1['salaryslip_stamp'];
                if(($_POST['letterhead'])=='letterhead'){
                    $hederlogo=  $result1['comp_letterhead_header'];
                    $footerlogo= $result1['comp_letterhead_footer'];  
                }else{
                    $hederlogo= "";
                    $footerlogo= "";
                } 
                
              //  $companystamp = "<img src='/stamp/Pradyumna.png' alt='Pradyumna Stamp'>";
                
                //  echo "<pre>"; print_r($footerlogo); die;
    
	            $hr_name  = $result1['hr_name'];
	            $comp_address = $result1['comp_address'];
	            //echo "<pre>"; print_r($result1); die;
                $img = $result1['comp_logo'];
                $img_tag = "<img src='http://exp.cromacampus.com/uploads/".$img."' alt='' width='350' height='150' style=\"background:#fff;\" >";
                
                
                if(@$_POST['b1'] == 'Appraisal Letter')
                	{
                	   // echo "<pre>"; print_r($_POST);die;
                      //  echo "pre"; print_r($aprolresult); die();
                       // echo "<pre>"; print_r($_REQUEST['new_appraisaldate']); die;
                        setlocale(LC_MONETARY, 'en_IN');	  
                        //$month_of_salary_slip = $_REQUEST['month_of_salary_slip'];
                        $month_of_salary_slip = $_REQUEST['slipsyear'];
                	  
                		 $ctc3 = $empresult['emp_ctc3'];
                		 //echo $ctc3 ; die;
                		 $basicctc3 = $ctc3 * 40/100;
                		 $hractc3 = $ctc3 * 20/100;
                		 $lta_ctc3 = 12000;
                		 $cumm_exp_ctc3 = 12000;
                		 $medi_reiub_ctc3 = 15000;
                		 $spec_allowance_ctc3 = $ctc3 -($basicctc3 + $hractc3 + $lta_ctc3 + $cumm_exp_ctc3 + $medi_reiub_ctc3);
                		 $newhractc3 = $hractc3 + ($spec_allowance_ctc3);
                		//echo "<pre>"; print_r($spec_allowance_ctc2);
                	  
                			$newctc = $aprolresult['new_ctc'];
                            $basic_pay_new_ctc = $newctc * 40/100;
                            $hra_new_ctc = $newctc * 20/100;
                            $lta_new_ctc = 12000;
                            $commun_new_ctc = 12000;
                            $medi_reibu_new_ctc = 15000;
                            $spec_allow_new_ctc = $newctc - ($basic_pay_new_ctc + $hra_new_ctc + $lta_new_ctc + $commun_new_ctc + $medi_reibu_new_ctc);
                            $newhra1 = $hra_new_ctc + ($spec_allow_new_ctc);
                	  
                		
                			$total_ctc = $basicctc3 + $hractc3 + $spec_allowance_ctc3 + $lta_ctc3 + $cumm_exp_ctc3 + $medi_reiub_ctc3;
                			//echo "<pre>"; print_r($total_ctc); 
                
                			$total_new_ctc = $basic_pay_new_ctc + $hra_new_ctc + ($spec_allow_new_ctc) + $lta_new_ctc + $commun_new_ctc + $medi_reibu_new_ctc;
                //	echo "<pre>"; print_r($aprolresult); 
                		
                		/*  $total_ctc = $_REQUEST['basic_pay_ctc2'] + $_REQUEST['hra_ctc2'] + $_REQUEST['spec_allowance_ctc2'] + $_REQUEST['lta_ctc2'] + $_REQUEST['cumm_exp_ctc2'] + $_REQUEST['medi_reiub_ctc2'];
                
                			$total_new_ctc = $_REQUEST['basic_pay_new_ctc'] + $_REQUEST['hra_new_ctc'] + $_REQUEST['spec_allow_new_ctc'] + $_REQUEST['lta_new_ctc'] + $_REQUEST['commun_new_ctc'] + $_REQUEST['medi_reibu_new_ctc'];
                            */
                			setlocale(LC_MONETARY, 'en_IN');
                
                
                			if($aprolresult['new_appraisaldate'] != $aprolresult['newdesignation'])
                			{
                				$add_lines = " you has been confirmed as <strong>".$aprolresult['new_appraisaldate']."</strong> and also ";
                			}else{
                				$add_lines = ' ';
                			}
                
                			$html = "
                            
                			<p style=\"font-size:14px; line-height:17px;\"><strong>".date('d-M, Y',strtotime("+10 days",strtotime($aprolresult['new_appraisaldate'])))."</strong></p>
                			
                			<p style=\"font-size:14px; line-height:17px;\"><strong>".$empresult['gender']." ".$emp_name."<br>(Emp ID :".$aprolresult['emp_id'].")</strong></p>
                			
                			<p style=\"font-size:14px; line-height:17px;\"><strong>Sub: Compensation Revision ".date("Y", strtotime($aprolresult['emp_appraisaldate']))."-".date('y', strtotime('+1 year', strtotime($aprolresult['emp_appraisaldate'])))."</strong></p>
                			<br><br>
                			<p style=\"font-size:14px; line-height:17px; text-align:justify;\"><strong>Dear ".$emp_name.",</strong><br>
                			The past year has been an incredibly demanding and yet rewarding year for <strong>".$comp_name."</strong> In appreciation of your capabilities, commitment and performance, we are pleased to inform that".$add_lines."your Total Cost to Company (CTC) has been revised to <strong>Rs.".$aprolresult['new_ctc']." /-</strong> per annum with effect from <strong>".date("d-M, Y", strtotime($aprolresult['new_appraisaldate'])).".</strong>
                			</p>
                			
                			<p style=\"font-size:14px; line-height:17px; text-align:justify;\">
                			We have enclosed the details of your revised compensation package in the Annexure1. This communication regarding your compensation andemployee benefits supersedes all previous communication on the subject. Please note any information related to your salary is strictly confidential between you and the organization and you are requested totreat the same accordingly.
                			</p>
                			
                			<p style=\"font-size:14px; line-height:17px; text-align:justify;\">
                			In the near term and long term, we need to embark upon ways and means to sustain the success that wehave achieved. Increasing Costs continue to be a concern area and all of us need to work on improvingour operating efficiencies. The internal and external challenges that face us in the near future can affectour performance baselines and influence our future growth and we need to collectively work to manage it.
                			</p>
                		
                			<p style=\"font-size:14px; line-height:17px;\">
                			Thank you once again for your contribution and commitment in the year <strong>".date('Y', strtotime('-1 year', strtotime($aprolresult['new_dor'])))."-".date("y", strtotime($aprolresult['new_dor'])).".</strong>
                			</p>
                			
                			<p style=\"font-size:14px; line-height:17px;\">
                			I look forward to working, winning and achieving new milestones together in the coming year.
                			</p>
                             
                			<p style=\"font-size:14px; line-height:17px;\">
                			
                			<img src=\"./".$result1['comp_stamp']."\" height=\"85px\" width=\"210px\" style=\"margin-top:0px;\">
                			</p>
                        	
                			<p style=\"font-size:14px; line-height:17px;\">
                		
                			<strong style=\"margin-top:-20px\">".$hr_name."<br>
                			(Manager– Human Resources)</strong>
                			</p>
                			<div></div><div></div><div></div><div></div><div></div>
                			<div></div><div></div><div></div><div></div><div></div>
                			<div></div><div></div><div></div><div></div><div></div>
                			<table style=\"border:1px solid #000;border-spacing:10px;\">
                			<tr style=\"font-size:22px; color:#fff; background-color:#000; padding:10px;\">
                			<td style=\"text-align:center;\"><strong>Annexure 1 - ".$empresult['gender']." ".$emp_name." (".$aprolresult['emp_id'].")</strong></td>
                			</tr>
                			<tr style=\"font-size:18px; color:#fff; background-color:#333; padding:10px;\">
                			<td style=\"text-align:center;\"><strong>Salary Structure with effect from ".date("d-M, Y", strtotime($aprolresult['new_appraisaldate']))."</strong></td>
                			</tr>
                			<tr style=\"font-size:14px; color:#000; padding:10px; border:1px solid #000;\">
                			<td><strong>Designation:</strong> ".$aprolresult['new_designation']."</td>
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
                			<td style=\"border:1px solid #000; text-align:right; \">".$empresult['emp_ctc3']."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$aprolresult['new_ctc']."</td>
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
                			<td style=\"border:1px solid #000; text-align:right; \">".$basicctc3."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$basic_pay_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">House Rent Allowance (HRA)</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$hractc3."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$hra_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Special Personal Allowance</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$spec_allowance_ctc3."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$spec_allow_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">LTA</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$lta_ctc3."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$lta_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Communication Expenses</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$cumm_exp_ctc3."</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$commun_new_ctc."</td>
                			</tr>
                
                			<tr>
                			<td style=\"border:1px solid #000; text-align:left;\">Medical Reimbursement</td>
                			<td style=\"border:1px solid #000; text-align:right; \">".$medi_reiub_ctc3."</td>
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
                			
                			<div></div>
                			<table>
                			<tr>
                			<td><img src=\"./".$result1['comp_stamp']."\" height=\"85px\" width=\"210px\" style=\"margin-top:0px;\"></td>
                			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Employee Name:</strong></td>
                			</tr>
                			<tr>
                			<td><strong>".$hr_name."</strong></td>
                			<td><strong>Employee Signature:</strong></td>
                			</tr>
                			</table>
                			<br><br>
                
                			<table>
                			<tr>
                			<td><strong>Manager– Human Resources</strong></td>
                			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date:</strong></td>
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
                			//	$this->Cell(0, 10, ''.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
                				 
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
                    
                    
                    
 
                if(@$_POST['b1'] == 'Appointment Letter')
                    {
                        //echo "appontement test"; die;
                        //echo "<pre>"; print_r($empresult);
                        //echo "pre"; print_r($aprolresult); 
                        //echo "<pre>"; print_r($result1); die();    
                        $emp_id = $aprolresult['emp_id'];
                        $hr_name  = $result1['hr_name'];
                        $comp_address = $result1['comp_address'];
                        $comp_stamp = $result1['comp_stamp'];
                        //$emp_name = $empresult['emp_name'];
                        //$comp_name = $_POST['companies'];
                        $addressname = $empresult['address'];
                        $gender  = $empresult['gender'];
                        
                        $query = "select * from companies where comp_name='".$_POST['companies']."'";
                        $get1 = mysqli_query($con_exp,$query);
                        $result1 = mysqli_fetch_assoc($get1);
                       /*
                        if(($_POST['letterhead'])=='letterhead'){
                            $hederlogo=  $result1['comp_letterhead_header'];
                            $footerlogo= $result1['comp_letterhead_footer'];  
                        }else{
                            $hederlogo= " ";
                            $footerlogo= " ";
                        }   */
                      
                      //  echo "<pre>"; print_r($result1); die;
                      
                	   
                        //$hr_name  = "hr_name";
                        $comp_address =$result1['comp_address'];
                       // $emp_name = implode(" ",$name);
                        $emp_designation = $empresult['designation'];
                        $emp_annual_ctc = $empresult['emp_ctc1'];
                        $emp_annual_ctc = $empresult['emp_ctc2'];
                       // $emp_monthly_ctc = $_POST['mon_ctc'];
                        $emp_doj = $empresult['emp_doj'];
                        $emp_dor = $empresult['emp_dor'];
                        $created_at = date('d-M, Y');
                		
                		$ctc = $empresult['emp_ctc1'];
                		 $basic = $ctc * 40/100;
                		 $hra = $ctc * 20/100;
                		 $lta_ctc = 12000;
                		 $cumm_exp_ctc = 12000;
                		 $medi_reiub_ctc = 15000;
                		 $spec_allowance_ctc = $ctc -($basic + $hra + $lta_ctc + $cumm_exp_ctc + $medi_reiub_ctc);
                		 $newhra = $hra + ($spec_allowance_ctc);
                		//echo $ctc.'=='.$basic.'=='.$hra.'=='.$spec_allowance_ctc.'=='.$newhra;die;
                		 $ctc2 = $empresult['emp_ctc2'];
                		 $basicctc2 = $ctc2 * 40/100;
                		 $hractc2 = $ctc2 * 20/100;
                		 $lta_ctc2 = 12000;
                		 $cumm_exp_ctc2 = 12000;
                		 $medi_reiub_ctc2 = 15000;
                		 $spec_allowance_ctc2 = $ctc2 -($basicctc2 + $hractc2 + $lta_ctc2 + $cumm_exp_ctc2 + $medi_reiub_ctc2);
                		 $newhractc2 = $hractc2 + ($spec_allowance_ctc2);
                		
                		   $newctc = $aprolresult['emp_ctc3'];
                            $basic_pay_new_ctc = $newctc * 40/100;
                            $hra_new_ctc = $newctc * 20/100;
                            $lta_new_ctc = 12000;
                            $commun_new_ctc = 12000;
                            $medi_reibu_new_ctc = 15000;
                            $spec_allow_new_ctc = $newctc - ($basic_pay_new_ctc + $hra_new_ctc + $lta_new_ctc + $commun_new_ctc + $medi_reibu_new_ctc);
                            $newhra1 = $hra_new_ctc + ($spec_allow_new_ctc);
                
                   /*     $qry = mysqli_query($con,"INSERT INTO emp_records(emp_id,emp_name,emp_company,emp_designation,emp_annual_ctc,emp_doj,emp_dor,created_at) VALUES('".$emp_id."','".$emp_name."','".$comp_name."','".$emp_designation."','".$emp_annual_ctc."','".$emp_doj."','".$emp_dor."','".$created_at."')");
                
                        if($qry)
                	{
                		$msg = '';
                	}
                 */
                       setlocale(LC_MONETARY, 'en_IN');
                       $total_ctc = $basic + $hra + $spec_allowance_ctc + $lta_ctc + $cumm_exp_ctc + $medi_reiub_ctc;
                
                       
                        $html = "
                        
                	<p style=\"text-align:justify;\">
                	<strong>Date: ".date("d-M, Y", strtotime($empresult['emp_doj']))."</strong>
                	<br><br>
                	<span style=\"font-size:16px;\"><strong>".$emp_name."</strong></span> 
                	<br>
                	<span style=\"font-size:14px;\">".$addressname."</span>
                	<br><br><br>
                
                	Dear ".$emp_name.",<br>
                	It gives us great pleasure in offering you an appointment with <strong>".$comp_name."</strong> you are requested to go through the letter and handover a copy of the same after signing the acceptance. The terms & conditions of employment are mentioned below:
                
                	<br><br>
                	<strong><i>Date of Joining</i></strong>
                	<br><br>
                	Your employment with us will commence on <strong>".date("d-M, Y", strtotime($empresult['emp_doj'])).".</strong>
                	<br><br>
                	<strong><i>Remuneration</i></strong>
                	<br><br>
                	Your total compensation and benefits will be <strong>Rs. ".$ctc."/- per annum + incentives;</strong> incentive will be consideration as per your performance. The details of your salary and benefits are given in Annexure 1.
                	<br><br>
                	Your first performance will be reviewed on ".date('d-M, Y', strtotime('+89 day', strtotime($empresult['emp_doj'])))." by your manager and will be considered for profile and 
                
                
                
                	 increment.
                	<br><br>
                	The Company will be entitled, at any time during your employment, or in the event of Company, including, but not limited to loans or advances, and any excess holiday pay.
                	<br><br>
                	<strong><i>Career Progression & Promotions</i></strong>
                	<br>
                	You'll be designated with us as a <strong>'".$empresult['emp_designation']."'</strong> and you will be placed at our office premises at:<br>Our Address:- <strong>".$comp_add.".</strong>
                	<br><br>
                	Your performance will be measured weekly to culminate in a decision so as to measure the quantum of increment and change of role and responsibilities. The final decision to execute these recommendations rests solely at the absolute discretion of the Company.
                	<br>
                	The company, reserves the right, to make reasonable changes to any of your terms of employment, which will be communicated to you in writing and a one month notice period would be given to you within which you will notify the company of any valid objections you may have in that regard.
                	<br><br>
                	<strong><i>Place of work</i></strong>
                	<br>
                	(a) The Company has entered into a strategic agreement for its office premises. and your services are extended to your place in respect of this agreement. You will be deputed to your place to work which will be your normal place of work unless you are notified otherwise.
                	<br><br>
                	The normal place of work may be changed from time to time. You will report for duty at such place of work as may be communicated to you.
                	<br>
                	(b) You will conform to the rules and regulations of the facility which you are working in, under all circumstances. Such rules shall include rules pertaining to hours of work, holidays or otherwise.
                	<br><br>
                
                	<strong><i>Hours of Work</i></strong>
                	<br>
                	Your normal hours of work will be from 10 AM to 7 PM from Monday to Saturday of month whereas second and last Saturday will be off for office work but in case of  exigencies of work, you may be required to work beyond normal hours for which you will not be paid any overtime.
                	<br><br>
                	<strong><i>Holidays</i></strong>
                	<br>
                	You will be entitled to leave as per the leave policy laid down by the company.
                	<br><br>
                	<strong><i>Termination of Employment</i></strong>
                	<br>
                	This appointment is subject to one month's notice in writing by either party subject to the following additional obligations where termination takes place in the following circumstances:<br>
                	i. Termination of your employment by you<br>
                	You are required to provide us with a minimum of 1 month prior notice if you decide to terminate your employment with us. In the event that you:<br>
                	• fail to provide a minimum of 1 months notice; <br>
                	• fail to work through that 1 month notice period and co-operate in an orderly handover of your work,<br>
                	 You shall forfeit the one month salary.
                	<br><br>
                		ii. Termination of your employment by us<br>
                	The Company retains its right to summarily dismiss you with pay for which you worked upon in the appropriate circumstances such as when you have been considered guilty of misconduct or fraudulence.
                	<br><br>
                	For a period of 3 months, the Company may, in circumstances in which it reasonably believes that you are guilty of misconduct or in breach of your employment terms in order that the circumstances giving rise to that belief may be investigated, suspend you from the performance of your duties or exclude you from any premises of the Company and need not give any reason for so doing. Remuneration will not cease to be payable by reason only of such suspension or exclusion.
                	<br><br>
                	<strong><i>Restrictions after termination</i></strong>
                	<br>
                	You covenant with us that you will not at any time in any Capacity in any Restraint Area during the Restraint Period:<br>
                	(a) Induce or attempt to induce any of the employees of the Company or its clients which shall to terminate their agreements or contracts with the Company;<br>
                	(b) Solicit or attempt to solicit the business or customer of any client of the Company which shall include (excluding persons who become clients of the Company and its clients after the date of termination of the employment), or any person who during the twelve months preceding termination of the employment with the Company.<br>
                	(c) Solicit or attempt to solicit the business or customer of any person whose business or custom the Company was, to the knowledge, cultivating at the time of termination of your employment with the Company. You separately enter into each of the covenants resulting from the combination of each separate Capacity in clause (Restriction after termination) with each separate Restraint Area in clause (Restriction after termination) and with each separate Restraint Period with the Company. Each of those covenants constitutes a separate covenant given by you. If any one or more of those separate covenants is or becomes invalid or unenforceable for any reason, that invalidity or unenforceability will not affect the validity or enforceability of any of the other separate covenants which remain binding on you.
                
                	<br><br>
                	You acknowledge that these obligations are:<br>
                	(a) Fair and reasonable in regard to the subject matter, area and duration;<br>
                	(b) Reasonably required by the client to protect its business and goodwill and financial interests;<br>
                	(c) Given voluntarily and without any coercion or pressure.<br>
                	<br><br>
                
                	If any provision is void, voidable by each party, unenforceable or illegal it must be read down so as to be valid and enforceable or, if it cannot be read down, the provision (or where possible, the offending words) must be severed from this obligation without affecting the validity or enforceability of the remaining provisions (or parts of those provisions) of this obligations which must continue in full force and effect.<br>
                	The obligations set out above are made in favour of the Company and may be enforced by it by injunction proceedings without prejudice to any other rights or remedies which it may have.
                	<br>
                	<strong>Capacity</strong> means any capacity whatever including (without limitation) as a shareholder, director, sole trader, partner, joint venture, consultant, agent, employee or adviser; <strong>Restraint Area</strong> Means India.
                	<br><br>
                	<strong>Restraint Period</strong> means 12 months commencing from the date of termination of your employment or any lesser amount considered appropriate by an appropriate court.
                	<br><br>
                	<strong><i>Representation by Employee</i></strong>
                	<br>
                	You represent that to the best of your knowledge, you have no commitments to former employers or other entities that would restrict you're joining the Company. You also confirm that your services have not been terminated by your previous employer for misconduct or for other similar cause.<br>
                	You will not directly or indirectly engage in any business or serve, whether as principal agent, partner, consultant, employee or contractor or in any other capacity either full time or part-time, whatsoever, other than that of the Company.
                	<br><br>
                
                	<strong><i>Confidentiality and Intellectual Property</i></strong>
                	<br>
                	You must not, at any time during your employment (except if required under law) or after its termination, divulge to any third party or otherwise make use of any trade secret or confidential information, which comes to your knowledge during your employment relating to the business of the Company. You will use your best endeavours to prevent use or disclosure of such confidential information by third parties.
                	<br><br>
                
                	For the avoidance of doubt 'confidential information' includes, but is not restricted to, all documentary and other information relating to the Company's business, either in hard or soft copy, including in particular client lists, details of the company's finances, clients or suppliers, staff of the Company and its Directors or Managers. It also 
                	includes all information in respect of which the Company is bound by an obligation of confidentiality to a third party. In relation to intellectual property and for the avoidance of doubt:
                	<br><br>
                	(a) All intellectual property rights in the work you perform for the Company are assigned with full title guarantee to the Company; and <br>
                	(b) You waive all moral and similar non-transferable rights that you may have in such work; and<br>
                	(c) At the Company's request and cost, you shall execute such documents and/or take such other steps as may reasonably be necessary to properly transfer such rights to the Company or its nominee and otherwise to secure, protect and enforce such rights.
                	<br>
                	In the event of your resignation / termination of employment, you will be required to confirm in writing that you have returned all confidential information and property belonging to the Company, and that you have not retained any copies or circulated any copy to third parties, and that you have no access to copies.<br>
                	These restrictions will cease to apply to information or knowledge which you are required to disclose by law, or which comes into the public domain otherwise than through unauthorised disclosure by you.<br>
                	Any breach of confidentiality is viewed very seriously by the Company and will result in immediate termination of employment, without any notice pay or other termination payments.<br>
                
                	<br><br>
                	<strong><i>Undertaking/Code of Conduct/Code of Business Ethics</i></strong>
                	<br>
                	All aspects of the Firm's business as well as clients are to be treated as strictly private and confidential. Accordingly, all staff is required to sign and return the attached Undertaking to Employer. As your services shall be extended or you shall be required to acknowledge agreement to comply and to execute against the company internal Code of Conduct and Code of Business Ethics. At all times whilst your services continue to be extended to company You shall comply with its prevailing Code of Conduct and Code of Business Ethics.
                	<br><br>
                	<strong><i>Confidentiality Undertaking</i></strong>
                	<br>
                	You shall at all times treat as and keep confidential all information that is the property of the Company that has not lawfully entered the public domain, which includes but is not limited to the names and other information contained within the company or clients database (as defined below), which you may become aware of during the course of your employment; You shall not use or divulge any of the information referred to above either during the period of employment or after employment ceases, other than:
                	<br>
                	• In the ordinary course of your employment;<br>
                	• With the prior written consent from the Company.<br>
                	• For the purpose of obtaining legal or financial advice; or<br>
                	• Where ordered to disclose by a Court, Commission, or Tribunal or mediation conference in any jurisdiction.<br>
                	In this clause Database includes but is not limited to:<br>
                	• Names, addresses and phone numbers of sellers, buyers and prospective sellers and buyers or the names addresses and phone numbers of any property owner on whose behalf a property is managed by company.<br>
                	• Financial information<br>
                	• Company contract information.
                	<br><br>
                	Your appointment is subject to the enclosed undertaking regarding confidential information and occupations in conflict with the Company's and that of its interest and you are required to sign the attached <i>Confidentiality Undertaking</i> prior to commencement.
                	<br><br>
                	<strong><i>Company Policies</i></strong>
                	<br>
                	It is an essential condition of your employment that you must comply with all existing, reviewed and new Company policies and procedures. Any breach of Company's policies or procedures may lead to disciplinary action.
                	<br><br>
                	<strong><i>IT Policy</i></strong>
                	<br>
                	The Company has an IT Policy, which covers the acceptable use of these systems, which you may be required to access at some stage in the course of your employment with the Company You are required to sign the Acceptance page at the end of the Internet / E-mail Acceptable Use Policy as part of your conditions of employment.
                	<br><br>
                	<strong><i>Sexual Harassment</i></strong>
                	<br>
                	It is the Company's policy to prohibit in our workplace any conduct, which constitutes sexual harassment. The Firm has a policy on sexual harassment. It guarantees to deal with allegations of harassment seriously, promptly and in confidence and undertakes to protect from victimization those employees who complain about sexual harassment.
                	<br><br><br>
                	<strong><i>Severance</i></strong>
                	<br>
                	If any provision of this contract of employment is declared or determined to be illegal or invalid by final determination of any court or tribunal of competent jurisdiction, the validity of the remaining parts, terms or provisions of this contract shall not be affected, and the illegal or invalid part, term or provision shall be deemed not to be part of this contract.
                	<br><br>
                	<strong><i>General</i></strong>
                	<br>
                	a) You will be required to apply yourself wholly to the Company's business and no work is to be undertaken in a private capacity which conflicts with that of the Company or its clients.<br>
                
                	b) In the event of any disagreement over the interpretation of the above, the decision of the directors will be final.
                	<br><br>
                	<strong><i>Reimbursement of Expenses</i></strong>
                	You will keep records of all your professional expenses, including travel expenses incurred by you, as a result of your work on behalf of the Company. The Company will reimburse you for such expenses upon presentation of supporting documentation in accordance with the Company's established reimbursement policies.
                	<br><br>
                	<strong><i>Company's Property</i></strong>
                	You will always maintain in good condition and safeguard the Company's property which may be given to you for official use during the course of your employment and will return the same to the Company immediately on 
                	demand or on relinquishment of your services failing which the cost of the same will be recovered from you by the Company.
                	<br><br>
                	<strong><i>Information</i></strong>
                	You will provide to the company such complete and accurate information about yourself as may be required from time to time and keep the company informed about any changes in the same. If such information is found to be false, your services may be terminated by the Company.
                	<br><br>
                	Please sign a copy of this letter in token of your acceptance of the terms and conditions of service as indicated above. If the terms and conditions in this offer are acceptable to you, please sign and return to us.
                	<br><br>
                	<strong>Yours sincerely,<br>".$hr_name."</strong>
                	<p>
                	<img src=\"./".$comp_stamp."\" height=\"85px\" width=\"210px\" style=\"margin-top:0px;\">
                	</p>
                
                
                	<i>I .................................................................................................. accept the above terms and conditions of employment with</i> <strong>".$comp_add."</strong>
                	<br><br><br><br>
                	Signature................................. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date ..................
                	<br><br>
                
                	<br>
                	<div></div><div></div><div></div><div></div>
                	<table style=\"border:1px solid #000;\">
                	<tr style=\"font-size:22px; color:#fff; background-color:#000;  \">
                	<td style=\"text-align:center; padding:10px; height:35px; position:relative; top:5px;\"><strong>Annexure 1 - ".$gender." ".$emp_name." (".$empresult['emp_id'].")</strong></td>
                	</tr>
                	<tr style=\"font-size:18px; color:#fff; background-color:#333;\">
                	<td style=\"text-align:center; height:25px;\"><strong>Salary Structure with effect from ".date("d-M, Y", strtotime($empresult['emp_doj']))."</strong></td>
                	</tr>
                	<tr style=\"color:#000; border:1px solid #000;\">
                	<td style=\"height:20px;\"><strong>Designation:</strong> ".$empresult['emp_designation']."</td>
                	</tr>
                	</table>
                
                	<div></div>
                	<table style=\"border:1px solid #000; \">
                
                	<tr style=\"font-size:18px; color:#fff; background-color:#333; padding:10px;\">
                	<td style=\"border:1px solid #000; text-align:left; \">Details</td>
                	<td style=\"border:1px solid #000; text-align:right; \">Current</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">Total Cost to Company (CTC - Rs. Per Annum)</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$ctc."</td>
                	</tr>
                
                	</table>
                
                	<div></div>
                	<table style=\"border:1px solid #000; \">
                
                	<tr style=\"font-size:18px; color:#fff; background-color:#333; padding:10px;\">
                	<td style=\"border:1px solid #000; text-align: left; \">Components</td>
                	<td style=\"border:1px solid #000; text-align: right; \">Rs. Per Annum</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">Basic Pay</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$basic."</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">House Rent Allowance (HRA)</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$hra."</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">Special Personal Allowance</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$spec_allowance_ctc."</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">LTA</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$lta_ctc."</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">Communication Expenses</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$cumm_exp_ctc."</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\">Medical Reimbursement</td>
                	<td style=\"border:1px solid #000; text-align:right; \">".$medi_reiub_ctc."</td>
                	</tr>
                
                	<tr>
                	<td style=\"border:1px solid #000; text-align:left;\"><strong>Total Cost to Company (CTC)</strong></td>
                	<td style=\"border:1px solid #000; text-align:right; \"><strong>".$total_ctc."</strong></td>
                	</tr>
                
                	</table>
                	<br><br><br>
                	For computation of the above, the year considered will be financial year. Tax liability, if any will be to the employee's account.
                
                	
                	<div></div>
                	<table>
                	<tr>
                	    <td><img src=\"./".$comp_stamp."\" height=\"85px\" width=\"210px\" style=\"margin-top:0px;\"></td>
                	    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Employee Name:</strong></td>
                	</tr>
                	<tr>
                	<td><strong>".$hr_name."</strong></td>
                	<td><strong>Employee Signature:</strong></td>
                	</tr>
                	</table>
                	
                
                	<table>
                	<tr>
                	<td><strong>Manager– Human Resources</strong></td>
                	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date:</strong></td>
                	</tr>
                
                	</table>
                	<br><br><br>
                	</p>";
                
                
                	require_once('tcpdf/config/lang/eng.php');
                	require_once('tcpdf/tcpdf.php');
                 
                
                   // $hederlogo= 'https://exp.xapotechsystems.com/admin/'.$result1['comp_letterhead_header'];
                    //$footerlog= 'https://exp.xapotechsystems.com/admin/'.$result1['comp_letterhead_footer'];
                      //  $hederlogo=  $result1['comp_letterhead_header'];
                     //   $footerlog= $result1['comp_letterhead_footer'];
                    
                        //echo $hederlogo; 
                        //echo $footerlogo; die;
                        
                        
                        class MYPDF extends TCPDF {
                        var $xfootertext  = '';
                        var $xheadertext  = '';
                      
                       
                        public function Footer() {
                        $this->SetX(1000);
                        $this->SetY(-40);
                      //  $this->Image($this->xfootertext,0,745,600,30, '', '', '', true, 300, '', false, false, 0);
                        	$this->Image($this->xfootertext,0,772,598,70, '', '', '', true, 300, '', false, false, 0);
                   //     $this->Cell(0, 10, ''.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
                        $this->writeHtml(false,false); 
                        }
                        
                        public function Header() {
                        $this->SetY(10);
                        $this->SetX(10);
                         $this->Image($this->xheadertext,0,0,600,100, '', '', '', true, 300, '', false, false, 0);
                        //  Image( filename, left, top, width, height, type, link, align, resize, dpi, align, ismask, imgmask, border, fitbox, hidden, fitonpage)
                        $this->writeHtml(false,true);
                        
                    }
                }
                
                    $file_name = $emp_name."_Appointment_Letter.pdf";
                	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'px', 'A4', true, 'UTF-8', true);
                	$pdf->SetMargins(30, 150,-1,true);
                	$pdf->SetPrintHeader(true);
                 	$pdf->SetPrintFooter(true);
                 	$pdf->SetAutoPageBreak(true, 50); 
                 	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                 	$pdf->setLanguageArray($l);
                 	$pdf->SetFont('times', '', 11);
                	$pdf->xfootertext = $footerlogo;
                	$pdf->xheadertext = $hederlogo;
                	$pdf->AddPage();
                	$pdf->writeHTML($html, true);
                	ob_end_clean();
                	$pdf->Output($file_name, 'D');
                
            }
                    
                if(@$_POST['b1'] == 'Experience Letter')
                {  
  
                     // echo "<pre>";print_r($hederlogo);die;
                            $html = "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date: ".date("d-M, Y", strtotime($aprolresult['new_dor']))."</strong></p><div></div><div></div><div></div>
                    <div style=\"margin: 0px auto; width:700px; text-align:center; padding-top:100px; font-size:20px; font-weight:bold; \"><u>TO WHOMSOEVER IT MAY CONCERN</u></div>
                    <p style=\"line-height:23px; text-align:justify;\">This is to certify that <strong>".$empresult['gender']." ".$emp_name.", Emp Code- ".$aprolresult['emp_id']."</strong> was associated with us from <strong>".date("d-M, Y", strtotime($empresult['emp_doj']))."</strong> to <strong>".date("d-M, Y", strtotime($aprolresult['new_dor']))."</strong>. At the time of leaving the company's services, he/she was designated as <strong>".$aprolresult['new_designation']."</strong>. He/She has been relieved of his duties and responsibilities on close of business on <strong>".date("d-M, Y", strtotime($aprolresult['new_dor']))."</strong>. We appreciate the contribution made by him/her during the tenure with  <strong>".$comp_name."</strong></p>
                    
                    <p>We wish him/her all the best in his/her all future endeavours.</p>
                    <p><strong>".$hr_name."</strong><br>(Manager-Human Resources)</p>
                    <p><td><img src=\"./".$result1['comp_stamp']."\" height=\"85px\" width=\"210px\" style=\"margin-top:50px;\"></td></p>
                    <div></div><div></div>
                    
                    <div></div><div></div>
                    <p></p>";
                    		//echo $html;die;
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
                    			//	$this->Cell(0, 10, ''.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
                    				//$this->writeHtml(false,true); 
                    			}
                    		 public function Header() {
                    			$this->SetY(10);
                    			$this->SetX(10);
                    			 $this->Image($this->xheadertext,0,0,600,100, '', '', '', true, 300, '', false, false, 0);
                    			//$this->writeHtml(false,true);
                    		}
                    	}
                           $file_name = $emp_name."_Experience_Letter.pdf";
                    
                    	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'px', 'A4', true, 'UTF-8', false);
                    	$pdf->SetMargins(60, 200,-1,true);
                    	$pdf->SetPrintHeader(true);
                     	$pdf->SetPrintFooter(true);
                     	$pdf->SetAutoPageBreak(true, 50); 
                     	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                     	$pdf->setLanguageArray($l);
                     	//$font1 = $pdf->addTTFfont('tcpdf/fonts/Garamond_Regular.ttf', 'TrueTypeUnicode', '', 32);
                     	$pdf->SetFont('times', '', 13);
                    	$pdf->xfootertext = $footerlogo;
                    	$pdf->xheadertext = $hederlogo;
                    	$pdf->AddPage();
                    	$pdf->writeHTML($html, true);
                    	ob_end_clean();
                    	$pdf->Output($file_name, 'D');
                }        
                      
                if($_POST['b1'] == 'Salary Slip')
                    {
                            //echo "<pre>"; print_r($_POST);die;
                           // echo "<pre>"; print_r($aprolresult); die;
                            //echo "pre"; print_r($result1); die();      
                            //echo "<pre>"; print_r($_REQUEST); 
                            //echo "<pre>"; print_r($result1); die; 
                            /*$query = "select * from companies where comp_name='".$_POST['companies']."'";
                            $get1 = mysqli_query($con_exp,$query);
                            $result1 = mysqli_fetch_assoc($get1);*/
                    
                    
                           if(($_POST['letterhead'])=='letterhead'){
                                $tableheading = "";
                                   $size = 100;
                               }else{
                           
                            $tableheading = "<table><tr><td style=\"border:1px solid #000; text-align:center; width:60%; height:100px; margin-top:50px;\"><div></div><span style=\"font-size:26px;\">".$comp_name."</span><br><span style=\"font-size:13px;\">(".$result1['company_address2'].")</span></td><td style=\"border:1px solid #000; text-align:center; width:40%; height:100px; padding-top:20px;\"><div></div><img src=\"/admin/".$result1['comp_logo']."\" height=\"70px\" width=\"150px\" style=\"margin-top:50px;\"></td></tr></table>";
                                  $size = 15;
                                } 
                            //echo "<pre>"; print_r($result1); die;
                    $img = $result1['comp_logo']; 
            	    $hr_name  = $result1['hr_name'];
            		//echo "<pre>"; print_r($_POST);
            	    setlocale(LC_MONETARY, 'en_IN');	  
            	    //$month_of_salary_slip = $_REQUEST['month_of_salary_slip'];
            	    $month_of_salary_slip = $aprolresult['new_slipsyear'];
            	    //$month_of_salary_slip =  implode(" ","month_chk");
            	    $newctc = $aprolresult['new_ctc'];
            	    $net_pay = $aprolresult['new_netpay'];
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
                 $new_month_chk=  unserialize ($aprolresult['new_month_chk']);
            if(isset($new_month_chk) && is_array($new_month_chk)){
            	$all_sal_month = $new_month_chk;
            
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
                <tr>
                    <td style=\"border:1px solid #000; text-align:center; font-size:16px; font-weight:bold;\"><u>Salary slip for the month of ".$sal_month." ".$month_of_salary_slip."</u></td>
                </tr>
            </table>
            
            <table cellpadding=\"4\">
                <tr>
                    <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; font-weight:bold;\"> Employee Code</td>
                    <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; \"> ".$empresult['emp_id']."</td>
                    <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; font-weight:bold;\"> Employee Name</td>
                    <td valign=\"middle\" style=\"border:1px solid #000; text-align:left;\"> ".$emp_name."</td>
                </tr>
                
                <tr>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Date of Joining</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> ".date("d-M, Y", strtotime($empresult['emp_doj']))."</td>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Bank</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> N.A</td>
                </tr>
                
                <tr>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Department</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> ".$empresult['emp_department']."</td>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Bank A/C No.</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> N.A</td>
                </tr>
                
                <tr>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> PF No.</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> N.A</td>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Pay Mode</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> ".$empresult['emp_paymode']."</td>
                </tr>
                
                <tr>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Designation</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> ".$aprolresult['new_designation']."</td>
                    <td style=\"border:1px solid #000; text-align:left; font-weight:bold; \"> Net Pay (INR)</td>
                    <td style=\"border:1px solid #000; text-align:left; \"> INR ".round($aprolresult['new_netpay'])."</td>
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
                    <td valign=\"middle\" style=\"border:1px solid #000; text-align:left; width:393px;\"><strong> Components</strong></td>
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
                    <td valign=\"middle\" style=\"border:1.5px solid #000; text-align:left;\"><strong> Net Amount Pay : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INR  ".round($aprolresult['new_netpay'])."</strong><br> <span style=\"font-size:13px;\">(".ucwords($data)." Only)</span>
                     </td>
                </tr>
               
               
            </table>
            
            <table><tr><td></td><td>
                 <p>
    	         <img src=\"./".$salary_stamp."\" height=\"85px\" width=\"100px\" style=\"margin-top:-10px;text-align:right;\">
                 </p></td></tr>
            </table>
             
            
            </p>";
            	
            	}
            } 
            //echo $_REQUEST['comp_address2'];
            //echo "<pre>";print_r($html);echo "</pre>";
            	require_once('tcpdf/config/lang/eng.php');
            	require_once('tcpdf/tcpdf.php');
            	
            		class MYPDF extends TCPDF {
            			//public $xfootertext  = '';
            			//public $xheadertext  = '';
            			public function Footer() {
            				$this->SetX(-10);
            				$this->SetY(-40);
            				//$this->Image($this->xfootertext,0,745,598,98, '', '', '', true, 300, '', false, false, 0);
            				//$this->Image($this->xfootertext,0,772,598,70, '', '', '', true, 300, '', false, false, 0);
            				$this->Image($this->xfootertext,0,772,598,100, '', '', '', true, 300, '', false, false, 0);
            			//	$this->Cell(0, 10, ''.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
            				//$this->writeHtml($this->xfootertext,true); 
            			}
            			public function Header() {
            				$this->SetY(1);
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