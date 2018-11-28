<script>
    const productList = {};
    productList.products = [];
    localStorage.setItem('productList', toJsonString(productList));

    const importDetail = {
        supplierId:"",
        importDate:"",
        productList:[],
        totalProductCost:0

    }
    const warningMessage = {
        emptyProduct: "<tr class='font-weight-bold text-center text-warning'><td colspan='8'><i class='fa fa-exclamation-triangle'></i> ยังไม่ได้เลือกสินค้า </td></tr>"
    }

    $(document).ready(() => {

        $('#importDate').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            value: setDateToActualFormat(new Date().toLocaleDateString('en-US'))
        });
        $("#submitButton").attr("disabled", "disabled");
        $("#warningSubmit").show();
        $("#productListArea").html(warningMessage.emptyProduct);
        //warningInput
    });

    function validateFrom() {
        let valid = true;
        importDetail.importDate = $("#importDate").val();
        importDetail.productList = getProductList().products;
        importDetail.supplierId = $("#supplierId").val();
        for (let key in importDetail) {
            if (importDetail[key] == '') {
                valid = false;
            }
        }
        if (!valid) alert('กรุณากรอกช้อมูลในช่องที่จำเป็นให้ครบ')
        else {
            $.ajax({
               url:"./SQL_Insert/insertImportList.php",
                data:importDetail,
                type:'post',
                dataType:'json',
                beforeSend:()=>{},
                success:r=>{
                    alert("นำเข้าสินค้ารายการ "+r.import_no+" สำเร็จ!");
                    location.reload();
                },
                error:e=>{
                    console.log(e);
                   alert("มีบางอย่างผิดพลาดกรุณาลองใหม่อีกครั้ง");
                }
            });
        }
    }

    function setDateToActualFormat(date) {
        console.log(date);
        return date.substr(3, 2) + "/" + date.substr(0, 2) + '/' + date.substr(6, 4);
    }

    function addToList() {
        let isValid = true;
        let isDuplicate = false;
        let productList = getProductList();
        let product = {
            id: $("#productId").val(),
            name: $("#productName").val(),
            type: $("#productType").val(),
            qty: $("#productQty").val(),
            purchaseCost: $("#purchaseCost").val(),
            productCost: $("#productCost").val()
        }

        for (let key in product) {
            if (product[key] == '' || product[key] == null) {
                isValid = false;
            }
        }

        if (getProductList().products.filter(f =>
            f.id == $("#productId").val()
        ).length > 0) {
            isDuplicate = true;
        }

        if (isValid && !isDuplicate) {
            productList.products.push(product);
            setProductList(productList);
            writeTable();
        } else if (!isValid) {
            alert('กรุณาเลือกสินค้า และ กรอกจำนวนให้ถูกต้อง');
        } else if (isDuplicate) {
            alert('สินค้าถูกเพิ่มไปแล้ว');
        }

    }

    function validateQty() {

        if (Number($("#productQty").val()) < 1) {
            alert('กรอกจำนวนสินค้าไม่ถูกต้อง');
            $("#productQty").val('')
        }
    }

    function removeProductList(index) {
        let list = getProductList();
        list.products.splice(index, 1);
        setProductList(list);
        writeTable();
    }

    function getProductList() {
        return JSON.parse(localStorage.getItem('productList'));
    }

    function setProductList(productList) {
        localStorage.setItem('productList', toJsonString(productList));
    }

    function writeTable() {
        let html = '';
        let productList = getProductList().products;
        let index = 0;
        let totalQty = 0;
        let totalCost = 0;
        for (let item of productList) {
            totalQty += Number(item.qty);
            totalCost += Number(item.qty)*Number(item.purchaseCost);
            html += "<tr>";
            html += "<td>" + item.id + "</td>";
            html += "<td>" + item.name + "</td>";
            html += "<td>" + item.type + "</td>";
            html += "<td>" + item.productCost + "</td>";
            html += "<td>" + item.purchaseCost + "</td>";
            html += "<td>" + item.qty + "</td>";
            html += "<td>" + item.purchaseCost * item.qty + "</td>";
            html += "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeProductList(" + index + ")'><i class='fa fa-times'></i> ยกเลิกรายการ</button></td>";
            html += "</tr>";
            index++;
        }
        html += "<tr class='font-weight-bold'>";
        html += "<td colspan='5' class='text-right'>รวม</td>";
        html += "<td>" + Number(totalQty) + "</td>";
        html += "<td>" + totalCost + "</td>";
        html += "<td></td>";
        html += "<td></td>";
        html += "</tr>";

        if (productList.length < 1) {
            $("#submitButton").attr("disabled", "disabled");
            $("#warningSubmit").show();
            html = warningMessage.emptyProduct;
        } else {
            $("#submitButton").removeAttr("disabled");
            $("#warningSubmit").hide();
        }
        importDetail.totalProductCost = Number(totalCost);
        $("#productListArea").html(html);
    }

    function toJsonString(obj) {
        return JSON.stringify(obj);
    }

    function getSupplierInfo() {
        $("#purchaseCost").val('');
        let id = $("#supplierId").val();
        $.get("./SQL_Select/selectSupplierById.php?id=" + id, r => {
            let json = JSON.parse(r);
            $("#supplierName").val(json.name);
            $("#supplierSaleName").val(json.salename);
            $("#supplierTel").val(json.tel);
            $("#supplierAddress").val(json.address);
        })
    }
    function getProductInfo() {
        $("#productQty").val('');
        $("#purchaseCost").val('');
        try {
            let id = $("#productId").val();
            $.get("./SQL_Select/selectProductById.php?id=" + id, r => {
                let json = JSON.parse(r);
                let img = '<img src="data:image/jpeg;base64,' + json.image + '" width="150" > <hr>';
                $("#productName").val(json.name);
                $("#productType").val(json.full_type);
                $("#productCost").val(json.cost);
                $("#productQty").val('');
                $("#productImg").html(img);
            });
        } catch (e) {
            $("#productQty").val('');
        }
    }
</script>

