<?php $pearl_cf7 = array();
$pearl_cf7[530] = '<div class="track_your_shipment_form">

<div class="row">

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<div class="form-group stc_b">
<p>Transportation mode</p>
</div>
</div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
<div class="form-group stc_b">
[radio mode use_label_element "Air Ground" "Ocean" "Brokerage" "All"]
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<div class="form-group v-align stc_b">
<p>Search Type</p>
</div>
</div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
<div class="form-group stc_b">
[select type "House Waybill" "House Waybill 2" "House Waybill 3" "House Waybill 4"]
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<div class="form-group v-align stc_b">
<p>Search Number(s)*</p>
</div>
</div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
<div class="form-group stc_b">
[textarea* numbers]
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
</div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
<button class="form-control btn btn_primary btn_icon-right btn_solid btn btn_inlined btn_icon-bg  stm_wpcf7_submit wpcf7-form-control">Get a Quote <i class="stmicon-arrow-next2 btn__icon icon_12p mtc"></i></button>
</div>
</div>
<br/>
<p>This will return up to 100 records matching your criteria.</p>
</div>';
$pearl_cf7[502] = '<div class="request_quote_page">
<div class="row">

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group freight stc_b">
[select freight_type first_as_label "Freight Type" "Road Transportation" "Air Transportation" "Sea Transportation" "Warehousing"]
</div>

<div class="form-group departure stc_b">
[text* departure_city placeholder "City of departure"]
</div>

<div class="form-group delivery stc_b">
[text delivery_city placeholder "Delivery city"]
</div>

<div class="form-group incoterms stc_b">
[select incoterms first_as_label "Incoterms" "EXW" "FCA" "CPT" "CIP" "DAT"]
</div>

<div class="form-group gross stc_b">
[text total_weight placeholder "Total gross weight (KG)"]
</div>

</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group gross stc_b">
[text text-670 class:dimension placeholder "Dimension"]
</div>

<div class="form-group email-input stc_b">
[email* email placeholder "Email"]
</div>

<div class="form-group email-input stc_b">
[textarea textarea-501 40x5 class:message placeholder "Message"]
</div>

<div class="form-group">

<button class="form-control btn btn_primary btn_icon-right btn_solid btn btn_inlined btn_no-icon-bg  stm_wpcf7_submit wpcf7-form-control">Get a Quote <i class="stmicon-arrow-next2 btn__icon icon_12p mtc"></i></button>

</div>

</div>

</div>
</div>';
$pearl_cf7[248] = '<div class="request_quote">
<div class="row">

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group freight stc_b">
[select freight_type first_as_label "Freight Type" "Road Transportation" "Air Transportation" "Sea Transportation" "Warehousing"]
</div>

<div class="form-group departure stc_b">
[text* departure_city placeholder "City of departure"]
</div>

<div class="form-group delivery stc_b">
[text delivery_city placeholder "Delivery city"]
</div>

</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group gross stc_b">
[text total_weight placeholder "Total gross weight (KG)"]
</div>

<div class="form-group email-input stc_b">
[email* email placeholder "Email"]
</div>

<div class="form-group">
[submit "Get a Quote"]


</div>

</div>

</div>
</div>';
$pearl_cf7[247] = '<div class="contact_form">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
[text* name placeholder akismet:author "Name *"]
</div>
<div class="form-group">
[email* email placeholder akismet:author_email "E-mail *"]
</div>

</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
[textarea* message placeholder "Message *"]
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group" style="padding-top: 10px;">
[checkbox newsletter use_label_element "Subscribe to our newsletter"]
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
<div class="form-group sm-text-left">
[submit class:btn_no-icon-bg class:tbc_a "Submit"]

</div>
</div>
</div>
</div>';