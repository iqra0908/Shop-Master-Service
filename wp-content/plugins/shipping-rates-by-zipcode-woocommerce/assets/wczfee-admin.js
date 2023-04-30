jQuery( function($) {
    
    $('.wczfee_addpostcode').click(function(){

        var $tr    = $('#wcc_fee_rows .wcc_fee_row:first-child');
        var $clone = $tr.clone();
        $clone.find(':text').val('');
        $clone.find(':text:first-child').attr('name', 'postcodes[]');
        $clone.find('.wczfee_postcodes_fee').attr('name', 'postcodes_fee[]');
        $clone.find('.wczfee_delpostcode').attr('data-id', '');
        
        $('#wcc_fee_rows').append($clone);
    });

    $(document).on('click', '.wczfee_delpostcode', function(){
        var id = $(this).data('id');
        if($('.wcc_fee_row').length > 1){            
            $(this).parent().remove();

            if(id){
                $('#del_citites').append('<input type="hidden" name="delpostcode[]" value="'+id+'"/>')
            }
        }
    });

});    