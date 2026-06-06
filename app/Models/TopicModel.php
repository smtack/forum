<?php

namespace App\Models;

use CodeIgniter\Model;

class TopicModel extends Model
{
    protected $table            = 'topics';
    protected $primaryKey       = 'topic_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['topic_title', 'topic_category', 'topic_user'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'topic_title' => 'required|min_length[3]|max_length[255]',
        'topic_category' => 'required|is_not_unique[categories.category_id]',
        'topic_user' => 'required|is_not_unique[users.user_id]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTopicsWithCategory()
    {
        return $this->select('topics.*, categories.category_id, categories.category_name')
                    ->join('categories', 'categories.category_id = topics.topic_category', 'left')
                    ->findAll();
    }

    public function search($keywords = null)
    {
        return $this->like('topic_title', $keywords);
    }
}
