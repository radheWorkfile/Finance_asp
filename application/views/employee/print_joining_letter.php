
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $getProfile->username;?></title>
<script src="<?php echo base_url('media/mi_doc/jquery.min.js');?>"></script>
<script src="<?php echo base_url('media/mi_doc/html2canvas.js');?>"></script>
<script src="<?php echo base_url('media/mi_doc/jspdf.debug.js');?>"></script>
<script>
function print_pdf()
{
let pdf = new jsPDF();
let section=$('body');
let page= function() {
    pdf.save('<?php echo $getProfile->username;?>.pdf');
   
};
pdf.addHTML(section,page);
closeW();
}

function closeW()
{
	setInterval(function(){ window.close();},500);
}
/*onload="print_pdf()"*/

</script>
</head>
<body onload="print_pdf()">
	
<!--------------------------------------------------------------------------------->	
	<div id="formLayout" style="margin-top: 2rem;padding: 10px;">
		<div class="card noBdr" id="welPrintAr">	
				<img src="<?php echo base_url('media/images/geswa_heading.png');?>" style="padding:1rem 0px 2rem 0px; border-bottom:3px solid #555; width:100%;">
				<div style="text-align:center;margin:6rem 0px 3px 0px;font-size:23px;font-weight:bold;">
					<span class="stcList">New joining welcome letter</span>
				</div>
			<div class="mlDiv">
			  <div class="miScnd">
				<div style="padding-left: 3rem;font-size: 1.5rem;">Sub: Welcome to The New Membership in <strong>Geswa Family</strong>.</div>
<div class="miThrd">
				     <div style="padding-left: 2.5rem;font-size: 1.5rem;">
					 		Dear <div class="memD"><?php echo $getProfile->name;?><br />ID NO. <?php echo $getProfile->username;?></div></div>
							<div class="miwlc">
								Congratulations! You have made the right choice of taking a quantum leap towards financial
								independence and time flexibility with GESWA. We believe both are withing your reach if you take
								the crucial step to join in our company.
							</div>
							<div class="miwlc">
								<span style="text-transform:uppercase; font-weight:700;"><?php echo $getProfile->name;?> (Code : <?php echo $getProfile->username;?> )</span>
								is pleased to welcome you as a new member of our company. And your tenure will be immediately effective from
								<strong><?php echo date('d-m-Y',strtotime($getProfile->create_date));?> </strong>.
							</div>
							<div class="miwlc">
								With your expertise and  charismatic character, we arre thrilled and hopefull that your addition
								would bring prosperity to the company. I am sure if we combine our business ideas, we can 
								certainly carve out a way to address mutual requirements beneficially and growth together.
							</div>
							<div class="miwlc">
								Many esteemed companies have benefitted from the services of our organization, and we still
								provide our services for a comprehensive list of organizations according to their various needs
								ranging from the market survey. 
							</div>
							<div class="miwlc">
								For any further clarifications please don't hesitate to call me or email me at
								<strong>geswa@gmail.com</strong>. I would be delighted to provide you the valuable information.
							</div>
							<div class="miwlc">
								One again, our management and staff would like to extend a warm welcome to you for joining
								our <strong>GESWA</strong> national family.
							</div>
                            
                            <div style="text-align:center;padding:3rem 0px 2rem 0px;font-weight:600;font-family:Copperplate,Papyrus,fantasy;font-size:2rem;color:#2E3195;">
                            	 <img src="<?php echo base_url('media/images/waterMark.png');?>" style="height:25rem;width:30rem; margin:-35rem 0rem 0rem 0rem;opacity: .05;">
         					 </div>
                            
                            
                            
							<div style="text-align:center;padding:0rem 0px 2rem 0px;font-weight:600;font-family:Copperplate,Papyrus,fantasy;font-size:2rem;color:#2E3195;">
                            	See you at the Real Dream !!!
         					 </div>
                             
                            <div id="miArSrSign">
                                  <img src="<?php echo base_url('media/images/arSirSign.png');?>" style="height:10rem;width:15rem; margin:-2rem 0rem -2rem 0rem;">  
                            </div>
                             
							<div style="padding:6rem 0px 8rem 0px;font-size: 1.5rem;">
								<div style=" text-align:right;">Regards,</div>
								<div style="text-align:right;font-weight:900;margin-top:1rem;font-family:'Brush Script MT',cursive;font-size:2.5rem;color: #ac2c06;">
                                	Mr. Arvind Prasad
                                </div>
								<div style="text-align:right;font-weight:600;font-size: 1.1rem;color: #737373;">Managing Director</div>
							</div>
				  </div>
				</div>	
			</div>		  
				</div>	
	</div>	
<!--------------------------------------------------------------------------------->

<style>

.mWaterMrk{background-image: url("<?php echo base_url('media/images/waterMark.png');?>"); background-repeat: no-repeat;
  background-position: 50% 0;
  background-size: cover;}







#formLayout{ height:100%; }
.stcList{background-color: #2E3195;padding: .6rem 2rem .6rem 2rem;color: #fff;border: 1px solid #020446;font-size: 3rem;border-bottom-left-radius: 3rem;border-top-right-radius: 3rem;}
.miScnd{border-left:2px solid #E1CC5F;padding-top: 2rem;}
.miThrd{border-left:2px solid #02a69c;padding:2.5rem 0px 0px 3px;margin: 0px 6px 0px 6px;}
.mlDiv{border-left:2px solid #e54800;margin:4rem 2.2rem 0px 2.2rem;padding:3.5rem 1rem 0px 6px;}
.memD{text-transform:uppercase;margin:-1.73rem 0px 0px 3.5rem;font-weight: bold;}
.miwlc{margin:2rem 0px 2rem 15px;text-align: justify;font-size: 1.5rem;padding-left: 1.5rem;}
#miArSrSign{ width:100%; text-align:right;margin-bottom: -5rem;}

</style>

</body>
</html>