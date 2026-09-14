// Konfigurasi SweetAlert2 Toast
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
});

function tambahJurusan() {
  $("#modalTitle").text("Tambah Jurusan");
  $("#formJurusan").attr("action", baseUrl + "jurusan/simpan");
  $("#id_jurusan").val("");
  $("#kode_jurusan").val("");
  $("#nama_jurusan").val("");
  $("#modalJurusan").modal("show");
}

function editJurusan(id) {
  $.ajax({
    url: baseUrl + "jurusan/edit_data/" + id,
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      $("#modalTitle").text("Edit Jurusan");
      $("#formJurusan").attr("action", baseUrl + "jurusan/update");
      $("#id_jurusan").val(data.id_jurusan);
      $("#kode_jurusan").val(data.kode_jurusan);
      $("#nama_jurusan").val(data.nama_jurusan);
      $("#modalJurusan").modal("show");
    },
  });
}

function hapusJurusan(id) {
  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Data jurusan ini akan dihapus!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, Hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = baseUrl + "jurusan/hapus/" + id;
    }
  });
}
