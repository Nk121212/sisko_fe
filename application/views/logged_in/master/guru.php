<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-sm-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="col-sm-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalGuru"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-sm-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblGuru">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalGuru">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddGuru">  
                <div class="modal-body">
                    
                    <div class="col-sm-12 row">
                        
                        
                        <div class="form-group col-6">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-6">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru">
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalGuruUpdate">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdateGuru">  
                <div class="modal-body up_mod">
                    
                    <div class="col-sm-12 row">
                        
                        
                        <div class="form-group col-6">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" readonly>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-6">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru">
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

        var dataTable = $('#tblGuru').DataTable( {

            ajax: {
                url: "<?=base_url()?>getGuruAll",
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
                {data: "nip", orderable:false},
                {data: "nama_guru", orderable:false},
                {data: "alamat", orderable:false},
                {data: "no_telepon", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddGuru').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>guru/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? 'Insert Guru Sukses !' : 'Insert Guru Failed'; 
                    swal_response_insert(data.code, 'Insert Guru', text, 'modalGuru');
                    if(data.code == '201'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblGuru tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddGuru')[0].reset();

            var nip = $(this).attr('data-nip');

            $.post("<?=base_url()?>guru/get/nip",
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
                    $('#modalGuruUpdate').modal('show');


                });
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdateGuru').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>guru/update/nip',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? 'Update Guru Sukses !' : 'Update Guru Failed'; 
                    swal_response_update(data.code, 'Update Guru', text, 'modalGuruUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblGuru tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddGuru')[0].reset();

            var nip = $(this).attr('data-nip');

            $.post("<?=base_url()?>guru/delete/nip",
            {
                nip: nip
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Guru Sukses !' : 'Delete Guru Failed'; 
                swal_response_delete(data.code, 'Delete Guru', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>