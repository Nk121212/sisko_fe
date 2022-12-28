<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-sm-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="col-sm-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalMurid"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-sm-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblMurid">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>NO TELP</th>
                            <th>IMAGE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalMurid">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddMurid">  
                <div class="modal-body">
                    
                    <div class="col-sm-12 row">
                        
                        <div class="form-group col-6">
                            <label for="id">NIS</label>
                            <input type="text" class="form-control" id="id" name="id" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group col-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="form-group col-6">
                            <label for="telepon">No Telp</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>
                        <div class="form-group col-6">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="upload">
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMuridUpdate">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdateMurid">  
                <div class="modal-body up_mod">
                    
                    <div class="col-sm-12 row">
                        <div class="form-group col-6">
                            <label for="id">NIS</label>
                            <input type="text" class="form-control" id="id" name="id" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group col-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="form-group col-6">
                            <label for="telepon">No Telp</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>
                        <div class="form-group col-6">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="upload">
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

        var dataTable = $('#tblMurid').DataTable( {

            ajax: {
                url: "<?=base_url()?>getMuridAll",
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
                {data: "nama", orderable:false},
                {data: "alamat", orderable:false},
                {data: "telepon", orderable:false},
                {data: "image", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddMurid').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>murid/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? data.message : data.message; 
                    swal_response_insert(data.code, 'Insert Murid', text, 'modalMurid');
                    if(data.code == '201'){
                        dataTable.draw();
                        $('#frmAddMurid')[0].reset();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblMurid tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddMurid')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>murid/get/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                $.each(data.data[0], function(k, v) {
                    /// do stuff
                    console.log(k);
                    console.log(v);
                    if(k == 'image'){
                        //dont fetch
                    }else{
                        $('.up_mod input#'+k).val(v);
                        $('.up_mod textarea#'+k).text(v);
                    }
                });

                $('#modalMuridUpdate').modal('show');
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdateMurid').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>murid/update/id',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? data.message : data.message; 
                    swal_response_update(data.code, 'Update Murid', text, 'modalMuridUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                        $('#frmUpdateMurid')[0].reset();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblMurid tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddMurid')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>murid/delete/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Murid Sukses !' : 'Delete Murid Failed'; 
                swal_response_delete(data.code, 'Delete Murid', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>