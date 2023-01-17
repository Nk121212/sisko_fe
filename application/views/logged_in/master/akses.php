<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-sm-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            
            <div id="alert-show">

            </div>

            <div class="col-sm-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAkses"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-sm-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblAkses">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Role</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalAkses">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddAkses">  
                <div class="modal-body">
                    
                    <div class="row">
                        
                        
                        <div class="form-group col-sm-6">
                            <label for="id_menu">Menu</label>
                            <select name="id_menu" id="id_menu" class="form-control" required>
                                <option value="" disabled selected>Pilih Menu</option>
                                <?php foreach($list_menu as $key=>$value): ?>
                                    <option value="<?=$value['id']?>"><?=strtoupper($value['menu'])?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="menu" name="menu"> -->
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <?php foreach($list_role as $key=>$value): ?>
                                    <option value="<?=$value['id']?>"><?=strtoupper($value['nama_role'])?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="role" name="role"> -->
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="keterangan">Keterangan</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalAksesUpdate">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdateAkses">  
                <div class="modal-body up_mod">
                    
                    <div class="row">
                        
                        <input type="hidden" id="id_menu" name="id">
                        
                        <div class="form-group col-sm-6">
                            <label for="id_menu">Menu</label>
                            <select name="id_menu" id="id_menu" class="form-control" required>
                                <option value="" disabled selected>Pilih Menu</option>
                                <?php foreach($list_menu as $key=>$value): ?>
                                    <option value="<?=$value['id']?>"><?=strtoupper($value['menu'])?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="menu" name="menu"> -->
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <?php foreach($list_role as $key=>$value): ?>
                                    <option value="<?=$value['id']?>"><?=strtoupper($value['nama_role'])?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="role" name="role"> -->
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="keterangan">Keterangan</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
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

        var dataTable = $('#tblAkses').DataTable( {

            ajax: {
                url: "<?=base_url()?>getAksesAll",
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
                {data: "menu", orderable:false},
                {data: "role", orderable:false},
                {data: "keterangan", orderable:false},
                {data: "status", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddAkses').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>akses/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? 'Insert Akses Sukses !' : 'Insert Akses Failed'; 
                    swal_response_insert(data.code, 'Insert Akses', text, 'modalAkses');
                    if(data.code == '201'){
                        dataTable.draw();
                        $('div#alert-show').append('<div class="alert alert-primary" role="alert"><?=$this->session->flashdata('info');?></div>');
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblAkses tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddAkses')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>akses/get/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                $.each(data.data[0], function(k, v) {
                    /// do stuff
                    // console.log(k);
                    // console.log(v);

                    $('.up_mod input#'+k).val(v);
                    $('.up_mod select#'+k).val(v);
                    $('.up_mod textarea#'+k).text(v);
                    $('.up_mod textarea#'+k).val(v);
                    $('#modalAksesUpdate').modal('show');


                });
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdateAkses').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>akses/update/id',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? 'Update Akses Sukses !' : 'Update Akses Failed'; 
                    swal_response_update(data.code, 'Update Akses', text, 'modalAksesUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                        $('div#alert-show').append('<div class="alert alert-primary" role="alert">'+data.alert+'</div>');
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblAkses tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddAkses')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>akses/delete/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Akses Sukses !' : 'Delete Akses Failed'; 
                swal_response_delete(data.code, 'Delete Akses', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>