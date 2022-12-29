<link href="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    div.NILAI{
        display:none!important;
    }
    div.ABSEN{
        display:none!important;
    }
    div.show{
        display: inline-block!important;
    }
</style>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
Launch demo modal
</button> -->

<!-- <button id="lb">launch modal by jquery</button> -->

<!-- Modal -->
<div class="modal fade" id="modalDashboard" tabindex="-1" role="dialog" aria-labelledby="modalDashboard" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDashboardLabel">Modal <?=$breadcrumb_2?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select name="id_pelajaran" id="id_pelajaran" class="form-control">
                    <option value="" disabled selected>Pilih Opsi</option>
                    <?php foreach($opsi as $key=>$value): ?>
                        <option data-api="<?=$value['api']?>" value="<?=$value['id']?>"><?=strtoupper($value['nama_opsi'])?></option>
                    <?php endforeach; ?>
                </select>
                <hr>
                <div class="col-sm-12 table-responsive NILAI">
                    <table class="table table-bordered" id="tblNilai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelajaran</th>
                                <th>Jenis Nilai</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-12 table-responsive ABSEN">
                    <table class="table table-bordered" id="tblAbsen">
                        <thead>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Nama Pelajaran</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="nis_used">
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=$breadcrumb_2?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a> -->
</div>

<div class="row">
    <?php foreach($data_murid as $key=>$value): ?>
        <!-- <?=print_r($value);?> -->
        <div class="col-sm-<?=$div?>">
            <div class="card text-center shadow p-3 mb-5 bg-white rounded" style="width: 100%;">
                <img class="card-img-top img-fluid img-rounded" src="<?=base_url()?><?=$value['image']?>" onError="this.onerror=null; this.src='<?=base_url()?>upload/Image_not_available.png';">
                <div class="card-body text-center">
                    <!-- <h5 class="card-title text-justify"><?=$value['nama']?></h5> -->
                    <p><?=$value['nama']?></p>
                    <p><?=$value['alamat']?></p>
                    <a class="btn btn-primary" id="<?=$value['nis']?>" data-toggle="modal" data-target="#modalDashboard">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<hr>

<!-- Page level plugins -->
<script src="<?=base_url()?>plugins/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function(){

        // $('div.NILAI').hide();
        // $('div.ABSEN').hide();


        $('#modalDashboard').on('shown.bs.modal', function (e) {

            $('#id_pelajaran').val('').trigger('change');
            $('input#nis_used').val("");
            //$('#myInput').trigger('focus')
            var target = $(e.relatedTarget);
            var nis = target.attr("id");
            //alert(nik);
            $('#nis_used').val(nis);
        });

        $('#id_pelajaran').change(function(){
            //alert(table);
            //alert($(this).val() );
            if($(this).val() !== "" && $(this).val() !== null){

                var element = $(this).find('option:selected'); 
                //var api = element.attr("data-api");
                //alert(element.text());
                //alert(api);
                var divSelected = element.text();

                if(divSelected == "ABSEN"){
                    $('div.NILAI').removeClass("show");
                    var table = 'tblAbsen';
                    var api = 'getAbsenByNis';
                }else if(divSelected == "NILAI"){
                    $('div.ABSEN').removeClass("show");
                    var table = 'tblNilai';
                    var api = 'getNilaiByNis';
                }

                $('div.'+divSelected).addClass("show");
                
                setTable(table, api);
            }else{
                $('div.NILAI').removeClass("show");
                $('div.ABSEN').removeClass("show");
            }
            
        })

    })

    function setTable(table="", api=""){
        var dataTable = $('#'+table).DataTable( {

            // $(this).DataTable().clear();
            // settings.iDraw = 0;
            // $(this).DataTable().draw();

            ajax: {
                url: "<?=base_url()?>"+api,
                data: function(data){
                    data.search.nis = $("#nis_used").val();
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
            columns: fetchTable(table)
        });
    }

    function fetchTable(table){
        if(table == "tblNilai"){
            return [
                {data: "no", orderable:false, width: "30px", className: "dt-body-center"},
                {data: "nama_pelajaran", orderable:false},
                {data: "jenis_nilai", orderable:false},
                {data: "nilai", orderable:false}
            ];
        }else{
            return [
                {data: "no", orderable:false, width: "30px", className: "dt-body-center"},
                {data: "date", orderable:false},
                {data: "nama", orderable:false},
                {data: "nama_pelajaran", orderable:false},
                {data: "status", orderable:false}
            ];
        }
    }
</script>