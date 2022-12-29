<div class="col-sm-12">
    <form id="frmSearchMurid">

        <div class="col-sm-12">
            <div class="row">
                <div class="form-group col-3">
                    <label for="id_tingkat">Tingkat</label>
                    <select name="id_tingkat" id="id_tingkat" class="form-control" required>
                        <option value="" disabled selected>Pilih Tingkat</option>
                        <?php foreach($list_tingkat as $key=>$value): ?>
                            <option value="<?=$value['id']?>"><?=strtoupper($value['tingkat'])?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group col-3">
                    <label for="id_kelas">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <?php foreach($list_kelas as $key=>$value): ?>
                            <option value="<?=$value['id']?>"><?=strtoupper($value['kelas'])?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>
                <div class="form-group col-3">
                    <label for="id_pelajaran">Pelajaran</label>
                    <select name="id_pelajaran" id="id_pelajaran" class="form-control" required>
                        <option value="" disabled selected>Pilih Pelajaran</option>
                        <?php foreach($list_pelajaran as $key=>$value): ?>
                            <option value="<?=$value['id']?>"><?=strtoupper($value['nama_pelajaran'])?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <div class="col-sm-3 d-flex p-2" style="margin-top: 1%;">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                
            </div>
        </div>
        
    </form>
</div>

<div id="fetch_modal">

</div>


<script>
    $(document).ready(function(){

        var recentMurid = [];
        var indexNow = 1;

        $('form#frmSearchMurid').submit(function(e){

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?=base_url()?>murid/get/class',
                //startTime: performance.now(),
                type: 'POST',
                data: formData,
                //enctype: 'multipart/form-data',
                beforeSend: function() {

                    //beforeSendLoading(2);   
                    
                },
                success: function (data) {

                    console.log(data);
                    var i = 0;
                    $.each(data.data, function(k, v) {
                        recentMurid[i] = v;
                        i++;
                    });

                    //console.log('ehem = '+JSON.stringify(recentMurid));
                    fetch_resp(recentMurid);

                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        });

        function fetch_resp(data){
            var id_pelajaran = $("#id_pelajaran").val();
            if(id_pelajaran == "" || id_pelajaran === null){
                alert('silakan pilih pelajaran !');
                $("#id_pelajaran").focus();
            }
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                var my_modal = '<div class="modal hide fade" tabindex="-1" role="dialog" id="absenModalAction_'+(index+1)+'"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Absen Action</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><!--form id="frmAbsenAction_'+(index+1)+'"--><div class="modal-body"><input type="hidden" id="id_murid_'+(index+1)+'" name="id_murid" value="'+element.id+'"><div class="col-sm-12 text-center"><img id="image_'+(index+1)+'" src="<?=base_url()?>'+element.image+'" style="width:20%;"><hr><p id="nama">'+element.nama+'</p><p id="telepon">'+element.telepon+'</p><div class="form-group col-sm-12"><small class="text-danger">*kosongkan jika hadir</small><textarea class="form-control" name="keterangan" id="keterangan_'+(index+1)+'" placeholder="Keterangan"></textarea></div><hr></div><div class="col-sm-12 row"><div class="col-6"><button class="btn btn-sm btn-danger w-100" type="submit" id="stat_0" onclick="add_absen(\'' + (index+1) + '\', \'' + (element.id) + '\', \'' + (data.length) + '\', 2)"><i class="fa fa-times"></i> ALFA</button></div><div class="col-6"><button onclick="add_absen(\'' + (index+1) + '\', \'' + (element.id) + '\', \'' + (data.length) + '\', 1)" class="btn btn-sm btn-primary w-100" type="submit" id="stat_1"><i class="fa fa-check"></i> HADIR</button></div></div></div><!--/form--></div></div></div>';
                
                //console.log(JSON.stringify(element.id));
                $('#fetch_modal').append(my_modal);
            }

            //indexNow = (index+1);
            show_modal(indexNow);
            
        }

        function show_modal(id_number){

            $('#absenModalAction_'+id_number).modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });

        }
        
    });

    function add_absen(number, id_murid, total_siswa, status, keterangan){

        // alert(total_siswa);
        // return false;
        // alert($('#keterangan_'+number).val());
        // return false;

        $.post("<?=base_url()?>absen/add",
        {
            id_murid: id_murid,
            status: status,
            keterangan: $('#keterangan_'+number).val(),
            id_pelajaran: $("#id_pelajaran").val()
        },
        function(data){
            console.log(data);
            if(data.code == '201'){
                $('#absenModalAction_'+number).modal('hide');
                var nextNumber = (parseInt(number)+1);
                if(nextNumber <= total_siswa){
                    $('#absenModalAction_'+nextNumber).modal('show');
                }else{
                    $('#frmSearchMurid')[0].reset();
                }
            }else{
                alert('absen Gagal !');
            }

            return false;

        });

    }

    // $('#absenModalAction').on('shown.bs.modal', function () {
    //     //$('#myInput').trigger('focus')
    //     //alert('aw');
    //     $('#id_murid').val('1');
    // })

    
</script>