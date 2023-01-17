<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-sm-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="col-sm-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalMappingMurid"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-sm-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblMappingMurid">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Murid</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMappingMurid">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddMappingMurid">  
                <div class="modal-body">
                    
                    <div class="col-sm-12 row">

                        <div class="form-group col-6">
                            <label for="id_user">User</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <option value="" disabled selected>Pilih User</option>
                                <?php foreach ($list_users as $key => $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="id_murid">Murid</label>
                            <select name="id_murid" id="id_murid" class="form-control">
                                <option value="" disabled selected>Pilih User</option>
                                <?php foreach ($list_murid as $key => $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['nama']?></option>
                                <?php endforeach;?>
                            </select>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMappingMuridUpdate">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdateMappingMurid">  
                <div class="modal-body up_mod">
                    
                    <div class="col-sm-12 row">
                        
                        <input type="hidden" name="id" id="id">
                        <div class="form-group col-6">
                            <label for="id_user">User</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <option value="" disabled selected>Pilih User</option>
                                <?php foreach ($list_users as $key => $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="id_murid">Murid</label>
                            <select name="id_murid" id="id_murid" class="form-control">
                                <option value="" disabled selected>Pilih User</option>
                                <?php foreach ($list_murid as $key => $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['nama']?></option>
                                <?php endforeach;?>
                            </select>
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

        var dataTable = $('#tblMappingMurid').DataTable( {

            ajax: {
                url: "<?=base_url()?>getMappingMuridAll",
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
                {data: "nama_user", orderable:false},
                {data: "nama_murid", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddMappingMurid').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>mapping_murid/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? 'Insert Mapping Murid By User Sukses !' : 'Insert Mapping Murid By User Failed'; 
                    swal_response_insert(data.code, 'Insert Mapping Murid By User', text, 'modalMappingMurid');
                    if(data.code == '201'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblMappingMurid tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddMappingMurid')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>mapping_murid/get/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                $.each(data.data[0], function(k, v) {
                    /// do stuff
                    // console.log(k);
                    // console.log(v);

                    $('.up_mod select#'+k).val(v);
                    $('.up_mod input#'+k).val(v);
                    // $('.up_mod textarea#'+k).text(v);
                    $('#modalMappingMuridUpdate').modal('show');


                });
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdateMappingMurid').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>mapping_murid/update/id',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? 'Update Mapping Murid By User Sukses !' : 'Update Mapping Murid By User Failed'; 
                    swal_response_update(data.code, 'Update Mapping Murid By User', text, 'modalMappingMuridUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblMappingMurid tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddMappingMurid')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>mapping_murid/delete/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Mapping Murid By User Sukses !' : 'Delete Mapping Murid By User Failed'; 
                swal_response_delete(data.code, 'Delete Mapping Murid By User', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>