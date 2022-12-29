<div class="col-sm-12">
    <form id="frmSearchMurid">

        <div class="col-sm-12">
            <div class="row">
                <div class="form-group col-sm-2">
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
                <div class="form-group col-sm-2">
                    <label for="id_kelas">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <?php foreach($list_kelas as $key=>$value): ?>
                            <option value="<?=$value['id']?>"><?=strtoupper($value['kelas'])?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>
                <div class="form-group col-sm-3">
                    <label for="id_pelajaran">Pelajaran</label>
                    <select name="id_pelajaran" id="id_pelajaran" class="form-control" required>
                        <option value="" disabled selected>Pilih Pelajaran</option>
                        <?php foreach($list_pelajaran as $key=>$value): ?>
                            <option value="<?=$value['id']?>"><?=strtoupper($value['nama_pelajaran'])?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>
                <div class="form-group col-sm-3">
                    <label for="id_jenis_nilai">Jenis Nilai</label>
                    <select name="id_jenis_nilai" id="id_jenis_nilai" class="form-control" required>
                        <option value="" disabled selected>Pilih Jenis</option>
                        <?php foreach($list_jenis_nilai as $key=>$value): ?>
                            <option value="<?=$value['id']?>"><?=strtoupper($value['jenis_nilai'])?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <div class="col-sm-2 d-flex p-2" style="margin-top: 1%;">
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

                var my_modal = '<div class="modal hide fade" tabindex="-1" role="dialog" id="nilaiModalAction_'+(index+1)+'"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Absen Action</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><!--form id="frmAbsenAction_'+(index+1)+'"--><div class="modal-body"><input type="hidden" id="id_murid_'+(index+1)+'" name="id_murid" value="'+element.id+'"><div class="col-sm-12 text-center"><img id="image_'+(index+1)+'" src="<?=base_url()?>'+element.image+'" style="width:20%;"><hr><p id="nama">'+element.nama+'</p><p id="telepon">'+element.telepon+'</p><div class="form-group col-sm-12"><input type="number" class="form-control" name="nilai" id="nilai_'+(index+1)+'" placeholder="input nilai"></input></div><hr></div><div class="col-sm-12 row"><div class="col-6"><button class="btn btn-sm btn-danger w-100" type="button" id="cancel" data-dismiss="modal"><i class="fa fa-times"></i> CLOSE</button></div><div class="col-6"><button onclick="add_nilai(\'' + (index+1) + '\', \'' + (element.id) + '\', \'' + (data.length) + '\')" class="btn btn-sm btn-primary w-100" type="submit" id="stat_1"><i class="fa fa-check"></i> SAVE</button></div></div></div><!--/form--></div></div></div>';
                
                //console.log(JSON.stringify(element.id));
                $('#fetch_modal').append(my_modal);
            }

            //indexNow = (index+1);
            show_modal(indexNow);
            
        }

        function show_modal(id_number){

            $('#nilaiModalAction_'+id_number).modal({
                backdrop: 'static',
                keyboard: true, 
                show: true
            });

        }
        
    });

    function add_nilai(number, id_murid, total_siswa, status, keterangan){

        // alert(total_siswa);
        // return false;
        // alert($('#keterangan_'+number).val());
        // return false;

        $.post("<?=base_url()?>nilai/add",
        {
            id_murid: id_murid,
            id_pelajaran: $("#id_pelajaran").val(),
            id_jenis_nilai: $("#id_jenis_nilai").val(),
            nilai: $("#nilai_"+number).val()
        },
        function(data){
            console.log(data);
            if(data.code == '201'){
                $('#nilaiModalAction_'+number).modal('hide');
                var nextNumber = (parseInt(number)+1);
                if(nextNumber <= total_siswa){
                    $('#nilaiModalAction_'+nextNumber).modal('show');
                }else{
                    $('#frmSearchMurid')[0].reset();
                }
            }else{
                alert('insert nilai Gagal !');
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