<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="col-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalPelajaran"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblPelajaran">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelajaran</th>
                            <th>NIP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalPelajaran">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddPelajaran">  
                <div class="modal-body">
                    
                    <div class="col-12 row">
                        
                        
                        <div class="form-group col-6">
                            <label for="nip">Guru</label>
                            <select name="nip" id="nip" class="form-control">
                                <option value="" disabled selected>Pilih Guru</option>
                            </select>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-6">
                            <label for="nama_Pelajaran">Nama Pelajaran</label>
                            <input type="text" class="form-control" id="nama_Pelajaran" name="nama_Pelajaran">
                        </div>
                        <div class="form-group col-6">
                            <label for="no_telepon">No Telp</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                        </div>
                        <div class="form-group col-6">
                            <label for="alamat">ALAMAT</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="20" rows="5"></textarea>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalPelajaranUpdate">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdatePelajaran">  
                <div class="modal-body up_mod">
                    
                    <div class="col-12 row">
                        
                        
                        <div class="form-group col-6">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" readonly>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-6">
                            <label for="nama_Pelajaran">Nama Pelajaran</label>
                            <input type="text" class="form-control" id="nama_Pelajaran" name="nama_Pelajaran">
                        </div>
                        <div class="form-group col-6">
                            <label for="no_telepon">No Telp</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                        </div>
                        <div class="form-group col-6">
                            <label for="alamat">ALAMAT</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="20" rows="5"></textarea>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="<?=base_url()?>plugins/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function(){

        option_all('');

        var dataTable = $('#tblPelajaran').DataTable( {

            ajax: {
                url: "<?=base_url()?>getPelajaranAll",
                data: function(data){
                    //data.search.nik = $("#nik_used").val();
                },
                dataSrc: 'data',
            },
            destroy: true,
            searching: false,
            fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
                return "Show "+iStart+" Sampai "+iEnd+" Dari "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" Entri";
            },
            pagingType: 'full_numbers',
            language: {paginate: {
                first: '<i class="fa fa-step-backward"></i>',
                last: '<i class="fa fa-step-forward"></i>',
                previous: '<i class="fa fa-backward"></i>',
                next: '<i class="fa fa-forward"></i>',
            }},
            paging: true,
            order: [[ 0, "asc" ]],
            dom: 'tip',
            pageLength: 10,
            serverSide: true,
            serverMethod: 'post',
            columns: [
                {data: "no", orderable:false, width: "30px", className: "dt-body-center"},
                {data: "nama_pelajaran", orderable:false},
                {data: "nip", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddPelajaran').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>pelajaran/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? 'Insert Pelajaran Sukses !' : 'Insert Pelajaran Failed'; 
                    swal_response_insert(data.code, 'Insert Pelajaran', text, 'modalPelajaran');
                    if(data.code == '201'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblPelajaran tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddPelajaran')[0].reset();

            var nip = $(this).attr('data-nip');

            $.post("<?=base_url()?>pelajaran/get/nip",
            {
                nip: nip
            },
            function(data){
                console.log(data);
                $.each(data.data[0], function(k, v) {
                    /// do stuff
                    // console.log(k);
                    // console.log(v);

                    $('.up_mod input#'+k).val(v);
                    $('.up_mod textarea#'+k).text(v);
                    $('#modalPelajaranUpdate').modal('show');


                });
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdatePelajaran').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>pelajaran/update/nip',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? 'Update Pelajaran Sukses !' : 'Update Pelajaran Failed'; 
                    swal_response_update(data.code, 'Update Pelajaran', text, 'modalPelajaranUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblPelajaran tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddPelajaran')[0].reset();

            var nip = $(this).attr('data-nip');

            $.post("<?=base_url()?>pelajaran/delete/nip",
            {
                nip: nip
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Pelajaran Sukses !' : 'Delete Pelajaran Failed'; 
                swal_response_delete(data.code, 'Delete Pelajaran', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>