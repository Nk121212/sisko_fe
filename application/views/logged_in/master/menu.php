<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="col-sm-12">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="col-sm-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalMenu"><i class="fa fa-plus" aria-hidden="true"></i> <?=$breadcrumb_2?></button>
            </div>
            <div class="col-sm-12 table-responsive NILAI">
                <table class="table table-bordered text-center" id="tblMenu">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Class</th>
                            <th>Href</th>
                            <th>Controller</th>
                            <th>Function</th>
                            <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalMenu">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmAddMenu">  
                <div class="modal-body">
                    
                    <div class="row">
                        
                        
                        <div class="form-group col-sm-6">
                            <label for="menu">Menu</label>
                            <input type="text" class="form-control" id="menu" name="menu">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="class">Class</label>
                            <input type="text" class="form-control" id="class" name="class">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="href">Href</label>
                            <input type="text" class="form-control" id="href" name="href">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="controller">Controller</label>
                            <input type="text" class="form-control" id="controller" name="controller">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="function">Function</label>
                            <input type="text" class="form-control" id="function" name="function">
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMenuUpdate">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmUpdateMenu">  
                <div class="modal-body up_mod">
                    
                    <div class="row">
                        
                        <input type="hidden" id="id" name="id">
                        
                        <div class="form-group col-sm-6">
                            <label for="menu">Menu</label>
                            <input type="text" class="form-control" id="menu" name="menu">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="class">Class</label>
                            <input type="text" class="form-control" id="class" name="class">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="href">Href</label>
                            <input type="text" class="form-control" id="href" name="href">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="controller">Controller</label>
                            <input type="text" class="form-control" id="controller" name="controller">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="function">Function</label>
                            <input type="text" class="form-control" id="function" name="function">
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

        var dataTable = $('#tblMenu').DataTable( {

            ajax: {
                url: "<?=base_url()?>getMenuAll",
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
                {data: "class", orderable:false},
                {data: "href", orderable:false},
                {data: "controller", orderable:false},
                {data: "function", orderable:false},
                {data: "action", orderable:false}
            ]
        });

        $('form#frmAddMenu').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>menu/add',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '201') ? 'Insert Menu Sukses !' : 'Insert Menu Failed'; 
                    swal_response_insert(data.code, 'Insert Menu', text, 'modalMenu');
                    if(data.code == '201'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblMenu tbody').on('click', 'tr td a.edit', function () {

            $('#frmAddMenu')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>menu/get/id",
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
                    $('.up_mod textarea#'+k).text(v);
                    $('#modalMenuUpdate').modal('show');


                });
                //alert("Data: " + data + "\nStatus: " + status);
            });

            //alert(nip);

        });

        $('form#frmUpdateMenu').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>menu/update/id',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var text = (data.code == '200') ? 'Update Menu Sukses !' : 'Update Menu Failed'; 
                    swal_response_update(data.code, 'Update Menu', text, 'modalMenuUpdate');
                    if(data.code == '200'){
                        dataTable.draw();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        $('#tblMenu tbody').on('click', 'tr td a.delete', function () {

            $('#frmAddMenu')[0].reset();

            var id = $(this).attr('data-id');

            $.post("<?=base_url()?>menu/delete/id",
            {
                id: id
            },
            function(data){
                console.log(data);
                var text = (data.code == '200') ? 'Delete Menu Sukses !' : 'Delete Menu Failed'; 
                swal_response_delete(data.code, 'Delete Menu', text);
                if(data.code == '200'){
                    dataTable.draw();
                }

            });

            //alert(nip);

        });

    })


    
</script>