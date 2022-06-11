<?php

class Home extends CI_Controller
{
    function __construct()
	{
        parent::__construct();	
        if(chk_logged_user() === false)
		{
			redirect('login');
		}	
	}

    public function index()
    {
        $this->load->view('home');
    }

    public function submit_vehicle_details()
    {
        //ini_set('display_errors',1);
        $veh_name = $this->input->post('veh_name');
        $veh_type = $this->input->post('veh_type');
        $manf_year = $this->input->post('man_year');
        $pur_date = $this->input->post('pur_date');

        if($veh_name == "" || $veh_type == "" || $manf_year == "" || $pur_date == "")
        {
            echo json_encode(array('status'=>404,'msg'=>'Please Fill all fields'));
            return false;
        }


        $data = array(
            'veh_name'=>$veh_name,
            'veh_type'=>$veh_type,
            'man_year'=>$manf_year,
            'pur_date'=>$pur_date,
            'created_on'=>time(),
        );

        $this->load->model('vehicle_model');
        
        $result = $this->vehicle_model->insert($data);
        
        if(!$result)
        {
            echo json_encode(array('status'=>404,'msg'=>'Error. Something went wrong.'));
            return false;
        }
        echo json_encode(array('status'=>200,'msg'=>'Vehicle Details Submitted.'));
    }

    public function get_vehicle_details_data()
    {
        $this->load->model('vehicle_model');

        $start = intval($_POST['start']);
		$draw = intval($_POST['draw']);
		$limit = intval($_POST['length']);

        $total_rows = count($this->vehicle_model->get_where(false, false));

        $doc_data = $this->vehicle_model->get_where(
            $limit,
            $start
        );

        $result=array();
        $count = 1;
		
		foreach($doc_data as &$doc)
		{
            $edit = '<a href="'.base_url().'/home/edit/'.$doc['id'].'"  class="btn btn-primary">Edit</a>';
            $delete = '<a href="javascript:void(0);"  onclick="delete_data('.$doc['id'].')" class="btn btn-primary">X</a>';

            $created_at = date('d-M-Y', $doc['created_on']);
            if($doc['updated_on'] != '') $updated_at = date('d-M-Y', $doc['updated_on']);
            else $updated_at = '';

            $result[]=array(
                $count++,
                $doc['veh_name'],
                $doc['veh_type'],
                $doc['man_year'],
                $doc['pur_date'],
                $created_at,
                $updated_at,
                $edit.'<br>'.$delete
            );
		}
		echo json_encode(array("draw"=>$draw, "recordsTotal"=>$total_rows, "recordsFiltered"=>$total_rows, "data"=>$result));
    } 

    public function edit($id)
    {
        $this->load->model('vehicle_model');
        $data['details'] = $this->vehicle_model->get_details($id,true);
        $this->load->view('edit',$data);
    }

    public function update_vehicle_details()
    {
        $id = $this->input->post('id');
        $veh_name = $this->input->post('veh_name');
        $veh_type = $this->input->post('veh_type');
        $manf_year = $this->input->post('man_year');
        $pur_date = $this->input->post('pur_date');

        if($veh_name == "" || $veh_type == "" || $manf_year == "" || $pur_date == "")
        {
            echo json_encode(array('status'=>404,'msg'=>'Please Fill all fields'));
            return false;
        }

        $data['data'] = array(
            'veh_name'=>$veh_name,
            'veh_type'=>$veh_type,
            'man_year'=>$manf_year,
            'pur_date'=>$pur_date,
            'updated_on'=>time(),
        );
        $this->load->model('vehicle_model');
        $data['condition'] = array('id'=>$id);
        $result = $this->vehicle_model->update($data);
        
        if(!$result)
        {
            echo json_encode(array('status'=>404,'msg'=>'Error. Something went wrong.'));
            return false;
        }
        echo json_encode(array('status'=>200,'msg'=>'Updated Succesfully'));
    }

    public function delete_data()
    {
        $this->load->model('vehicle_model');
        $id = $this->input->post('id');
        $result = $this->vehicle_model->delete($id);
        if(!$result)
        {
            echo json_encode(array('status'=>404,'msg'=>'Record not Deleted'));
            return false;
        } 
        echo json_encode(array('status'=>200,'msg'=>'Record Deleted'));
    }

}




?>