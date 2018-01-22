function Dinamic() {
    var table;
    this.init = function () {
        table = this.table();
        $("#btnNew").click(this.new);
        $("#btnSave").click(this.save);
        $("#btnModal").click(function () {
            $(".input-detail").cleanFields();
            $("#modalDetail").modal("show");
        });

        $("#newDetail").click(this.saveDetail);

        $("#type_form_id").change(function () {
            if ($(this).val() == 1) {
                $("#length_text, #type_data_id").attr("disabled", true);
            } else {
                $("#length_text, #type_data_id").attr("disabled", false);
            }
        })
    }
    this.new = function () {
        $(".input-dinamic").cleanFields();
    }

    this.saveDetail = function () {
        toastr.remove();
        $("#frmDetail #dinamic_id").val($("#frm #id").val());
        var frm = $("#frmDetail");
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frmDetail #id").val();
        var msg = '';

        var validate = $(".input-detail").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "dinamic/detail";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "dinamic/detail/" + id;
                msg = "Edited Record";
            }

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        $(".input-dinamic").setFields({data: data.header})
                        $("#modalNew").modal("hide");
                        toastr.success("Ok");
                        obj.printTable(data.detail);
                    }
                }
            })
        } else {
            toastr.error("Fields Required!");
        }
    }

    this.save = function () {
        toastr.remove();
        var frm = $("#frm");
        var data = frm.serialize();
        var url = "", method = "";
        var id = $("#frm #id").val();
        var msg = '';

        var validate = $(".input-dinamic").validate();

        if (validate.length == 0) {
            if (id == '') {
                method = 'POST';
                url = "dinamic";
                msg = "Created Record";
            } else {
                method = 'PUT';
                url = "dinamic/" + id;
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
                        $(".input-dinamic").setFields({data: data.header});
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
        var url = "/dinamic/" + id + "/edit";

        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $('#myTabs a[href="#management"]').tab('show');
                $(".input-dinamic").setFields({data: data.header});
                obj.printTable(data.detail);
            }
        })
    }

    this.printTable = function (data) {
        var html = "";
        $("#tblDetail tbody").empty();
        var required = '';
        $.each(data, function (i, val) {
            html += "<tr>";
            html += "<td>" + val.label_field + "</td>";
            html += "<td>" + val.name_field + "</td>";
            html += "<td>" + val.placeholder_field + "</td>";
            html += "<td>" + val.type_form + "</td>";
            html += "<td>" + val.type_data_input + "</td>";
            html += "<td>" + val.length_text + "</td>";
            html += "<td>" + val.required_field + "</td>";

            html += "<td>";
            html += '<div class="form-group"><label for="pwd">' + val.label_field + ':</label>';

            required = (val.required_field == true) ? 'required' : '';

            if ((val.type_form).toLowerCase() == 'input') {
                html += '<input type="text" class="form-control" name="' + val.name_field + '" placeholder="' + val.placeholder_field + '" maxlength=' + val.length_text + ' ' + required + ' ></div>';
            } else if ((val.type_form).toLowerCase() == 'checkbox') {
                html += '<input type="checkbox" class="form-control" name="' + val.name_field + '" placeholder="' + val.placeholder_field + '" ' + required + '></div>';
            } else {
                html += '<textarea class="form-control" name="' + val.name_field + '" placeholder="' + val.placeholder_field + '" ' + required + '></textarea></div>';
            }
            html += "</td>";

            html += '<td><button class="btn btn-info btn-xs" onclick="obj.editItem(' + val.id + ')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>';
            html += '<button class="btn btn-danger btn-xs" onclick="obj.deleteItem(' + val.id + ',' + val.dinamic_id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>';
            html += "</tr>";
        })
        
        $("#tblDetail tbody").html(html);

    }

    this.editItem = function (id) {
        var frm = $("#frmEdit");
        var data = frm.serialize();
        var url = "/dinamic/detail/" + id + "/edit";

        $.ajax({
            url: url,
            method: "GET",
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#modalDetail").modal("show")
                $(".input-detail").setFields({data: data});

            }
        })
    }


    this.deleteItem = function (id, dinamic_id) {
        toastr.remove();
        if (confirm("Deseas eliminar")) {
            var param = {};
            param.dinamic_id = dinamic_id;
            var token = $("input[name=_token]").val();
            var url = "/dinamic/detail/" + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                method: "DELETE",
                data: param,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true) {
                        toastr.warning("Ok");
                        obj.printTable(data.detail);
                    }
                }, error: function (err) {
                    toastr.error("No se puede borrar Este registro");
                }
            })
        }
    }

    this.delete = function (id) {
        toastr.remove();
        if (confirm("Deseas eliminar")) {
            var token = $("input[name=_token]").val();
            var url = "/dinamic/" + id;
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
            processing: true,
            serverSide: true,
            ajax: "/api/listDinamic",
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
                    mData: null,
                    mRender: function (data, type, full) {
                        return '<button class="btn btn-danger btn-xs" onclick="obj.delete(' + data.id + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
        });
    }

}

var obj = new Dinamic();
obj.init();