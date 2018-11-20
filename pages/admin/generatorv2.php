<?php
if($_GET) {
  // $txt1="default";
  $txt2="default";

if(isset($_POST['btnSave'])){
  $txt1 = $_FILES['txt1']['name'];
  $locnamefile = "generate/database/".$txt1;
  $myfile = fopen($locnamefile, "r") or die("Unable to open file!");
  $txt2 = fread($myfile,filesize($locnamefile));
  $decoded = json_decode($txt2);
  $txt2 = json_to_create_query($decoded);

  try{
      $result = $koneksidb->prepare($txt2);
      $result->execute();
  }catch(PDOException $e) {
      echo  "Error: " . $e->getMessage();
  }

  $nama_koloms[] = array();
  $nama_koloms = get_nama_kolom($decoded);

  buat_model($decoded->nama_tabel,$nama_koloms);

}
// $dataLauk	= isset($dataShow['namaitem']) ?  $dataShow['namaitem'] : $_POST['txtLauk'];
// $txt1=$_POST['txt1'];
// $txt2=$_POST['txt2'];


}
?>

<div class="page-title">
  <div class="title_left">
    <h3>Form Generator</h3>
  </div>

  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Design <small>different form elements</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form action="?page=Generator" method="post" name="form1" target="_self" id="form1" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

          <?php
          // input("file","Nama Table",1,"","");
          input("file","Nama Table",1,"","required");
          inputTextArea("text","Keterangan",2,$txt2,"required");
          ?>




          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="btnSave" class="btn btn-success">Generate !!</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
