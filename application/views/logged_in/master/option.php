<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="col-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalOption"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblOption">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Opsi</th>
                            <th>KETERANGAN</th>
                            <th>API</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalOption">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddOption">  
                <div class="modal-body">
                    
                    <div class="col-12 row">
                        
                        
                        <div class="form-group col-12">
                            <label for="nama_opsi">Nama Opsi</label>
                            <input type="text" class="form-control" id="nama_opsi" name="nama_opsi">
                        </div>
                        <div class="form-group col-12">
                            <label for="api">API</label>
                            <input type="text" class="form-control" id="api" name="api">
                        </div>
                        <div class="form-group col-12">
                            <label for="keterangan">KETERANGAN</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="20" rows="5"></textarea>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalOptionUpdate">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdateOption">  
                <div class="modal-body up_mod">
                    
                    <div class="col-12 row">
                        
                        <input type="hidden" name="id" id="id">
                        <div class="form-group col-12">
                            <label for="nama_opsi">Nama Opsi</label>
                            <input type="text" class="form-control" id="nama_opsi" name="nama_opsi">
                        </div>
                        <div class="form-group col-12">
                            <label for="api">API</label>
                            <input type="text" class="form-control" id="api" name="api">
                        </div>
                        <div class="form-group col-12">
                            <label for="keterangan">KETERANGAN</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="20" rows="5"></textarea>
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

        //option_all('');

        var dataTable = $('#tblOption').DataTable( {

            ajax: {
                url: "<?=base_url()?>getOptionAll",
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
                {data: "nama_opsi", orderable:false},
                {data: "keterangan", orderable:false},
                {data: "api", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddOption').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>option/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? 'Insert Option Sukses !' : 'Insert Option Failed'; 
                    swal_response_insert(data.code, 'Insert Option', text, 'modalOption');
                    if(data.code == '201'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblOption tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddOption')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>option/get/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                $.each(data.data[0], function(k, v) {
                    /// do stuff
                    console.log(k);
                    console.log(v);

                    $('.up_mod input#'+k).val(v);
                    $('.up_mod textarea#'+k).text(v);
                    $('#modalOptionUpdate').modal('show');


                });
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdateOption').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>option/update/id',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? 'Update Option Sukses !' : 'Update Option Failed'; 
                    swal_response_update(data.code, 'Update Option', text, 'modalOptionUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblOption tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddOption')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>option/delete/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Option Sukses !' : 'Delete Option Failed'; 
                swal_response_delete(data.code, 'Delete Option', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>