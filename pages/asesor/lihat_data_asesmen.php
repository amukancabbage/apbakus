<div class="page-title">
    <div class="title_left">
    <h3>Input Data Asesmen <small></small></h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" >
    
   
    <!-- <button type="button" class="btn btn-primary bg-green" data-toggle="modal" data-target=".bs-example-modal-lg"  ><i class="fa fa-plus"></i> TAMBAH DATA</button>

                    <div class="modal fade bs-example-modal-lg"  id = "myModal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah data</h4>
                          
                        </div>
                        <div class="modal-body">
                          <?php //include "kategori_baru.php" ;?>                            
                        </div>
                         <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->

                      <!-- </div>
                    </div>
                  </div>    -->
    <?php
      $tableName = "siswa"; 
      $formName = "Kategori"; 
      $jmlField = "5"; 

      $field[0]="id"; 
      $isian[0]="Id"; 
      $field[1]="created_at"; 
      $isian[1]="Created At"; 
      $field[2]="updated_at"; 
      $isian[2]="Updated At"; 
      $field[3]="status"; 
      $isian[3]="Status"; 
      $field[4]="butir"; 
      $isian[4]="Butir Instrumen"; 
      $field[5]="gambar"; 
      $isian[5]="Gambar"; 

      // $field[5]="deskripsi"; 
      // $isian[5]="Deskripsi"; 
      $arrCriteria = array($id_siswa);
      $mySql = "SELECT asesmen_siswa.*, instrumen.butir AS butir, instrumen.gambar FROM asesmen_siswa 
                    INNER JOIN instrumen ON asesmen_siswa.id_instrumen = instrumen.id 
                    WHERE asesmen_siswa.id_siswa=?";
      showTableAsesmen($koneksidb,$tableName,$isian,$field,$formName,$jmlField,$mySql,$arrCriteria);
        
    ?> 
    <button type="submit" name="simpan" class="btn btn-primary bg-green" ><i class="fa fa-save"></i> SIMPAN DATA</button>
     </form>
    </div>
  </div>
</div>