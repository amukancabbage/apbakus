<?php
    if($_GET) {
		if(isset($_POST['btnSave'])){
			$pesanError = array();
			$pesanSuccess = array();
			$namaForm = $_POST['txtNamaTable'];
			$namaTable = $_POST['selTable'];
			$folderOutput = "pages/generated";	
			if (!file_exists($folderOutput) )
			    mkdir($folderOutput);				

			$pageSql="SELECT $namaTable.* FROM ".$namaTable;
			$jmlField = getColumnNumber($koneksidb,$pageSql)-1;  

			if (trim($_POST['selTable'])=="") {
				$pesanError[] = "Data <b>Nama Form</b> tidak boleh kosong !";		
			}
			if (count($pesanError)>=1 ){        
                $noPesan=0;
                foreach ($pesanError as $indeks=>$pesan_tampil) { 
                    $noPesan++; 
                    echo '<div class="alert alert-warning">'.$noPesan.'. '.$pesan_tampil.'</div><br>';	
				} 		
			}else{
				$pesanSuccess[]="File ".$namaForm." Berhasil Dibuat !! "; 
				$noPesan=0;
				foreach ($pesanSuccess as $indeks=>$pesan_tampil) { 
					$noPesan++; 
					echo '<div class="alert alert-success">'.$pesan_tampil.'</div><br>';	
				} 
				echo "</div> <br>"; 

				buatConfig($folderOutput, $namaForm, $koneksidb, $namaTable,$jmlField);
				//buatDelete($folderOutput, $namaForm, $namaTable);
				//buatData($folderOutput, $namaForm, $namaTable,$jmlField);
				//buatEdit($folderOutput, $namaForm, $namaTable,$jmlField);
				//editBukafile($folderOutput, $namaForm);
				//buatMenu($namaForm);
			}
		}
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
                    <form action="?page=Generator" method="post" name="form1" target="_self" id="form1" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label for="selTable" class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Table</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" data-live-search="true" name="selTable">
                                <option value="">-- Pilih Tabel --</option>
                            <?php
                                //$result = mysqli_query($koneksidb,"show tables"); // run the query and assign the result to $result
                                $tables = getDataAll($koneksidb,"SHOW TABLES");
                                foreach($tables as $table){
                                    echo "<option value='$table[0]'> table $table[0] </option>";
                                }
                            ?>
                            </select>
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtNamaTable">Nama Form <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="txtNamaTable" name="txtNamaTable" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                    
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