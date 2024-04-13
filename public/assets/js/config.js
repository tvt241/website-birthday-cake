$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    beforeSend: function(xhr) {
        $(".loader").show();
        $("#preloder").show();
    },
    complete : function(xhr){
        $(".loader").hide();
        $("#preloder").hide();
    }
});