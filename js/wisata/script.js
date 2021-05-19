class wisata {
    static DOMStrings = {
        markers: [],
        kota: "#kota_id",
        provinsi: "#provinsi_id",
        kecamatan: "#kecamatan_id",
        editKota: "#edit_kota_id",
        editProvinsi: "#edit_provinsi_id",
        editKecamatan: "#edit_kecamatan_id",
        latitude: "#latitude",
        langtitude: "#langtitude",
        EditLatitude: "#edit_latitude",
        EditLangtitude: "#edit_langtitude",
        cardTambah: "#card-tambah",
        cardEdit: "#card-edit",
        formWisata: "#formWisata",
        formWisataEdit: "#formWisataEdit",
        modalPeta: "#modal-tempat",
        mapView: "#map-view",
        mapEdit: "#map-edit",
        btnSimpan: "#simpan",
        btnSimpanEdit: "#simpan-edit",
        tableWisata: "#table-wisata",
        titleForm: "#title-form",
        btnPeta: ".btn-peta",
        btnEdit: ".btn-edit",
        btnDelete: ".btn-delete",
    };

    static provinsiChange = (event) => {
        const provinsiVal = event.value;
        const kota = this.DOMStrings.kota;
        $.ajax({
            url: process_env_url + "/api/data/kota",
            data: {
                provinsi: provinsiVal,
            },
            type: "GET",
            cache: false,
            dataType: "json",
            success: function (json) {
                $(kota).html("");
                if (json.code == 200) {
                    for (let i = 0; i < Object.keys(json.data).length; i++) {
                        $(kota).append(
                            $("<option>")
                                .text(json.data[i].nama_kota)
                                .attr("value", json.data[i].id)
                        );
                    }
                } else {
                    $(kota).append(
                        $("<option>")
                            .text("Data tidak di temukan")
                            .attr("value", "Data tidak di temukan")
                    );
                }
            },
        });
    };

    static kotaChange = (event) => {
        const kotaVal = event.value;
        const kecamatan = this.DOMStrings.kecamatan;
        $.ajax({
            url: process_env_url + "/api/data/kecamatan",
            data: {
                kota: kotaVal,
            },
            type: "GET",
            cache: false,
            dataType: "json",
            success: function (json) {
                $(kecamatan).html("");
                if (json.code == 200) {
                    for (let i = 0; i < Object.keys(json.data).length; i++) {
                        $(kecamatan).append(
                            $("<option>")
                                .text(json.data[i].nama_kecamatan)
                                .attr("value", json.data[i].id)
                        );
                    }
                } else {
                    $(kecamatan).append(
                        $("<option>")
                            .text("Data tidak di temukan")
                            .attr("value", "Data tidak di temukan")
                    );
                }
            },
        });
    };

    static addMarker = (location, map) => {
        var marker = new google.maps.Marker({
            position: location,
            label: "P",
            map: map,
        });
        this.DOMStrings.markers.push(marker);
    };

    static clickMarker = (event, edit = false) => {
        const lat = event.latLng.lat().toString();
        const lang = event.latLng.lng().toString();
        const langtitude = edit
            ? $(this.DOMStrings.langtitude)
            : $(this.DOMStrings.EditLangtitude);
        const latitude = edit
            ? $(this.DOMStrings.latitude)
            : $(this.DOMStrings.EditLatitude);
        latitude.val(String(lat));
        langtitude.val(String(lang));
    };

    static deleteMarker = () => {
        for (var i = 0; i < this.DOMStrings.markers.length; i++) {
            this.DOMStrings.markers[i].setMap(null);
        }
        this.DOMStrings.markers = [];
    };

    static loadWisata = () => {
        $(this.DOMStrings.tableWisata).DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: process_env_url + "/wisata/table/",
            columns: [
                { data: "DT_RowIndex", name: "id" },
                { data: "nama_desa", name: "nama_desa" },
                { data: "wilayah", name: "wilayah" },
                {
                    data: "alamat",
                    name: "alamat",
                    render: function (data, type, row, meta) {
                        return wordWrap(data, 40);
                    },
                },
                { data: "marker", name: "marker" },
                { data: "action", name: "action" },
            ],
            order: [[0, "desc"]],
        });
    };

    static simpan = async (edit = false) => {
        loading();
        const form = !edit
            ? document.querySelector(this.DOMStrings.formWisata)
            : document.querySelector(this.DOMStrings.formWisataEdit);
        const formData = new FormData(form);
        const url = process_env_url + "/simpan/wisata";
        try {
            const response = await axios({
                method: "post",
                data: formData,
                url: url,
            });
            matikanLoading();
            let icon = "";
            const data = await response.data;
            if (data.errors === undefined) {
                const success = Object.entries(data.success);
                success.map(([key, value]) => {
                    hapusvalidasi(key, edit);
                });
                icon = "success";
                swal({
                    title: "Pesan!",
                    text: data.message,
                    icon: icon,
                });
                $(this.DOMStrings.tableWisata).DataTable().ajax.reload();
                $(this.DOMStrings.formWisata)[0].reset();
                if (edit) {
                    $(this.DOMStrings.cardEdit).hide();
                    $(this.DOMStrings.cardTambah).show();
                }
            } else {
                const error = Object.entries(data.errors);
                error.map(([key, value]) => {
                    hapusvalidasi(key, edit);
                    tambahvalidasi(key, value, edit);
                    icon = "error";
                });
                swal({
                    title: "Pesan!",
                    text: data.message,
                    icon: icon,
                });
            }
        } catch (error) {
            matikanLoading();
            alert("Maaf ada kesalahan diserver");
            console.log(error);
        }
    };

    static showMap = (event) => {
        const lat = event.dataset.lat;
        const lang = event.dataset.lang;
        var myLatLng = { lat: parseFloat(lat), lng: parseFloat(lang) };
        var map = new google.maps.Map(
            document.querySelector(this.DOMStrings.mapView),
            {
                zoom: 9,
                center: myLatLng,
            }
        );
        new google.maps.Marker({
            position: myLatLng,
            map: map,
            label: "P",
        });
        $(this.DOMStrings.modalPeta).modal({
            backdrop: "static",
            keyboard: false,
        });
    };

    static openEdit = (event) => {
        $(this.DOMStrings.cardEdit).show();
        $(this.DOMStrings.cardTambah).hide();
        const id = event.dataset.id;
        $("html, body").animate(
            {
                scrollTop: $(this.DOMStrings.titleForm).offset().top,
            },
            500
        );
        fetch(`${process_env_url}/ambil/wisata/${id}`)
            .then((res) => res.json())
            .then((datas) => {
                const { wisatas, kecamatan, kota } = datas;
                var peta = [];
                peta.push(wisatas.latitude);
                peta.push(wisatas.langtitude);
                var myLatLng = {
                    lat: parseFloat(peta[0]),
                    lng: parseFloat(peta[1]),
                };
                var map = new google.maps.Map(
                    document.querySelector(this.DOMStrings.mapEdit),
                    {
                        zoom: 9,
                        center: myLatLng,
                    }
                );
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    label: "P",
                });
                this.DOMStrings.markers.push(marker);
                google.maps.event.addListener(map, "click", function (event) {
                    wisata.deleteMarker();
                    wisata.addMarker(event.latLng, map);
                    wisata.clickMarker(event);
                });
                $(this.DOMStrings.editKota).html("");
                $(this.DOMStrings.editKecamatan).html("");
                kecamatan.forEach((data) => {
                    $(this.DOMStrings.editKecamatan).append(
                        $("<option>")
                            .text(data.nama_kecamatan)
                            .attr("value", data.id)
                    );
                });
                kota.forEach((data) => {
                    $(this.DOMStrings.editKota).append(
                        $("<option>")
                            .text(data.nama_kota)
                            .attr("value", data.id)
                    );
                });
                document.querySelector(this.DOMStrings.editProvinsi).value =
                    wisatas.kecamatan.kota.provinsi.id;
                document.querySelector(this.DOMStrings.editKota).value =
                    wisatas.kecamatan.kota.id;
                const notAllowed = ["created_at", "updated_at", "pusat_id"];
                for (const key in wisatas) {
                    if (!notAllowed.includes(key)) {
                        document.getElementById(`edit_${key}`).value =
                            wisatas[key];
                    }
                }
            })
            .catch((err) => console.err);
    };

    static hapusData = (id) => {
        swal({
            title: "Yakin?",
            text: "anda yakin ingin menghapus data Desa wisata ini??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                loading();
                fetch(`${process_env_url}/wisata/hapus/${id}`)
                    .then((res) => res.json())
                    .then((data) => {
                        matikanLoading();
                        swal({
                            title: "Pesan!",
                            text: data.message,
                            icon: "success",
                        });
                        $(this.DOMStrings.tableWisata)
                            .DataTable()
                            .ajax.reload();
                    })
                    .catch((err) => console.error(err));
            } else {
                swal("Anda membatalkan hapus data");
            }
        });
    };
}

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: { lat: -4.9269661, lng: 113.0800289 },
    });
    google.maps.event.addListener(map, "click", function (event) {
        wisata.deleteMarker();
        wisata.addMarker(event.latLng, map);
        wisata.clickMarker(event, true);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    wisata.loadWisata();

    const provinsi = document.querySelector(wisata.DOMStrings.provinsi);
    provinsi.addEventListener("change", function () {
        wisata.provinsiChange(this);
    });

    const kota = document.querySelector(wisata.DOMStrings.kota);
    kota.addEventListener("change", function () {
        wisata.kotaChange(this);
    });

    const simpan = document.querySelector(wisata.DOMStrings.btnSimpan);
    simpan.addEventListener("click", wisata.simpan);

    $("body").on("click", wisata.DOMStrings.btnPeta, function () {
        wisata.showMap(this);
    });

    $("body").on("click", wisata.DOMStrings.btnEdit, function () {
        wisata.openEdit(this);
    });

    $("body").on("click", wisata.DOMStrings.btnDelete, function () {
        wisata.hapusData($(this).data("id"));
    });

    const simpanEdit = document.querySelector(wisata.DOMStrings.btnSimpanEdit);
    simpanEdit.addEventListener("click", function () {
        wisata.simpan(true);
    });
});
