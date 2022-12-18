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
<div class="col-12">

    <div class="card" style="width: 100%;">
            <div class="card-body">
                
                <div class="row text-center">
                    <h5>List Anak</h5>
                    <div class="col-12"><hr></div>
                    
                    <?php foreach($data_murid as $key=>$value): ?>
                        <div class="col-<?=$div?>">
                            <img class="img-fluid img_round pointer anak" data-toggle="modal" data-target="#modalDashboard" src="<?=$value['image']?>" onerror="this.onerror=null; this.src='<?=base_url()?>upload/Image_not_available.png'" alt="" id="<?=$value['nik']?>">
                            <p><b><?=$value['nama']?></b></p>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12"><hr></div>
                </div>

            </div>
        </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalDashboard">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="nik_used">
                    <div class="col-12">
                        <select name="id_pelajaran" id="id_pelajaran" class="form-control">
                            <option value="" disabled selected>Pilih Opsi</option>
                            <?php foreach($opsi as $key=>$value): ?>
                                <option data-api="<?=$value['api']?>" value="<?=$value['id']?>"><?=strtoupper($value['nama_opsi'])?></option>
                            <?php endforeach; ?>
                        </select>
                        <hr>

                        <div class="col-12 table-responsive NILAI">
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

                        <div class="col-12 table-responsive ABSEN">
                            <table class="table table-bordered" id="tblAbsen">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    
</div>

<script>
    $(document).ready(function(){
        // $('div.NILAI').addClass("hide");
        // $('div.ABSEN').addClass("hide");

        $('#modalDashboard').on('shown.bs.modal', function (e) {

            $('#id_pelajaran').val('').trigger('change');
            $('input#nik_used').val("");
            //$('#myInput').trigger('focus')
            var target = $(e.relatedTarget);
            var nik = target.attr("id");
            //alert(link);
            $('input#nik_used').val(nik);
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
                    var api = '';
                }else if(divSelected == "NILAI"){
                    $('div.ABSEN').removeClass("show");
                    var table = 'tblNilai';
                    var api = 'getNilaiByNik';
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
                    data.search.nik = $("#nik_used").val();
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
                {data: "jenis_nilai", orderable:false},
                {data: "nilai", orderable:false}
            ]
        });
    }
</script>