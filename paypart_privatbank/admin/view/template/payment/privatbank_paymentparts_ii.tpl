<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-privat-payparts" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if (isset($error['error_warning'])) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error['error_warning']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-privat-payparts" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-status" data-toggle="tab"><?php echo $tab_order_status; ?></a></li>
          </ul> 
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
<!--              <div class="form-group required">
                <label class="col-sm-2 control-label" for="entry-email"><?php echo $entry_email; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="privatbank_paymentparts_email" value="<?php echo $privatbank_paymentparts_email; ?>" placeholder="<?php echo $entry_email; ?>" id="entry-email" class="form-control"/>
                  <?php if ($error_email) { ?>
                  <div class="text-danger"><?php echo $error_email; ?></div>
                  <?php } ?>
                </div>
              </div>   -->
<!--              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-live-demo"><span data-toggle="tooltip" title="<?php echo $help_test; ?>"><?php echo $entry_test; ?></span></label>
                <div class="col-sm-10">
                  <select name="privatbank_paymentparts_test" id="input-live-demo" class="form-control">
                    <?php if ($privatbank_paymentparts_test) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> -->
<!--              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-debug"><span data-toggle="tooltip" title="<?php echo $help_debug; ?>"><?php echo $entry_debug; ?></span></label>
                <div class="col-sm-10">
                  <select name="privatbank_paymentparts_debug" id="input-debug" class="form-control">
                    <?php if ($privatbank_paymentparts_debug) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>    -->
<!--              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-transaction"><?php echo $entry_transaction; ?></label>
                <div class="col-sm-10">
                  <select name="privatbank_paymentparts_transaction" id="input-transaction" class="form-control">
                    <?php if (!$privatbank_paymentparts_transaction) { ?>
                    <option value="0" selected="selected"><?php echo $text_authorization; ?></option>
                    <?php } else { ?>
                    <option value="0"><?php echo $text_authorization; ?></option>
                    <?php } ?>
                    <?php if ($privatbank_paymentparts_transaction) { ?>
                    <option value="1" selected="selected"><?php echo $text_sale; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_sale; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>   -->                           
              <!--  shop identification   -->
              <!--  shop: id  -->
              <div class="form-group required">                
<!--                <label class="col-sm-2 control-label" for="input-shop-id"><span data-toggle="tooltip" title="<?php echo $help_shop_id; ?>"><?php echo $entry_shop_id; ?></span></label>-->
                <label class="col-sm-2 control-label" for="input-shop-id"><?php echo $entry_shop_id; ?></label>
                <div class="col-sm-10">
                  <?php echo $text_paymentparts_url;?>
                  <input type="text" name="privatbank_paymentparts_ii_shop_id" value="<?php echo $privatbank_paymentparts_ii_shop_id; ?>" placeholder="<?php echo $entry_shop_id; ?>" id="input-shop-id" class="form-control"/>
                  <?php if ($error_privatbank_paymentparts_ii_shop_id) { ?>
                  <div class="text-danger"><?php echo $error_privatbank_paymentparts_ii_shop_id; ?></div>
                  <?php } ?>                  
                </div>
              </div>
              <!--  shop: password  -->
              <div class="form-group required">                
<!--                <label class="col-sm-2 control-label" for="input-shop-password"><span data-toggle="tooltip" title="<?php echo $help_shop_password; ?>"><?php echo $entry_shop_password; ?></span></label>-->
                <label class="col-sm-2 control-label" for="input-shop-password"><?php echo $entry_shop_password; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="privatbank_paymentparts_ii_shop_password" value="<?php echo $privatbank_paymentparts_ii_shop_password; ?>" placeholder="<?php echo $entry_shop_password; ?>" id="input-shop-password" class="form-control"/>
                  <?php if ($error_privatbank_paymentparts_ii_shop_password) { ?>
                  <div class="text-danger"><?php echo $error_privatbank_paymentparts_ii_shop_password; ?></div>
                  <?php } ?>                   
                </div>                
              </div>
               <!--  End shop identification   -->                
              <!--  merchantType   -->              
              <div class="form-group">                
                <label class="col-sm-2 control-label" for="input-merchantType-ii"><span data-toggle="tooltip" title="<?php echo $help_merchantType_ii; ?>"><?php echo $entry_merchantType_ii; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="privatbank_paymentparts_ii_merchantType" value="<?php echo $privatbank_paymentparts_ii_merchantType; ?>" placeholder="<?php echo $entry_merchantType_ii; ?>" id="input-merchantType-ii" class="form-control"/>
                </div>
              </div>                
              <!-- End merchantType   -->              
<!--              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                  <select name="privatbank_paymentparts_geo_zone_id" id="input-geo-zone" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php if ($geo_zone['geo_zone_id'] == $privatbank_paymentparts_geo_zone_id) { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div> -->         
              <!-- plugin status   -->
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="privatbank_paymentparts_ii_status" id="input-status" class="form-control">
                    <?php if ($privatbank_paymentparts_ii_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              </div>
              <!-- End plugin status   -->
              <div class="tab-pane" id="tab-status">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_completed_status; ?></label>
                    <div class="col-sm-10">
                      <select name="privatbank_paymentparts_ii_completed_status_id" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $privatbank_paymentparts_ii_completed_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_canceled_status; ?></label>
                    <div class="col-sm-10">
                      <select name="privatbank_paymentparts_ii_canceled_status_id" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $privatbank_paymentparts_ii_canceled_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_clientwait_status; ?></label>
                    <div class="col-sm-10">
                      <select name="privatbank_paymentparts_ii_clientwait_status_id" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $privatbank_paymentparts_ii_clientwait_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_created_status; ?></label>
                    <div class="col-sm-10">
                      <select name="privatbank_paymentparts_ii_created_status_id" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $privatbank_paymentparts_ii_created_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>                                                     
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_failed_status; ?></label>
                    <div class="col-sm-10">
                      <select name="privatbank_paymentparts_ii_failed_status_id" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $privatbank_paymentparts_ii_failed_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_rejected_status; ?></label>
                    <div class="col-sm-10">
                      <select name="privatbank_paymentparts_ii_rejected_status_id" class="form-control">
                        <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $privatbank_paymentparts_ii_rejected_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>                               
            </div>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>