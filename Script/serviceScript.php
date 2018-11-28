<script>
    const productList = {};
    productList.products = [];
    localStorage.setItem('productList', toJsonString(productList));

    const serviceDetail = {
        customerId: "",
        productList: [],
        totalProductCost: 0,
        installCost: 0,
        transferCost: 0,
        totalCost: 0,
        netCost: 0,
        remainCost: 0,
        discount: 0,
        depositCost: 0,
        orderDate: "",
        installAddress: "",
        installDate: "",
        paymentStatus: "N",
        urgentCall: "",
        urgentName: "",
        isDiscountPercent: false
    }
    const warningMessage = {
        emptyProduct: "<tr class='font-weight-bold text-center text-warning'><td colspan='8'><i class='fa fa-exclamation-triangle'></i> ยังไม่ได้เลือกสินค้า </td></tr>"
    }

    $(document).ready(() => {

        $('#orderDate').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            value: setDateToActualFormat(new Date().toLocaleDateString('en-US'))
        });

        $('#installDate').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
        });

        $("#emergencyTel").mask("999-9999999");
        $("#submitButton").attr("disabled", "disabled");
        $("#installCost").attr("disabled", "disabled");
        $("#discountRate").attr("disabled", "disabled");
        $("#transferCost").attr("disabled", "disabled");
        $("#depositCost").attr("disabled", "disabled");
        $("#warningSubmit").show();
        $("#warningInput").show();
        $("#installAddress").val('');
        $("#totalProductCost").val(serviceDetail.totalProductCost);
        $("#productListArea").html(warningMessage.emptyProduct);
        //warningInput
    });

    function validateFrom() {
        let valid = true;
        serviceDetail.customerId = $("#customerId").val();
        serviceDetail.productList = getProductList().products;
        serviceDetail.totalProductCost = $("#totalProductCost").val();
        serviceDetail.installCost = $("#installCost").val();
        serviceDetail.transferCost = $("#transferCost").val();
        serviceDetail.totalCost = $("#totalCost").val();
        serviceDetail.netCost = $("#netCost").val();
        serviceDetail.depositCost = $("#depositCost").val();
        serviceDetail.remainCost = $("#remainCost").val();
        serviceDetail.orderDate = $("#orderDate").val();
        serviceDetail.installAddress = $("#installAddress").val();
        serviceDetail.installDate = $("#installDate").val();
        serviceDetail.urgentName = $("#emergencyName").val();
        serviceDetail.urgentCall = $("#emergencyTel").val();

        if (serviceDetail.remainCost == 0) {
            serviceDetail.paymentStatus = 'Y';
        } else {
            serviceDetail.paymentStatus = 'N';
        }
        for (let key in serviceDetail) {
            if(key=='isDiscountPercent'){

            }else if (serviceDetail[key] == '') {
                valid = false;
            }
        }
        if (!valid) alert('กรุณากรอกช้อมูลในช่องที่จำเป็นให้ครบ')
        else {
            /*$.post("./SQL_Insert/insertServiceList.php",serviceDetail,r=>{
                console.log(r);
            })*/
            $.ajax({
                url:"./SQL_Insert/insertServiceList.php",
                data:serviceDetail,
                type:'post',
                dataType:'json',
                beforeSend:()=>{},
                success:r=>{
                    if(r){
                        alert("เพิ่มรายการสำเร็จแล้ว !");
                        window.location.href = "genPDF.php?service_no="+r.service_no;
                    }
                },
                error:e=>{
                    alert("มีบางอย่างผิดพลาดกรุณาลองใหม่อีกครั้ง");
                }
            });

        }
    }

    function calculateTotalCost(type) {
        let installCost = Number($("#installCost").val());
        let transferCost = Number($("#transferCost").val());
        let discountCost = Number($("#discountRate").val());
        let valid = true;
        if (installCost < 0) {
            $("#installCost").val('');
            valid = false;
            if (type == 'install') {
                alert("ระบุค่าติดตั้งไม่ถูกต้อง");
            }
        }
        if (transferCost < 0) {
            $("#transferCost").val('');
            valid = false;
            if (type == 'transfer') {
                alert("ระบุค่าขนส่งไม่ถูกต้อง");
            }
        }
        if (valid) {
            let html = '<i>ได้รับส่วนลด';
            serviceDetail.installCost = Number(installCost);
            serviceDetail.transferCost = Number(transferCost);
            serviceDetail.totalCost = Number(installCost) + Number(transferCost) + Number(serviceDetail.totalProductCost);
            console.log(installCost + ":" + transferCost);
            $('#totalCost').val(serviceDetail.totalCost);

            if (serviceDetail.isDiscountPercent) {
                serviceDetail.discount = (serviceDetail.totalCost * discountCost / 100);
                html += ' ' + discountCost + "% เป็นจำนวน " + serviceDetail.discount + " บาท";
            } else {
                serviceDetail.discount = discountCost;
                html += ' ' + serviceDetail.discount + " บาท";
            }
            html += '</i>';
            serviceDetail.netCost = serviceDetail.totalCost - serviceDetail.discount;
            $("#netCost").val(serviceDetail.netCost);
            $("#netCostRemark").html(html);
        }

    }


    function validateDateInstall() {
        let newInstallDate = setDateToActualFormat($('#installDate').val());
        let newOrderDate = setDateToActualFormat($('#orderDate').val());
        let installDate = new Date(newInstallDate).setHours(0, 0, 0, 0);
        let currentDate = new Date(newOrderDate).setHours(0, 0, 0, 0);
        console.log(installDate);
        console.log(currentDate);
        if (installDate < currentDate) {
            alert('ระบุวันที่ติดตั้งไม่ถูกต้อง');
            $('#installDate').val('');
            console.log(serviceDetail);
        } else {
            serviceDetail.installDate;
        }

    }

    function setDateToActualFormat(date) {
        console.log(date);
        return date.substr(3, 2) + "/" + date.substr(0, 2) + '/' + date.substr(6, 4);
    }

    function setAddress() {
        $("#installAddress").val('');
        if ($('#cusAddress').val().trim() != '' || $('#cusAddress').val() != null) {
            $("#installAddress").val($('#cusAddress').val());
            serviceDetail.installAddress = $("#installAddress").val();
        }
    }

    function setAddressService() {
        serviceDetail.installAddress = $("#installAddress").val();
    }

    function addToList() {
        let isValid = true;
        let isDuplicate = false;
        let productList = getProductList();
        let product = {
            id: $("#productId").val(),
            name: $("#productName").val(),
            type: $("#productType").val(),
            cost: $("#productCost").val(),
            insurance: $("#productInsurance").val(),
            qty: $("#productQty").val()
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

    function setServiceDetail(key) {
        serviceDetail[key] = $('#' + key).val();
    }

    function validateQty() {
        /*  console.log(Number($("#productQty").val()) +" : "+  Number($("#productStock").val()));
          console.log(Number($("#productQty").val())> Number($("#productStock").val()));*/
        if (Number($("#productQty").val()) > Number($("#productStock").val())) {
            alert('จำนวนสินค้าไม่พอ');
            $("#productQty").val('')
        } else if (Number($("#productQty").val()) < 1) {
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

    function calculateRemainCost() {

        let depositCost = $("#depositCost").val();
        let valid = true;
        console.log(serviceDetail);
        if (depositCost < 1 || depositCost > serviceDetail.netCost) {
            $("#depositCost").focus();
            $("#depositCost").val('');
            alert('จำนวนชำระ/มัดจำไม่ถูกต้อง');

        } else if (depositCost < serviceDetail.netCost / 2) {
            $("#depositCost").focus();
            $("#depositCost").val('');
            valid = false;
            alert('จำนวนชำระ/มัดจำ ต้องมากกว่า 50% ของราคาทั้งหมด');
        }
        if (valid) {
            serviceDetail.remainCost = serviceDetail.netCost - depositCost;
            $("#remainCost").val(serviceDetail.remainCost);
        }else{
            $("#remainCost").val('');
        }


    }

    function checkValidDiscountRate() {
        serviceDetail.isDiscountPercent = $("#percentFlag")[0].checked;
        let valid = true;
        if (serviceDetail.isDiscountPercent) {
            if ($("#discountRate").val() > 100 || $("#discountRate").val() < 0) {
                valid = false;
            }
        } else {
            if ($("#discountRate").val() < 0 || $("#discountRate").val() >= serviceDetail.totalProductCost) {
                valid = false;
            }
        }
        if (!valid) {
            $("#discountRate").val('');
            alert("ระบุอัตราส่วนลดไม่ถูกต้อง")
        }
        calculateTotalCost('discount')
        calculateRemainCost()

    }

    function writeTable() {
        let html = '';
        let productList = getProductList().products;
        let index = 0;
        let totalQty = 0;
        let totalCost = 0;
        for (let item of productList) {
            totalQty += Number(item.qty);
            totalCost += Number(item.qty * item.cost);
            html += "<tr>";
            html += "<td>" + item.id + "</td>";
            html += "<td>" + item.name + "</td>";
            html += "<td>" + item.type + "</td>";
            html += "<td>" + item.insurance + "</td>";
            html += "<td>" + item.qty + "</td>";
            html += "<td>" + item.cost + "</td>";
            html += "<td>" + item.cost * item.qty + "</td>";
            html += "<td><button class='btn btn-danger btn-sm' type='button' onclick='removeProductList(" + index + ")'><i class='fa fa-times'></i> ยกเลิกรายการ</button></td>";
            html += "</tr>";
            index++;
        }
        html += "<tr class='font-weight-bold'>";
        html += "<td colspan='4' class='text-right'>รวม</td>";
        html += "<td>" + Number(totalQty) + "</td>";
        html += "<td></td>";
        html += "<td>" + totalCost + "</td>";
        html += "<td></td>";
        html += "</tr>";

        if (productList.length < 1) {
            $("#submitButton").attr("disabled", "disabled");
            $("#installCost").attr("disabled", "disabled");
            $("#transferCost").attr("disabled", "disabled");
            $("#discountRate").attr("disabled", "disabled");
            $("#depositCost").attr("disabled", "disabled");
            $("#warningSubmit").show();
            $("#warningInput").show();
            html = warningMessage.emptyProduct;
        } else {
            $("#submitButton").removeAttr("disabled");
            $("#installCost").removeAttr("disabled");
            $("#transferCost").removeAttr("disabled");
            $("#discountRate").removeAttr("disabled");
            $("#depositCost").removeAttr("disabled");

            $("#warningSubmit").hide();
            $("#warningInput").hide();
        }
        serviceDetail.totalProductCost = Number(totalCost);
        $("#totalProductCost").val(totalCost);
        $("#productListArea").html(html);
    }

    function toJsonString(obj) {
        return JSON.stringify(obj);
    }

    function getCustomerInfo() {
        let id = $("#customerId").val();
        $.get("./SQL_Select/selectCustomerById.php?id=" + id, r => {
            let json = JSON.parse(r);
            $("#cusName").val(json.c_name);
            $("#cusTel").val(json.c_tel);
            $("#cusAddress").val(json.c_address);
        })
    }

    function getProductInfo() {
        $("#productQty").val('');
        try {
            let id = $("#productId").val();
            $.get("./SQL_Select/selectProductById.php?id=" + id, r => {
                let json = JSON.parse(r);
                let img = '<img src="data:image/jpeg;base64,' + json.image + '" width="150" > <hr>';
                $("#productName").val(json.name);
                $("#productType").val(json.full_type);
                $("#productCost").val(json.cost);
                $("#productStock").val(json.stock);
                $("#productInsurance").val(json.insurance);
                $("#productQty").val('');
                $("#productImg").html(img);
            });
        } catch (e) {
            $("#productQty").val('');
        }
    }
</script>

