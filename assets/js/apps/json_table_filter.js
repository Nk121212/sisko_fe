$(document).ready(function(){

    $('#frmTableHistory').submit(function(e){
        
        e.preventDefault();    
        //var formData = new FormData(this);

        var tax_type = $('#tax_type').val();
        var service = $('#service').val();
        var status = $('#status').val();
        var nomor_pajak = $('#nomor_pajak').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        beforeSendLoading(1);

        $('#tableHistory').dataTable().fnDestroy();

        $('#tableHistory').DataTable( {
            ajax: {
                url: url+'table/history',
                data: function(data){

                    return $.extend( {}, data, {
                        "tax_type": tax_type,
                        "service": service,
                        "status": status,
                        "nomor_pajak": nomor_pajak,
                        "start_date": start_date,
                        "end_date": end_date,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'History', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
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

    });

    $('#frmTableNews').submit(function(e){
        
        e.preventDefault();    

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        beforeSendLoading(1);

        $('#tableNews').dataTable().fnDestroy();

        $('#tableNews').DataTable( {
            ajax: {
                url: url+'table/news_admin',
                data: function(data){

                    return $.extend( {}, data, {
                        "start_date": start_date,
                        "end_date": end_date,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'Berita', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
            dom: 'tip',
            pageLength: 10,
            serverSide: true,
            serverMethod: 'post',
            columns: [
                //{data: "id", visible: false},
                {data: "no", orderable:false, width: "30px", className: "dt-body-center"},
                {data: "judul", className: "dt-body-center"},
                {data: "tanggal"},
                {data: "aksi"}
            ]
        });

    });

    $('#frmTableArea').submit(function(e){
        
        e.preventDefault();    

        var prov_code = $('#prov').val();
        var area_code = $('#area').val();

        beforeSendLoading(1);

        $('#tableArea').dataTable().fnDestroy();

        $('#tableArea').DataTable( {
            ajax: {
                url: url+"table/area",
                data: function(data){

                    return $.extend( {}, data, {
                        "prov_code": prov_code,
                        "area_code": area_code,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'Area', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
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

    });

    $('#frmTableProv').submit(function(e){
        
        e.preventDefault();    

        //var prov_name = $("#prov option:selected").text();

        var prov_name = $('#prov').val();
        //var area_code = $('#area').val();

        beforeSendLoading(1);

        $('#tableProv').dataTable().fnDestroy();

        $('#tableProv').DataTable( {
            ajax: {
                url: url+"table/prov",
                data: function(data){

                    return $.extend( {}, data, {
                        "prov_name": prov_name,
                        //"prov_name": prov_name,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'Province', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
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

    });

    $('#frmTableMappingPath').submit(function(e){
        
        e.preventDefault();    

        //var prov_name = $("#prov option:selected").text();

        var tax_code = $('#tax_code').val();
        var desc = $('#desc').val();

        beforeSendLoading(1);

        $('#tableMappingPath').dataTable().fnDestroy();

        $('#tableMappingPath').DataTable( {
            ajax: {
                url: url+"table/path",
                data: function(data){

                    return $.extend( {}, data, {
                        "tax_code": tax_code,
                        "desc": desc,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'Mapping Path', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
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

    });

    $('#frmTableMappingApi').submit(function(e){
        
        e.preventDefault();    

        //var prov_name = $("#prov option:selected").text();

        var tax_code = $('#tax_code').val();
        var service_type = $('#service_type').val();

        beforeSendLoading(1);

        $('#tableMappingApi').dataTable().fnDestroy();

        $('#tableMappingApi').DataTable( {
            ajax: {
                url: url+"table/api",
                data: function(data){

                    return $.extend( {}, data, {
                        "tax_code": tax_code,
                        "service_type": service_type,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'Mapping API', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
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

    });

    $('#frmTableUsers').submit(function(e){
        
        e.preventDefault();    

        //var prov_name = $("#prov option:selected").text();

        var email = $('#email').val();
        var name = $('#name').val();

        beforeSendLoading(1);

        $('#tableUsers').dataTable().fnDestroy();

        $('#tableUsers').DataTable( {
            ajax: {
                url: url+"table/users_list",
                data: function(data){

                    return $.extend( {}, data, {
                        "email": email,
                        "name": name,
                    });
                },
                dataSrc: 'data',
            },
            "initComplete": function( oSettings, json ) {

                loadSwal('success', 'Users', 'Pencarian Berhasil');
                
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
            order: [[ 2, "asc" ]],
            dom: 'tip',
            pageLength: 10,
            serverSide: true,
            processing: true,
            serverMethod: 'post',
            columns: [
                {data: "no", orderable:false, width: "30px", className: "dt-body-center",
                render: function (data, type, row, meta) {
                    return (row.no === null) ? "" : meta.row + meta.settings._iDisplayStart + 1;
                }},
                {data: "email", orderable:false, className: "dt-body-center"},
                {data: "mobile", orderable:false},
                {data: "name", orderable:false, className: "dt-body-center"},
                {data: "role", orderable:false},
                {data: "area_nama", orderable:false},
                {data: "action", orderable:false, className: "dt-body-center"}
            ]
        });

    });


})