function Routes() {
    var table;
    this.init = function () {
        table = this.table();
        $("#new").click(this.save);
        $("#edit").click(this.edit);

        $("#btnNew").click(function () {

            $(".input-department").cleanFields();
            $("#modalNew").modal("show");
        });

        $("#btnUpload").click(this.uploadExcel)
    }

    this.uploadExcel = function () {
        var formData = new FormData($("#frmFile")[0]);

        $.ajax({
            url: 'department/uploadExcel',
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            processData: false,
            cache: false,
            contentType: false,
            success: function (data) {
//                obj.setDetailExcel(data.data)
                toastr.success("ok");
                table.ajax.reload();
            }
        })

    }

    this.save = function () {
        toastr.remove();
        var frm = $("#frm");
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frm #id").val();
        var msg = '';

        var validate = $(".input-department").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "department";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "department/" + id;
                msg = "Edited Record";
            }

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        $("#modalNew").modal("hide");
                        table.ajax.reload();
                        toastr.success(msg);
                    }
                }
            })
        } else {
            toastr.error("Fields Required!");
        }
    }

    this.showModal = function (id) {
        var frm = $("#frmEdit");
        var data = frm.serialize();
        var url = "/routes/" + id + "/edit";
//        $("#modalNew").modal("show");
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $('#myTabs a[href="#management"]').tab('show');
                $("#frm #id").val(data.id);
                $("#frm #description").val(data.description);
                var directionsDisplay = new google.maps.DirectionsRenderer();
                var directionsService = new google.maps.DirectionsService();

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: new google.maps.LatLng(-33.92, 151.25),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                directionsDisplay.setMap(map);
                var infowindow = new google.maps.InfoWindow();

                var marker, i;
                var request = {
                    travelMode: google.maps.TravelMode.DRIVING
                };

                for (i = 0; i < (data.points).length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(data.points[i].latitude, data.points[i].latitude),
                        map: map
                    });

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infowindow.setContent(data.points[0].latitude);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                    if (i == 0)
                        request.origin = marker.getPosition();
                    else if (i == (data.points).length - 1)
                        request.destination = marker.getPosition();
                    else {
                        if (!request.waypoints)
                            request.waypoints = [];
                        request.waypoints.push({
                            location: marker.getPosition(),
                            stopover: true
                        });
                    }


                }

                directionsService.route(request, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(result);
                    }
                });

//                google.maps.event.addDomListener(window, "load", initialize);

                // Try HTML5 geolocation.
//                if (navigator.geolocation) {
//                    navigator.geolocation.getCurrentPosition(function (position) {
//                        var pos = {
//                            lat: position.coords.latitude,
//                            lng: position.coords.longitude
//                        };
//
//
//
//                        infoWindow.setPosition(pos);
//                        infoWindow.setContent('Location found.');
//                        infoWindow.open(map);
//                        map.setCenter(pos);
//                    }, function () {
//                        handleLocationError(true, infoWindow, map.getCenter());
//                    });
//                } else {
//                    // Browser doesn't support Geolocation
//                    handleLocationError(false, infoWindow, map.getCenter(), map);
//                }

                var waypoint = [];
                console.log(data.points)
                for (let i = 1; i < (data.points).length; i++) {
                    waypoint.push({
                        location: new google.maps.LatLng(parseFloat(data.points[i].latitude), parseFloat(data.points[i].longitude)),
                        stopover: true
                    });
                }
//                console.log((data.points).length)
                var initRoute = new google.maps.LatLng(parseFloat(data.points[0].latitude), parseFloat(data.points[0].longitude))
                var endroute = new google.maps.LatLng(parseFloat(data.points[(data.points).length - 1].latitude), parseFloat(data.points[(data.points).length - 1].longitude))


                directionsService.route({
                    origin: initRoute,
                    destination: endroute,
                    travelMode: 'DRIVING',
                    waypoints: waypoint
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });

            }
        })
    }

    this.handleLocationError = function (browserHasGeolocation, infoWindow, pos, map) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    this.delete = function (id) {
        toastr.remove();
        if (confirm("Deseas eliminar")) {
            var token = $("input[name=_token]").val();
            var url = "/department/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                method: "DELETE",
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        table.ajax.reload();
                        toastr.warning("Ok");
                    }
                }, error: function (err) {
                    toastr.error("No se puede borrra Este registro");
                }
            })
        }
    }

    this.table = function () {
        return $('#tbl').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/api/listRoutes",
            columns: [
                {data: "id"},
                {data: "description"},
            ],
            order: [[1, 'ASC']],
            aoColumnDefs: [
                {
                    aTargets: [0, 1],
                    mRender: function (data, type, full) {
                        return '<a href="#" onclick="obj.showModal(' + full.id + ')">' + data + '</a>';
                    }
                },
                {
                    targets: [2],
                    searchable: false,
                    "mData": null,
                    "mRender": function (data, type, full) {
                        return '<button class="btn btn-danger btn-xs" onclick="obj.delete(' + data.id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
        });
    }

}

var obj = new Routes();
obj.init();