$(document).ready(function(){

    //alert('get tabel json disini');
    //code by kukuh
    var tableProfilPajak = $('#tableProfilPajak').DataTable( {
        ajax: {
            url: url+"table/profil_pajak",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 4, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nop", className: "dt-body-center"},
            {data: "nama"},
            {data: "aksi", orderable:false},
            {data: "areaCode", visible: false},
            {data: "userId", visible: false},
        ]
    });
    
    $('#tableProfilPajak tbody').on( 'click', '#detailProfil', function () {
        var data = tableProfilPajak.row( $(this).parents('tr') ).data();
        detailProfil(data['nop'],data['areaCode'],data['userId']);
    } );

    function detailProfil(nop,areaCode,userId){
        $.ajax({
            url: url+'profil_pajak/pbb/detailprofil/', 
            data: {
                nop: nop,
                userId: userId,
                areaCode: areaCode,
            },
            type:"post",
            cache: false,
            success: function(data){
                setDetailProfil(data,areaCode,userId);
                $('#modalDetailProfil').modal('show');
            },
            error: function(data){
                $('#modalError').modal('show');
            }
        });
    }

    function setDetailProfil(data,areaCode,userId){
            $('#wpKtp').text(data['wp']['CPM_WP_NO_KTP'])
            $('#wpAlamat').text(data['wp']['CPM_WP_ALAMAT']);
            $('#wpNama').text(data['wp']['CPM_WP_NAMA']);
            $('#wpRtrw').text(data['wp']['CPM_WP_RT_RW']);
            $('#wpPropinsi').text(data['wp']['CPM_WP_PROPINSI']);
            $('#wpKotaKab').text(data['wp']['CPM_WP_KOTAKAB']);
            $('#wpKecamatan').text(data['wp']['CPM_WP_KECAMATAN']);
            $('#wpKelurahan').text(data['wp']['CPM_WP_KELURAHAN']);

            $('#opAlamat').text(data['op']['CPM_OP_ALAMAT']);
            $('#opRtrw').text(data['op']['CPM_OP_RT_RW']);
            $('#opPropinsi').text("PROPINSI")//text(data['wp']['PROPINSI']);
            $('#opKotaKab').text(data['op']['OP_KOTAKAB']);
            $('#opKecamatan').text(data['op']['OP_KECAMATAN']);
            $('#opKelurahan').text(data['op']['OP_KELURAHAN']);
            $('#opNopInduk').text(data['op']['CPM_NOP']);
            //Data Bumi
            $('#opJenisTanah').text(data['op']['JENIS_TANAH']);
            $('#opLuasTanah').text(data['op']['CPM_OP_LUAS_TANAH']);
            $('#opZnt').text(data['op']['CPM_OT_ZONA_NILAI']);
            $('#opKelasTanah').text(data['op']['CPM_OP_KELAS_TANAH']);
            $('#opNjop').text(data['op']['CPM_NJOP_TANAH']);
            //Data Bangunan
            $('#opJumlahBangunan').text(data['op']['CPM_OP_JML_BANGUNAN']);
            $('#opLspop').empty()
            $('#opLspop').append('<option disabled selected value="">Lihat LSPOP</option>');
            if((data['lspop'])!==null){
                $.each(data['lspop'],function(k,v){
                    var obj = { docId: v['CPM_SPPT_DOC_ID'], opNum: v['CPM_OP_NUM'], 'areaCode':areaCode, 'userId':userId };
                    $('#opLspop').append("<option value='"+
                    JSON.stringify(obj)+"'>"+ v['TITLE'] +'</option>');
                });
            }else{
                $('#opLspop').append('<option value="" disabled selected>-</option>')
            }    
            $('#opLuasBangunan').text(data['op']['CPM_OP_LUAS_BANGUNAN']);
            $('#opKelasBangunan').text(data['op']['CPM_OP_KELAS_BANGUNAN']);
    }
    
    $('#opLspop').on('change',function(){
        var data = JSON.parse($(this).val());
        detailLspop(data.docId,data.userId,data.areaCode,data.opNum);
        $('#labelDetailLspop').text($('#opLspop option:selected').html());
    });
    function detailLspop(docId,userId,areaCode,opNum){
        $.ajax({
            url: url+'profil_pajak/pbb/lspopdetail', 
            data: {
                docId: docId,
                userId: userId,
                areaCode: areaCode,
                opNum: opNum
            },
            type:"post",
            cache: false,
            success: function(data){
                setDetailLspop(data);
                // $('#modalDetailProfil').modal('show');
                $('#modalDetailProfil').modal('hide');
                $('#modalDetailLspop').modal('show');
            },
            error: function(data){
                $('#modalError').modal('show');
            }
        });
    }
    function setDetailLspop(data){
        //data bangunan
        $('#bJenis').text(data['CPM_OP_PENGGUNAAN_NAME'])
        $('#bLuas').text(data['CPM_OP_LUAS_BANGUNAN']);
        $('#bJmlLantai').text(data['CPM_OP_JML_LANTAI']);
        $('#bTahunBangun').text(data['CPM_OP_THN_DIBANGUN']);
        var renov=data['CPM_OP_THN_RENOVASI'];
        var tahunRenov="";
        if(renov==""){
            tahunRenov='-';
        }else{
            tahunRenov=data['CPM_OP_THN_RENOVASI']
        }
        $('#bTahunRenov').text(tahunRenov);
        $('#bDaya').text(data['CPM_OP_DAYA']);
        $('#bKondisi').text(data['CPM_OP_KONDISI_NAME']);
        $('#bKonstruksi').text(data['CPM_OP_KONSTRUKSI_NAME']);
        $('#bAtap').text(data['CPM_OP_ATAP_NAME']);
        $('#bDinding').text(data['CPM_OP_DINDING_NAME']);
        $('#bLantai').text(data['CPM_OP_LANTAI_NAME']);
        $('#bLangit').text(data['CPM_OP_LANGIT_NAME']);
        //fasilitas
        $('#fSplit').text(data['CPM_FOP_AC_SPLIT']);
        $('#fWindow').text(data['CPM_FOP_AC_WINDOW']);
        $('#fAcCentral').text(data['CPM_FOP_AC_CENTRAL']);
        $('#fLuasKolamRenang').text(data['CPM_FOP_AC_CENTRAL']);
        $('#fAcCentral').text(data['CPM_FOP_AC_CENTRAL']);
        $('#fRingan').text(data['CPM_FOP_PERKERASAN_RINGAN']);
        $('#fSedang').text(data['CPM_FOP_PERKERASAN_SEDANG']);
        $('#fBerat').text(data['CPM_FOP_PERKERASAN_BERAT']);
        $('#fPenutupLantai').text(data['CPM_FOP_PERKERASAN_PENUTUP']);
        $('#fBetonLampu').text(data['CPM_FOP_TENIS_LAMPU_BETON']);
        $('#fBetonNoLampu').text(data['CPM_FOP_TENIS_TANPA_LAMPU_BETON']);
        $('#fAspalLampu').text(data['CPM_FOP_TENIS_LAMPU_ASPAL']);
        $('#fAspalNoLampu').text(data['CPM_FOP_TENIS_TANPA_LAMPU_ASPAL']);
        $('#fTanahLampu').text(data['CPM_FOP_TENIS_LAMPU_TANAH']);
        $('#fTanahNoLampu').text(data['CPM_FOP_TENIS_TANPA_LAMPU_TANAH']);
        $('#fPenumpang').text(data['CPM_FOP_LIFT_PENUMPANG']);
        $('#fKapsul').text(data['CPM_FOP_LIFT_KAPSUL']);
        $('#fBarang').text(data['CPM_FOP_LIFT_BARANG']);
        $('#fSempit').text(data['CPM_FOP_ESKALATOR_SEMPIT']);
        $('#fLebar').text(data['CPM_FOP_ESKALATOR_LEBAR']);
        // $('#fPanjPagar').text(data['CPM_FOP_LIFT_BARANG']);
        var pemadam="";
        if(data['CPM_PEMADAM_FIRE_ALARM']=='1'){
            pemadam="Fire Alarm";
        }else if(data['CPM_PEMADAM_HYDRANT']=='1'){
            pemadam="Hydrant";
        }else if(data['CPM_PEMADAM_SPRINKLER']=='1'){
            pemadam="Springkler";
        }else{
            pemadam="-";
        }
        $('#fPemadamKeb').text(pemadam);
        $('#fJmlSalPabx').text(data['CPM_FOP_SALURAN']);
        $('#fSumur').text(data['CPM_FOP_SUMUR']);
        $('#opLspop option').eq(0).prop('selected',true);
    }
    
    var tableProfil9Pajak = $('#tableProfil9Pajak').DataTable( {
        ajax: {
            url: url+"table/profil_9pajak",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            //alert(oSettings._iDisplayStart);
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 3, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            //{data: "no", orderable:false, width: "30px", className: "dt-body-center"},
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                //alert(row.no);
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "npwpd", className: "dt-body-center"},
            {data: "nop", className: "dt-body-center"},
            {data: "nama"},
            {data: "taxKeterangan"},
            {data: "aksi", orderable: false},
            {data: "areaCode", visible: false},
            {data: "userId", visible: false},
            {data: "taxType",visible: false}
        ]
    });

    $('#tableProfil9Pajak tbody').on( 'click', '#detailProfil9Pajak', function () {
        var data = tableProfil9Pajak.row( $(this).parents('tr') ).data();
        detailProfil9Pajak(data['nop'],data['npwpd'],data['areaCode'],data['userId']);
    } );

    function detailProfil9Pajak(nop,npwpd,areaCode,userId){
        $.ajax({
            url: url+'profil_pajak/9pajak/detailprofil/', 
            data: {
                nop: nop,
                npwpd:npwpd,
                userId: userId,
                areaCode: areaCode,
            },
            type:"post",
            cache: false,
            success: function(data){
                setDetailProfil9Pajak(data,areaCode,userId);
                $('#modalDetailProfil').modal('show');
            },
            error: function(data){
                $('#modalError').modal('show');
            }
        });
    }

    function setDetailProfil9Pajak(data,areaCode,userId){
        $('#wpJenis').text(data['data'][0]['KETERANGAN_JENIS_WP'])
        $('#wpNpwpd').text(data['data'][0]['CPM_NPWPD']);
        $('#wpNik').text(data['data'][0]['CPM_NIK_WP']);
        $('#wpNama').text(data['data'][0]['CPM_NAMA_WP']);
        $('#wpTelepon').text(data['data'][0]['CPM_TELEPON_WP']);
        $('#wpAlamat').text(data['data'][0]['CPM_ALAMAT_WP']);
        if(data['data'][0]['KET_KEC_WP']!=null){
            $('#wpKecamatan').text(data['data'][0]['KET_KEC_WP']);
        }else{
            $('#wpKecamatan').text(data['data'][0]['CPM_KECAMATAN_WP']);
        }
        if(data['data'][0]['KET_KEL_WP']!=null){
            $('#wpKelurahan').text(data['data'][0]['KET_KEL_WP']);
        }else{
            $('#wpKelurahan').text(data['data'][0]['CPM_KELURAHAN_WP']);
        }
        $('#wpKartuData').val(data['urlKartuData']);
        $('#opJenis').text(data['data'][0]['KETERANGAN_JENIS_PAJAK']);
        $('#opNop').text(data['data'][0]['CPM_NOP']);
        $('#opNama').text(data['data'][0]['CPM_NAMA_OP']);
        $('#opAlamat').text(data['data'][0]['CPM_ALAMAT_OP']);
        if(data['data'][0]['KET_KEC_OP']!=null){
            $('#opKecamatan').text(data['data'][0]['KET_KEC_OP']);
        }else{
            $('#opKecamatan').text(data['data'][0]['CPM_KECAMATAN_OP']);
        }
        if(data['data'][0]['KET_KEL_OP']!=null){
            $('#opKelurahan').text(data['data'][0]['KET_KEL_OP']);
        }else{
            $('#opKelurahan').text(data['data'][0]['CPM_KELURAHAN_OP']);
        }
        $('#opRekening').text(data['data'][0]['CPM_REKENING']);
    }

    $('#wpKartuData').on('click',function(){
        var data = $(this).val();
        window.open(data, 'Kartu Data').focus();
    });
    //end code by kukuh
    var tableDashboardPelayananTerakhir = $('#tableDashboardPelayananTerakhir').DataTable( {
        ajax: {
            url: url+"C_table_json/dashboard_pelayanan_terakhir",
            data: function(data){
                //data.search.role = $("#role").val();
                //data.search.q = $("#search").val();
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 3, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nomor_pajak", className: "dt-body-center"},
            {data: "pengajuan"},
            {data: "jenis_pajak"},
            {data: "status_pelayanan", orderable:false, className: "dt-body-center"}
        ]
    });

    var tableHistory = $('#tableHistory').DataTable( {
        ajax: {
            url: url+"table/history",
            data: function(data){
                //data.search.role = $("#role").val();
                //data.search.q = $("#search").val();
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 3, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            //{data: "id", visible: false},
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nomor_pajak", className: "dt-body-center"},
            {data: "nomor_pelayanan", className: "dt-body-center"},
            //{data: "nama"},
            {data: "pengajuan"},
            {data: "jenis_pajak"},
            {data: "pelayanan"},
            {data: "status_pelayanan", orderable:false, className: "dt-body-center"},
            {data: "aksi", orderable:false, className: "dt-body-center"},
        ]

    });

    var tableNews = $('#tableNews').DataTable( {
        ajax: {
            url: url+"table/news_admin",
            data: function(data){
                //data.search.role = $("#role").val();
                //data.search.q = $("#search").val();
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 3, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            //{data: "id", visible: false},
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "judul", className: "dt-body-center"},
            {data: "tanggal"},
            {data: "aksi"}
        ]
        
    });

    var tableUsers = $('#tableUsers').DataTable( {
        ajax: {
            url: url+"table/users_list",
            data: function(data){
                //data.search.role = $("#role").val();
                //data.search.q = $("#search").val();
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            //{data: "id", visible: false},
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "email", orderable:false},
            {data: "mobile", orderable:false},
            {data: "name", orderable:false},
            {data: "role", orderable:false},
            {data: "area_nama", orderable:false},
            {data: "action", orderable:false, className: "dt-body-center"}
        ]
        
    });

    var tableProv = $('#tableProv').DataTable( {
        ajax: {
            url: url+"table/prov",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "prov", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var tableArea = $('#tableArea').DataTable( {
        ajax: {
            url: url+"table/area",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        //"_iDisplayStart": 0,
        //"iDisplayStart": 0,
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            //console.log('tah => '+oSettings._iDisplayStart);
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "area_code", orderable:false},
            {data: "prov", orderable:false},
            {data: "area", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var tableMappingPath = $('#tableMappingPath').DataTable( {
        ajax: {
            url: url+"table/path",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "tipe_pajak", orderable:false},
            {data: "path", orderable:false},
            {data: "service_code", orderable:false},
            {data: "description", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var tableMappingApi = $('#tableMappingApi').DataTable( {
        ajax: {
            url: url+"table/api",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        processing: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "area_code", orderable:true},
            {data: "tipe_pajak", orderable:true},
            {data: "url", orderable:true},
            {data: "service_type", orderable:true},
            {data: "app_config_name", orderable:true},
            {data: "kartu_data", orderable:true},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var TableServiceNinePajak = $('#TableServiceNinePajak').DataTable( {
        ajax: {
            url: url+"table/service/0003",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nama", orderable:false},
            {data: "icon", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var TableServicePbb = $('#TableServicePbb').DataTable( {
        ajax: {
            url: url+"table/service/0002",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nama", orderable:false},
            {data: "icon", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var TableServiceBphtb = $('#TableServiceBphtb').DataTable( {
        ajax: {
            url: url+"table/service/0001",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nama", orderable:false},
            {data: "icon", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var TableRole = $('#TableRole').DataTable( {
        ajax: {
            url: url+"table/role",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "role", orderable:false},
            {data: "detail", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var TableAppConfig = $('#TableAppConfig').DataTable( {
        ajax: {
            url: url+"table/config_app",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "config", orderable:false},
            {data: "name", orderable:false},
            {data: "aksi", orderable:false, className: "dt-body-center"}
        ]
    });

    var tableDraftBphtb = $('#tableDraftBphtb').DataTable( {
        ajax: {
            url: url+"table/draft/0001",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nomor_pajak", className: "dt-body-center"},
            {data: "nomor_pelayanan", className: "dt-body-center"},
            {data: "pengajuan"},
            {data: "jenis_pajak"},
            {data: "pelayanan"},
            {data: "aksi", orderable:false, className: "dt-body-center", width: "227px"},
        ]
    });

    var tableDraftPbb = $('#tableDraftPbb').DataTable( {
        ajax: {
            url: url+"table/draft/0002",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nomor_pajak", className: "dt-body-center"},
            {data: "nomor_pelayanan", className: "dt-body-center"},
            {data: "pengajuan"},
            {data: "jenis_pajak"},
            {data: "pelayanan"},
            {data: "aksi", orderable:false, className: "dt-body-center", width: "227px"},
        ]
    });

    var tableDraft9P = $('#tableDraft9P').DataTable( {
        ajax: {
            url: url+"table/draft/0003",
            data: function(data){
                
            },
            dataSrc: 'data',
        },
        searching: false,
        fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            return "Show "+iStart+" to "+iEnd+" of "+(oSettings.json ? oSettings.json.recordsTotal : iTotal)+" entries";
        },
        pagingType: 'full_numbers',
        language: {paginate: {
            first: '<i class="fa fa-step-backward"></i>',
            last: '<i class="fa fa-step-forward"></i>',
            previous: '<i class="fa fa-backward"></i>',
            next: '<i class="fa fa-forward"></i>',
        }},
        paging: true,
        order: [[ 1, "asc" ]],
        dom: 'tip',
        pageLength: 10,
        serverSide: true,
        serverMethod: 'post',
        columns: [
            {data: "no", orderable:false, width: "30px", className: "dt-body-center",
            render: function (data, type, row, meta) {
                return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
            }},
            {data: "nomor_pajak", className: "dt-body-center"},
            {data: "nomor_pelayanan", className: "dt-body-center"},
            {data: "pengajuan"},
            {data: "jenis_pajak"},
            {data: "pelayanan"},
            {data: "aksi", orderable:false, className: "dt-body-center", width: "227px"},
        ]
    });

})