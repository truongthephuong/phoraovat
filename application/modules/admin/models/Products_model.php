<?php
    class Products_model extends CI_Model {
    	public function __construct() {
        	parent::__construct();
        	//stype 0: service | 1: product
        }

        //get list via cate id 
		public function getListProd($limit,$start,$id) {
		    $this->db->select('
		    	prod.id, prod.title name, prod.created, prod.rank, prod.image, prod.status,
		    	c.name catename, sc.name subcatename, sc2.name subcatename2
		    ');
			$this->db->from('products prod');
			$this->db->join('categories c', 'c.id = prod.cate_id', 'left');
			$this->db->join('subcategories sc', 'sc.id = prod.subcate_id', 'left');
			$this->db->join('sub2categories sc2', 'sc2.id = prod.subcate1_id', 'left');
		   	$this->db->order_by('created', 'DESC');
		   	$this->db->limit($limit,$start);

		    $query = $this->db->get();

		    if ($query->num_rows() > 0) {
				//echo $this->db->last_query();
				return $query->result();
			}
		    return false;
		}

		//get number of records via cate id
		public function record_count(){
			$this->db->from('products');
			return $this->db->count_all_results();
		}

		public function delField($field,$id,$tbName){
			$this->db->delete($tbName, array($field => $id));
			return true;
		}

		public function addNew($datas,$tbName){
			$this->db->insert($tbName, $datas);
			return true;
		}

		//Get detail via id
		public function getDetail($id){
		    $this->db->select();
		    $this->db->where('id', $id);
		   	$query = $this->db->get('products');
		   	return $query->result();
		}

		//Get more list via cate id and member id
		public function getListProdMore($fields,$cateId,$memId){
			$cond = 'status = 1';
		    $this->db->select($fields);
		    $this->db->where('status', 1);
		    $this->db->where('cate_id', $cateId);
		    $this->db->where('mem_id', $memId);
		   	$this->db->order_by('created', 'DESC');
		    $query = $this->db->get('asds');
		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
		    return false;
		}

        public function updateProductById($id,$data){
            $this->db->where('id', $id);
            $this->db->update('products', $data);
            //echo $this->db->last_query();exit;
            return true;
        }

        //stype 0: service | 1: product
		public function getAllServices(){
			$this->db->select('id,title as name');
            $this->db->where('status', 1);
            $this->db->where('style', 0);
			$query = $this->db->get('products');
			if ($query->num_rows() > 0) {
				foreach($query->result() as $data) {
					$items[$data->id] = $data->name;
				}
				$query->free_result();
				return $items;
			}
		}

		public function getProductWhere($id = 0, $subCateId = 0) {
			//echo $id;die;
			$this->db->select('id, title as name, description, price, image');
			$this->db->where('status', 1);
			$this->db->where('style', 0);

			if ($id > 0) {
				$this->db->where('cate_id', $id);
			}

			if ($subCateId > 0) {
				$this->db->where('subcate_id', $subCateId);
			}

			$query = $this->db->get('products');
			//echo $this->db->last_query();die;
			return $query->result();
		}

		//get service for home page
		public function getHomeProducts($style = 0, $limit = 1) {
			$this->db->select('id,title as name, description, price, image');
            $this->db->where('status', 1);
			$this->db->where('style', $style);
			$this->db->limit($limit, 0);
			$this->db->order_by('created', 'DESC');
			$query = $this->db->get('products');
			//echo $this->db->last_query();die;
			return $query->result();
		}
    }

?>