<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 
    input("text","Nama",1,"","autofocus required"); 
    inputRadio("text","Jenis Kelamin",2,"","required"); 
    input("text","Tanggal Lahir (TGL/BLN/THN)",3,""," data-inputmask=\"'mask': '99/99/9999'\" required");
    input("text","Nama Orang Tua",4,"","required"); 
    inputTextArea("text","Alamat",5,"","required"); 
    input("text","No Kontak",6,"","data-parsley-type=\"digits\" required"); 
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