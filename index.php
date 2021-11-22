<?php

?>
<html lang="en">
<head>
    <title>Filter Offers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <style>

        .my-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>

<div class="my-container">
    <div class="row m-5">
        <div class="col-12">
            <h2>Offer Test</h2>
        </div>
        <div class="col-12">
            <p>The form below contains two input elements; one of filter type text and one of filter type value/s
                text:</p>
        </div>
        <div class="col-12">
            <form class="row  d-flex justify-content-around" id="offer-form">

                <div class="form-group col-12 col-md-6 my-2">
                    <label for="radio"><strong>Select Type Input</strong></label>
                    <input type="radio" id="radio" value="0" name="radio">
                </div>
                <div class="form-group col-12 col-md-6 my-2">
                    <label for="radio"><strong>Select Type Select</strong></label>
                    <input type="radio" id="radio" value="1" name="radio">
                </div>
                <div class="form-group col-12 col-md-6 my-2">
                    <label for="filter_type"><strong>Filter Type:</strong></label>
                    <input disabled required type="text" class="form-control" id="filter_type" name="filter_type">
                </div>
                <div class="form-group col-12 col-md-6 my-2">
                    <label for="filter_type_select"><strong>Filter Type:</strong></label>
                    <select disabled required class="form-control custom-select" id="filter_type_select"
                            name="filter_type_select">
                        <option value="offer_id">Offer Id</option>
                        <option value="product_title">Product Title</option>
                        <option value="vendor_id">Vendor Id</option>
                        <option value="price">Price</option>
                        <option value="price_range">Price Range</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6 my-2">
                    <label for="filter_type_val"><strong>Filter Type Value:</strong></label>
                    <input required type="text" class="form-control" id="filter_type_val" name="filter_type_val">
                </div>
                <div class="col-12 text-center my-2">
                    <button type="submit" class="btn btn-outline-primary">Go</button>
                </div>
            </form>
        </div>
        <div class="col-12 text-center" id="result"></div>
    </div>
</div>

</body>

<script>
    let $ = jQuery;
    $(document).ready(function () {
        let filterText = $('#filter_type');
        let filterSelect = $('#filter_type_select');
        $('input[name="radio"]').change(function (e) {
            if ($(this).is(":checked")) {
                if (this.value === "0") {
                    filterText.prop("disabled", false);
                    filterSelect.prop("disabled", true);
                } else if (this.value === "1") {
                    filterText.prop("disabled", true);
                    filterSelect.prop("disabled", false);
                } else {
                    filterText.prop("disabled", true);
                    filterSelect.prop("disabled", true);
                }
            }
        }).trigger('change');
        $('#offer-form').submit(function (e) {
            e.preventDefault();
            let val = "";
            let input = $('#filter_type_val').val();
            if (!filterText.prop('disabled')) {
                val = filterText.val();
            } else if (!filterSelect.prop('disabled')) {
                val = filterSelect.val();
            } else {
                swal("Error", "please select a filter type first and choose a value", "error");
                return false;
            }
            $.ajax({
                    url: "/getOffer.php",
                    type: "POST",
                    data: {
                        "offer_filter": val,
                        "offer_filter_type": input,
                    },
                    success: function (response) {
                        if (response.error) {
                            swal("Oops", response.error, "error");
                        } else {
                            let str = " equals ";
                            if (val === "price_range" || val === "count_by_price_range") {
                                input = input.split(' ');
                                str = " between " + input[0] + " and " + input[1];

                            } else {
                                input = input.split(' ')[0];
                                str += input;
                            }
                            swal("Success", "We have found " + response.success.count + " matching offer/s with " + val.replace('_', ' ') + str, "success");
                        }
                        console.log(response)
                    }
                }
            );
        });
    })
</script>
</html>
