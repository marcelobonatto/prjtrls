$(document).ready(function() {
    $('#divOptObrig label').click(function() {
        if (this.id == "lblObrNao")
        {
            $("#cmbMissoes").prop("disabled", false);
        }
        else
        {
            $("#cmbMissoes").prop("disabled", true);
            $("#cmbMissoes").val(" ");
        }
    });
});