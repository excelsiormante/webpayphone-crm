$(document).ready(function(){
    $('#id_target_period').on('change', function() {
      if ( this.value == 'Monthly')
      {
        $("#monthlyform").show();
        $("#quarterlyform").hide();
      }
      else if ( this.value == 'Quarterly')
      {
        $("#quarterlyform").show();
        $("#monthlyform").hide();
      }
    });

    $('#targetModal')
        .on('hidden.bs.modal', function() {
            console.log("Set Target Closed");
            $("#monthlyform").hide();
            $("#quarterlyform").hide();
            document.getElementById('id_target_period').value = "";
        }
    );
});