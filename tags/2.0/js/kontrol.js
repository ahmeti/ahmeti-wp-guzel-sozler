/*jQuery(document).ready(function(){
  
    $('#gonder_button').click(function() {
        
        var soz=$('textarea[name="soz"]');
            var soz_val=$.trim(soz.val());
        var sahibi=$('input[name="sahibi"]');
            var sahibi_val=$.trim(sahibi.val());
            
        if(soz_val==''){
            alert('Lütfen söz alanını boş bırakmayınız.');
        }else if(sahibi_val==''){
            alert('Lütfen sahibi alanını boş bırakmayınız.');
        }else{
            $("#form_gonder").removeAttr("onsubmit")
        }
        
    });
    
   
   
   
   // Select All Texarea
   jQuery("#export_soz").focus(function(){
       jQuery(this).select();
   });
   
   
   
   
});*/


function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
