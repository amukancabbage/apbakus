<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 
    input("text","Username",1,"","autofocus required"); 
    input("password","Password",2,"","data-parsley-length=\"[6, 25]\" required"); 
    input("password","Password (Ulangi)",3,"","data-parsley-equalto=\"#txt2\" required"); 
    input("text","Nama Lengkap",4,"","required"); 
    input("text","No Kontak",5,"","data-parsley-type=\"digits\" required"); 
    $pilihan = array("Admin","Asesor","User");
    $paluy = array("1","2","3");
    select("Level",6,"",$paluy,$pilihan);
    input("file","Foto",7,"","required");
  ?>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
      <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i> Ulang</button>
      <button type="submit" name="insert" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </div>

</form>