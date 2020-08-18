

<?php 
if($_GET['url'] == 'Home/index'){
  echo '<div class="topnav" id="myTopnav" style="top: 0;">
  <a href="#"><span></span><span></span><span></span><span></span>Main</a>
  <a href="#portfolio"><span></span><span></span><span></span><span></span>Portfolio</a>
  <a href="#contact"><span></span><span></span><span></span><span></span>Contact</a>
  <a href="../../../docs/Haddad_Karim_CV.pdf"  target="_blank">
    <span></span><span></span><span></span><span></span>Check My Resume
  </a>
  <a href="javascript:void(0);" class="icon" onclick="expand()">
    <i class="fa fa-bars"></i>
  </a>
</div>';

}else{

  echo '<div class="topnav" id="myTopnav" style="top: 0;">
  <a href="/Home/home#"><span></span><span></span><span></span><span></span>Main</a>
  <a href="/Home/home#portfolio"><span></span><span></span><span></span><span></span>Portfolio</a>
  <a href="/Home/home#contact"><span></span><span></span><span></span><span></span>Contact</a>
  <a href="../../../docs/Haddad_Karim_CV.pdf"  target="_blank">
    <span></span><span></span><span></span><span></span>Check My Resume
  </a>
  <a href="javascript:void(0);" class="icon" onclick="expand()">
    <i class="fa fa-bars"></i>
  </a>
</div>';
}

  
  
  ?>

<?php $this->view('/Shared/scripts'); ?>
