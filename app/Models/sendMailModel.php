<?php 
namespace App\Models;
use CodeIgniter\Model;

class sendMailModel extends Model {

    protected $table = 'mytt_web_send_message_table';
    protected $primaryKey = 'id'; 
   protected $useAutoIncrement = true; 
   protected $insertID = 0; 
   protected $returnType = 'array'; 
   protected $useSoftDeletes = false; 
   protected $protectFields = true; 

    protected $allowedFields = [
        'name',
        'from',
        'to',
        'mobile',
        'message',
        'action'
    ];

    // Dates 
   protected $useTimestamps = false; 
   protected $dateFormat = 'datetime'; 
   protected $createdField = 'created_at'; 
   protected $updatedField = 'updated_at'; 
   protected $deletedField = 'deleted_at'; 

   // Validation 
   protected $validationRules = []; 
   protected $validationMessages = []; 
   protected $skipValidation = false; 
   protected $cleanValidationRules = true; 

   // Callbacks 
   protected $allowCallbacks = true; 
   protected $beforeInsert = []; 
   protected $afterInsert = []; 
   protected $beforeUpdate = []; 
   protected $afterUpdate = []; 
   protected $beforeFind = []; 
   protected $afterFind = []; 
   protected $beforeDelete = []; 
   protected $afterDelete = []; 

   public function get_all_data()
   {
       $this->db = \Config\Database::connect();
       $query = $this->db->query('select * from ' . $this->table);
       return $query->getResultArray();
   }
}

?>