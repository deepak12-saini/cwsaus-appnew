<style>

.navbar {
  background: #0d0f11 none repeat scroll 0 0;
  padding-bottom:13px;
}

.navbar.sticky_nav {
  background-color: #fff;
  padding: 12px 0;
}

.errorsec {
  box-shadow: 0 1px 11px #909090;
  display: inline-block;
  margin: 100px 0 20px;
  text-align: center;
  width: 100%; overflow:hidden;
}

.errorsec > img {
  margin: -40px 0 -270px;
  width: 370px;
}

.errorsec h1 {
  font-size: 67px;
  font-weight: 400;
  margin: 170px 0 0;
}

.errorsec > p {
  font-size: 20px;
  margin: 10px 0 70px;
}

</style>
<?php $this->layout='';?>
<div class="container">

<div class="errorsec">
<img src="<?php echo SITEURL?>assets/img/loginlogoimg.jpg" alt=""/>
<h1>404 Error</h1>
<p>Page not found <br><a href="<?php echo SITEURL?>" class="btn  btn-warning" name="Clear" onclick="history.back()">
                Back
             </a></p>

</div>


</div>