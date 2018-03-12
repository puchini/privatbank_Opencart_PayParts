<?php
class ControllerPaymentPrivatbankPaymentpartsPp extends Controller {

    private $error = array();
    private $data = array(); 
    
    public function index() {

        $this->language->load('payment/privatbank_paymentparts_pp');
        
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                
                $this->model_setting_setting->editSetting('privatbank_paymentparts_pp', $this->request->post);              
        
                $this->session->data['success'] = $this->language->get('text_success');
        
//                $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
                $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');
        
        //This is how the language gets pulled through from the language file.
        //
        // If you want to use any extra language items - ie extra text on your admin page for any reason,
        // then just add an extra line to the $text_strings array with the name you want to call the extra text,
        // then add the same named item to the $_[] array in the language file.
        //
        // 'my_module_example' is added here as an example of how to add - see admin/language/english/module/my_module.php for the
        // other required part.
        
//        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $text_strings = array(
                'heading_title',
                'text_edit',
                'text_enabled',
                'text_disabled',
                'text_content_top',
                'text_content_bottom',
                'text_column_left',
                'text_column_right',
                'entry_layout',
                'entry_limit',
                'entry_image',
                'entry_position',
                'entry_status',
                'entry_sort_order',
                'entry_merchantType_pp',
                'entry_shop_id',
                'entry_shop_password',
                'button_save',
                'button_cancel',
                'button_add_module',
                'button_remove',
                'entry_example',
                'entry_completed_status',
                'entry_failed_status',
                'entry_canceled_status',
                'entry_rejected_status',
                'entry_clientwait_status',
                'entry_created_status',
                'tab_general',
                'tab_order_status',
                'help_merchantType_pp',
                'error_privatbank_paymentparts_pp_shop_id',
                'error_privatbank_paymentparts_pp_shop_password',
                'text_paymentparts_url' //this is an example extra field added                
        );
        
//        print_r($this->request->server['REQUEST_METHOD']);exit;
        foreach ($text_strings as $text) {            
            $this->data[$text] = $this->language->get($text);
        }
             
        //END LANGUAGE

        if (isset($this->error['warning'])) {
                $this->data['error_warning'] = $this->error['warning'];
        } else {
                $this->data['error_warning'] = '';
        }

        if (isset($this->error['code'])) {
                $this->data['error_code'] = $this->error['code'];
        } else {
                $this->data['error_code'] = '';
        }
        
        if (isset($this->error['shop_id'])) {
                $this->data['error_privatbank_paymentparts_pp_shop_id'] = $this->error['shop_id'];
        } else {
                $this->data['error_privatbank_paymentparts_pp_shop_id'] = '';
        }
        
        if (isset($this->error['shop_password'])) {
                $this->data['error_privatbank_paymentparts_pp_shop_password'] = $this->error['shop_password'];
        } else {
                $this->data['error_privatbank_paymentparts_pp_shop_password'] = '';
        }          
        
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_module'),
        'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('payment/privatbank_paymentparts_pp', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
        );
                
        $this->data['action'] = $this->url->link('payment/privatbank_paymentparts_pp', 'token=' . $this->session->data['token'], 'SSL');
                
        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
        
        /*

             Assign your form variables here ...
        
        */
        
        /* form variables */
        //plugin status
        if (isset($this->request->post['privatbank_paymentparts_pp_status'])) {
            $this->data['privatbank_paymentparts_pp_status'] = $this->request->post['privatbank_paymentparts_pp_status'];
        } else {
            $this->data['privatbank_paymentparts_pp_status'] = $this->config->get('privatbank_paymentparts_pp_status');
        }
        //End plugin status
        # group: shop identification
        // shop id
        if (isset($this->request->post['privatbank_paymentparts_pp_shop_id'])) {
            $this->data['privatbank_paymentparts_pp_shop_id'] = $this->request->post['privatbank_paymentparts_pp_shop_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_shop_id'] = $this->config->get('privatbank_paymentparts_pp_shop_id');
        } 
        // shop password
        if (isset($this->request->post['privatbank_paymentparts_pp_shop_password'])) {
            $this->data['privatbank_paymentparts_pp_shop_password'] = $this->request->post['privatbank_paymentparts_pp_shop_password'];
        } else {
            $this->data['privatbank_paymentparts_pp_shop_password'] = $this->config->get('privatbank_paymentparts_pp_shop_password');
        }                
        # End group: shop identification

        // merchantType: pp
        if (isset($this->request->post['$privatbank_paymentparts_pp_merchantType'])) {
            $this->data['privatbank_paymentparts_pp_merchantType'] = $this->request->post['$privatbank_paymentparts_pp_merchantType'];
        } else {
            $this->data['privatbank_paymentparts_pp_merchantType'] = $this->config->get('privatbank_paymentparts_pp_merchantType');
        }                      

        /* End form variables */ 
        
        if (isset($this->request->post['privatbank_paymentparts_pp_completed_status_id'])) {
            $this->data['privatbank_paymentparts_pp_completed_status_id'] = $this->request->post['privatbank_paymentparts_pp_completed_status_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_completed_status_id'] = $this->config->get('privatbank_paymentparts_pp_completed_status_id');
        }
        
        if (isset($this->request->post['privatbank_paymentparts_pp_canceled_status_id'])) {
            $this->data['privatbank_paymentparts_pp_canceled_status_id'] = $this->request->post['privatbank_paymentparts_pp_canceled_status_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_canceled_status_id'] = $this->config->get('privatbank_paymentparts_pp_canceled_status_id');
        }
        
        if (isset($this->request->post['privatbank_paymentparts_pp_clientwait_status_id'])) {
            $this->data['privatbank_paymentparts_pp_clientwait_status_id'] = $this->request->post['privatbank_paymentparts_pp_clientwait_status_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_clientwait_status_id'] = $this->config->get('privatbank_paymentparts_pp_clientwait_status_id');
        }
        
        if (isset($this->request->post['privatbank_paymentparts_pp_created_status_id'])) {
            $this->data['privatbank_paymentparts_pp_created_status_id'] = $this->request->post['privatbank_paymentparts_pp_created_status_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_created_status_id'] = $this->config->get('privatbank_paymentparts_pp_created_status_id');
        }                         
                
        if (isset($this->request->post['privatbank_paymentparts_pp_failed_status_id'])) {
            $this->data['privatbank_paymentparts_pp_failed_status_id'] = $this->request->post['privatbank_paymentparts_pp_failed_status_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_failed_status_id'] = $this->config->get('privatbank_paymentparts_pp_failed_status_id');
        }
        
        if (isset($this->request->post['privatbank_paymentparts_pp_rejected_status_id'])) {
            $this->data['privatbank_paymentparts_pp_rejected_status_id'] = $this->request->post['privatbank_paymentparts_pp_rejected_status_id'];
        } else {
            $this->data['privatbank_paymentparts_pp_rejected_status_id'] = $this->config->get('privatbank_paymentparts_pp_rejected_status_id');
        }                
        
        $this->load->model('localisation/order_status');

        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();               

        $this->load->model('design/layout');
                
        $this->data['layouts'] = $this->model_design_layout->getLayouts();
                
        $this->template = 'payment/privatbank_paymentparts_pp.tpl';
        $this->children = array(
                'common/header',
                'common/footer'
        );
                
        
        switch(VERSION){
            case '2.1.0.2':
            case '2.1.0.1':
            case '2.2.0.0_a1':
            case '2.0.3.1': 
            case '2.0.2.0':
            case '2.0.1.1':
            case '2.0.1.0':
            case '2.0.0.0':
                //set commom elements of view
                $this->data['header'] = $this->load->controller('common/header');
                $this->data['column_left'] = $this->load->controller('common/column_left');
                $this->data['footer'] = $this->load->controller('common/footer');
                //render template            
                $this->response->setOutput($this->load->view($this->template, $this->data));
              break;
            default:
              $this->response->setOutput($this->render());
              break;            
        }
        
    }
    
    public function validate() {
    
        if (!$this->user->hasPermission('modify', 'payment/privatbank_paymentparts_pp')) {
                $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (!$this->request->post['privatbank_paymentparts_pp_shop_id']) {
            $this->error['shop_id'] = $this->language->get('error_privatbank_paymentparts_pp_shop_id');
        }
        
        if (!$this->request->post['privatbank_paymentparts_pp_shop_password']) {
            $this->error['shop_password'] = $this->language->get('error_privatbank_paymentparts_pp_shop_password');
        }         
        
                
        /*

            Validate your form here ...

        */
        
        return !$this->error;
                
//        if (!$this->error) {
//                return true;
//        } else {
//                return false;
//        }
    }
}
?>
