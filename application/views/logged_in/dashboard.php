<div class="col-12">

    <div class="card" style="width: 100%;">
            <div class="card-body">
                
                <div class="row text-center">
                    <h5>List Anak</h5>
                    <hr>
                    <?php foreach($data_murid as $key=>$value): ?>
                        <div class="col-<?=$div?>">
                            <img class="img_round pointer anak" data-toggle="modal" data-target="#modalAbsen" src="<?=$value['image']?>" alt="" id="<?=$value['nik']?>">
                            <p><b><?=$value['nama']?></b></p>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                </div>

            </div>
        </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalAbsen">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
</div>