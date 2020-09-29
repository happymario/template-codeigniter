<?php
/**
 * Created by PhpStorm.
 * User: KGY
 * Date: 2018-01-09
 * Time: 오전 10:41
 */
class ApiManage extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }

    public function apimanage(){
        $this->load->model("ApiListModel");
        $apilistmodel = new ApiListModel();
        $arr_list = $apilistmodel->getTotalApiList();
        $result = array();
        $result['apilist'] = $arr_list;
        $this->load_view("apimanage/apimanage",$result);
    }

    public function apierrors(){
        $this->load_view("apimanage/apierrors");
    }

    public function draw_apilist_table(){
        $this->load->model("ApiListModel");
        $apilistmodel = new ApiListModel();
        $arr_list = $apilistmodel->getTotalApiList();
        $result = array();
        $result['apilist'] = $arr_list;
        $this->load->view("apimanage/list_table",$result);
    }

    public function write(){
        $data = array();
        if($this->input->post("api_idx") == null){
            $data['api_idx'] = 0;
            $data['api_name'] = "";
            $data['api_exp'] = "";
            $data['api_method'] = "";
            $data['api_use'] = "";
            $data['api_status'] = "";
            $data['api_bigo'] = "";
        }else{
            $data['api_idx'] = $this->input->post("api_idx");
            if($this->input->post("api_idx") != 0){
                $this->load->model("ApiListModel");
                $api_list_model = new ApiListModel();
                $api_model = $api_list_model->findById($this->input->post("api_idx"));
                $data['api_name'] = $api_model->api_name;
                $data['api_exp'] =$api_model->api_exp;
                $data['api_method'] =$api_model->api_method;
                $data['api_use'] =$api_model->api_use;
                $data['api_status'] =$api_model->api_status;
                $data['api_bigo'] =$api_model->api_bigo;
            }
        }

        $this->load_view("apimanage/write",$data);
    }

    public function api_write(){
        $this->load->model("ApiListModel");
        $api_list_model = new ApiListModel();

        if($this->input->post("api_idx") == 0){
            $api_list_model->api_name = $this->input->post('api_name');
            $api_list_model->api_url = $this->input->post('api_name');
            $api_list_model->api_exp = $this->input->post('api_exp');
            $api_list_model->api_method = $this->input->post('api_method');
            $api_list_model->api_use = $this->input->post('api_use');
            $api_list_model->api_status = $this->input->post('api_status');
            $api_list_model->api_bigo = $this->input->post('api_bigo');

            $index = $api_list_model->save();
            if($index > 0){
                echo "success";
            }else{
                echo "error";
            }
        }else{
            $api_model = $api_list_model->findById($this->input->post("api_idx"));
            $api_model->api_name = $this->input->post('api_name');
            $api_model->api_url = $this->input->post('api_name');
            $api_model->api_exp = $this->input->post('api_exp');
            $api_model->api_method = $this->input->post('api_method');
            $api_model->api_use = $this->input->post('api_use');
            $api_model->api_status = $this->input->post('api_status');
            $api_model->api_bigo = $this->input->post('api_bigo');

            if($api_model->update_data()){
                echo "success";
            }else{
                echo "error";
            }
        }
    }

    public function delete_api_list(){
        $arr_id = json_decode(stripslashes($this->input->post("id")), true);
        $sql = "1=1";
        for($i = 0;$i<count($arr_id);$i++){
            if($i == 0){
                $sql.=" and ( api_idx=$arr_id[$i]";
            }else{
                $sql.=" or api_idx=$arr_id[$i]";
            }
            if($i == count($arr_id)-1){
                $sql.=")";
            }
        }
        $this->load->model("ApiListModel");
        $api_list_model = new ApiListModel();
        $api_list_model->deleteAll($sql);
        if($api_list_model->deleteAll($sql)){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function api_input_list(){
        $api_idx = $this->input->get("id");
        $this->load->model("ApiListModel");
        $api_list_model = new ApiListModel();
        $api_model = $api_list_model->findById($api_idx);


        $data['api_idx'] = $api_idx;
        $data['api_name'] = $api_model->api_name;

        $this->load->model("ApiInputModel");
        $input_model = new ApiInputModel();
        $arr_input_list = $input_model->getListByApiIdx($api_idx);
        $data['arr_input'] = $arr_input_list;
        
        $this->load_view("apimanage/api_input_list",$data);
    }

    public function edit_api_input_data(){
        $ai_idx = 0;
        if($this->input->get("ai_idx") != null){
            $ai_idx = $this->input->get("ai_idx");
            $this->load->model("ApiInputModel");
            $input_model = new ApiInputModel();

            $input_data =$input_model->findById($ai_idx);
            $data['api_idx'] = $input_data->api_idx;
            $data['ai_name'] = $input_data->ai_name;
            $data['ai_type'] = $input_data->ai_type;
            $data['ai_value'] = $input_data->ai_value;
            $data['ai_ness'] = $input_data->ai_ness;
            $data['ai_exp'] = $input_data->ai_exp;
            $data['ai_sort'] = $input_data->ai_sort;
            $data['ai_bigo'] = $input_data->ai_bigo;
        }else{
            $api_idx = $this->input->get("api_idx");
            $data['api_idx'] = $this->input->get("api_idx");
            $data['ai_name'] = "";
            $data['ai_type'] = "";
            $data['ai_value'] = "";
            $data['ai_ness'] = "";
            $data['ai_exp'] = "";
            $data['ai_sort'] = "";
            $data['ai_bigo'] = "";
        }


        $data['ai_idx'] = $ai_idx;
        $data['api_idx'] = $this->input->get("api_idx");
        $this->load_view("apimanage/edit_api_input_data",$data);
    }

    public function api_input_edit(){
        $ai_idx = $this->input->post("ai_idx");

        $this->load->model("ApiInputModel");
        $input_model = new ApiInputModel();

        if($ai_idx == 0){
            $input_model->api_idx = $this->input->post("api_idx");
            $input_model->ai_name = $this->input->post("ai_name");
            $input_model->ai_type = $this->input->post("ai_type");
            $input_model->ai_ness = $this->input->post("ai_ness");
            $input_model->ai_exp = $this->input->post("ai_exp");
            $input_model->ai_sort = $this->input->post("ai_sort");
            $inserted_id = $input_model->save();
            if($inserted_id > 0){
                echo "success";
            }else{
                echo "error";
            }
        }else{
            $input_model =$input_model->findById($ai_idx);
            $input_model->ai_idx = $ai_idx;
            $input_model->api_idx = $this->input->post("api_idx");
            $input_model->ai_name = $this->input->post("ai_name");
            $input_model->ai_type = $this->input->post("ai_type");
            $input_model->ai_ness = $this->input->post("ai_ness");
            $input_model->ai_exp = $this->input->post("ai_exp");
            $input_model->ai_sort = $this->input->post("ai_sort");

            if($input_model->update_data()){
                echo "success";
            }else{
                echo "error";
            }
        }
    }

    public function delete_api_input_data(){
        $arr_id = json_decode(stripslashes($this->input->post("id")), true);
        $sql = "api_idx=".$this->input->post('api_idx');
        for($i = 0;$i<count($arr_id);$i++){
            if($i == 0){
                $sql.=" and ( ai_idx=$arr_id[$i]";
            }else{
                $sql.=" or ai_idx=$arr_id[$i]";
            }
            if($i == count($arr_id)-1){
                $sql.=")";
            }
        }
        $this->load->model("ApiInputModel");
        $api_list_model = new ApiInputModel();
        $api_list_model->deleteAll($sql);
        if($api_list_model->deleteAll($sql)){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function draw_api_input_list(){
        $api_idx = $this->input->post("api_idx");
        $this->load->model("ApiListModel");
        $api_list_model = new ApiListModel();
        $api_model = $api_list_model->findById($api_idx);

        $data['api_idx'] = $api_idx;
        $data['api_name'] = $api_model->api_name;

        $this->load->model("ApiInputModel");
        $input_model = new ApiInputModel();
        $arr_input_list = $input_model->getListByApiIdx($api_idx);
        $data['arr_input'] = $arr_input_list;

        $this->load->view("apimanage/api_input_table",$data);
    }

    public function api_output_list(){
        $api_idx = $this->input->get("id");
        $this->load->model("ApiListModel");
        $api_list_model = new ApiListModel();
        $api_model = $api_list_model->findById($api_idx);


        $data['api_idx'] = $api_idx;
        $data['api_name'] = $api_model->api_name;

        $this->load->model("ApiOutputModel");
        $output_model = new ApiOutputModel();
        $arr_output_list = $output_model->getListByApiIdx($api_idx);
        $data['arr_output'] = $arr_output_list;

        $this->load_view("apimanage/api_output_list",$data);
    }

    public function edit_api_output_data(){
        $ai_idx = 0;
        if($this->input->get("ai_idx") != null){
            $ai_idx = $this->input->get("ai_idx");
            $this->load->model("ApiOutputModel");
            $input_model = new ApiOutputModel();

            $input_data =$input_model->findById($ai_idx);
            $data['api_idx'] = $input_data->api_idx;
            $data['ai_name'] = $input_data->ai_name;
            $data['ai_type'] = $input_data->ai_type;
            $data['ai_value'] = $input_data->ai_value;
            $data['ai_ness'] = $input_data->ai_ness;
            $data['ai_exp'] = $input_data->ai_exp;
            $data['ai_sort'] = $input_data->ai_sort;
            $data['ai_bigo'] = $input_data->ai_bigo;
        }else{
            $api_idx = $this->input->get("api_idx");
            $data['api_idx'] = $this->input->get("api_idx");
            $data['ai_name'] = "";
            $data['ai_type'] = "";
            $data['ai_value'] = "";
            $data['ai_ness'] = "";
            $data['ai_exp'] = "";
            $data['ai_sort'] = "";
            $data['ai_bigo'] = "";
        }


        $data['ai_idx'] = $ai_idx;
        $data['api_idx'] = $this->input->get("api_idx");
        $this->load_view("apimanage/edit_api_output_data",$data);
    }

    public function api_output_edit(){
        $ai_idx = $this->input->post("ai_idx");

        $this->load->model("ApiOutputModel");
        $input_model = new ApiOutputModel();

        if($ai_idx == 0){
            $input_model->api_idx = $this->input->post("api_idx");
            $input_model->ai_name = $this->input->post("ai_name");
            $input_model->ai_type = $this->input->post("ai_type");
            $input_model->ai_ness = $this->input->post("ai_ness");
            $input_model->ai_exp = $this->input->post("ai_exp");
            $input_model->ai_sort = $this->input->post("ai_sort");
            $inserted_id = $input_model->save();
            if($inserted_id > 0){
                echo "success";
            }else{
                echo "error";
            }
        }else{
            $input_model =$input_model->findById($ai_idx);
            $input_model->ai_idx = $ai_idx;
            $input_model->api_idx = $this->input->post("api_idx");
            $input_model->ai_name = $this->input->post("ai_name");
            $input_model->ai_type = $this->input->post("ai_type");
            $input_model->ai_ness = $this->input->post("ai_ness");
            $input_model->ai_exp = $this->input->post("ai_exp");
            $input_model->ai_sort = $this->input->post("ai_sort");

            if($input_model->update_data()){
                echo "success";
            }else{
                echo "error";
            }
        }
    }

    public function delete_api_output_data(){
        $arr_id = json_decode(stripslashes($this->input->post("id")), true);
        $sql = "api_idx=".$this->input->post('api_idx');
        for($i = 0;$i<count($arr_id);$i++){
            if($i == 0){
                $sql.=" and ( ai_idx=$arr_id[$i]";
            }else{
                $sql.=" or ai_idx=$arr_id[$i]";
            }
            if($i == count($arr_id)-1){
                $sql.=")";
            }
        }
        $this->load->model("ApiOutputModel");
        $api_list_model = new ApiOutputModel();
        $api_list_model->deleteAll($sql);
        if($api_list_model->deleteAll($sql)){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function draw_api_output_list(){
        $api_idx = $this->input->post("api_idx");

        $data['api_idx'] = $api_idx;

        $this->load->model("ApiOutputModel");
        $output_model = new ApiOutputModel();
        $arr_output_list = $output_model->getListByApiIdx($api_idx);
        $data['arr_output'] = $arr_output_list;

        $this->load->view("apimanage/api_output_table",$data);
    }

    public function apidocument(){
        $this->load->model("ApiListModel");
        $apilistmodel = new ApiListModel();
        $arr_list = $apilistmodel->getTotalApiList(true);
        $result = array();
        $result['apilist'] = $arr_list;
        $this->load_view("apimanage/apidocument",$result);
    }

    public function view(){
        $api_idx = $this->input->get("api_idx");
        $data = array();
        $data['info']['api_idx'] =$api_idx;
        $this->load->model("ApiListModel");
        $api_list_model = new ApiListModel();
        $api_model = $api_list_model->findById($api_idx);

        $data['info']['api_name'] = $api_model->api_name;
        $data['info']['api_exp'] =$api_model->api_exp;
        $data['info']['api_method'] =$api_model->api_method;
        $data['info']['api_use'] =$api_model->api_use;
        $data['info']['api_status'] =$api_model->api_status;
        $data['info']['api_bigo'] =$api_model->api_bigo;
        $data['info']['api_ver'] =$api_model->api_ver;

        //output목록
        $this->load->model("ApiOutputModel");
        $output_model = new ApiOutputModel();
        $arr_output_list = $output_model->getListByApiIdx($api_idx);
        $data['arr_output'] = $arr_output_list;

        //input목록
        $this->load->model("ApiInputModel");
        $input_model = new ApiInputModel();
        $arr_input_list = $input_model->getListByApiIdx($api_idx);
        $data['arr_input'] = $arr_input_list;

        $this->load_view("apimanage/view",$data);
    }
}