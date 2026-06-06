<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_name', 'category_description'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'category_name' => 'required|min_length[3]|max_length[255]',
        'category_description' => 'permit_empty|max_length[1000]',
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

    public function getCategoriesWithLastTopic()
    {
        $subquery = $this->db->table('topics')
                         ->select('topic_category, MAX(topic_id) as max_topic_id')
                         ->groupBy('topic_category');

        return $this->select('categories.*, topics.topic_id as last_topic_id, topics.topic_title as last_topic_title, topics.created_at as last_topic_created_at')
                    ->join('(' . $subquery->getCompiledSelect() . ') latest', 'latest.topic_category = categories.category_id', 'left')
                    ->join('topics', 'topics.topic_id = latest.max_topic_id', 'left')
                    ->findAll();
    }
}
