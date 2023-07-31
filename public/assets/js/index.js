/** menampilkan modal body dengan view yang didapat melalui url
 * @param string url url view
 */
function modal(url) {
    $.ajax({
        url:url,
        type:'GET',
        beforeSend:function(data){
            $('#loader').show();
        },
        success: function(data){
            $('#loader').fadeOut('slow');
            $('#modal').html(data);
            $('#exampleModal').modal('show');
        }
    })
}

function hideModal(){
    $('#exampleModal').modal('hide');
}

function showLoader(){
    $('#loader').show();
}

function hideLoaderr() {
    $('#loader').fadeOut('slow');
}

function submitForm(id) {
    hideModal();
    $('#'+id).submit();
}

function modalAlertDelete(url, data){
    let html = `<div class="modal fade" id="exampleModal1" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModal1Label">Delete Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        Are you sure to delete <b>`+data+`</b> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal" >Cancel</button>
          <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal" onclick="deleteData('`+url+`')">Delete</button>
        </div>
      </div>
    </div>
    </div>`;
    $('#modal').html(html);
    $('#exampleModal1').modal('show');

}

function deleteData(url){
    $.ajax({
        url:url,
        type:'GET',
        beforeSend:function(data){
            $('#loader').show();
        },
        success: function(data){
            console.log(data);
            data = JSON.parse(data);
            if (data.status===200) {
                location.reload(true);
            }else if(data.status===500){
                iziToast.show({
                    title: data.message,
                    // message: 'What would you like to add?',
                    balloon: true,
                    position: 'topCenter',
                    theme: "light",
                    color: 'red'
                });
                $('#loader').fadeOut('slow');
                $('#exampleModal1').modal('hide');
            }
        }
    })
}

$(document).ready(function(){
    $('[modal="delete-alert"]').click(function(){
        let type = $(this).attr('modal');
        let url = $(this).attr('target-url');
        let data = $(this).attr('data');
        if (type==='delete-alert') {
            modalAlertDelete(url, data);
        }
    })
    $('label.file-input img').hover(function(){
        $('.icon-foto').show()
    }, function(){$('.icon-foto').hide()})
})

function thousands_separators(num)
  {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return num_parts.join(".");
  }

  function tanggal(params) {
    const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const bulan = ['Januari', 'Feberuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return hari[params.getDay()] + ', ' + params.getDate() + ' ' + bulan[params.getMonth()] + ' ' + params.getFullYear() + ' Pukul ' + params.getHours() + ' : ' + + params.getMinutes() + ' WIB';
  }

