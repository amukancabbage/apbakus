<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
  <?php 
    input("text","Kategori",1,"","autofocus required"); 
    inputTextArea("text","Deskripsi",2,"","required data-parsley-trigger=\"keyup\" data-parsley-minlength=\"20\" data-parsley-maxlength=\"200\" 
            data-parsley-minlength-message=\"Minimal 20 karakter\" data-parsley-validation-threshold=\"10\""); 
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